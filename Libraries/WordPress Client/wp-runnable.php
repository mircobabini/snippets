<?php
global $pid;
$pid = getmypid();

if( ! function_exists('echol') ) :
function echol( $string, $indent = 0 ){
    global $pid;

    for( $i = 0; $i < $indent; $i++ ){
        $string = "\t" . $string;
    }

    echo "[{$pid}]> " . $string . "\n";
}
endif;

// base settings
@ini_set( 'memory_limit', -1 );
@ini_set( 'memory_limit', '2048M' );
@ini_set( 'display_errors', 1 );

error_reporting( E_ALL ^ E_NOTICE );
set_time_limit(0);
gc_enable();

// require wordpress
define('DOING_AJAX', true);
define('WP_USE_THEMES', false);

$_SERVER = array(
    "HTTP_HOST"		 => "dev.inkapiv3",
    "SERVER_NAME" 	 => "dev.inkapiv3",
    "REQUEST_URI"	 => "/",
    "REQUEST_METHOD" => "GET",
    "PHP_SELF" 		 => "",
    "SCRIPT_NAME" 	 => basename( __FILE__ ),
);
require '../wp-load.php';

function my_error_logger_init( $filename ){
	global $logger;
	$fs = new FS( WP_LOG );
	$logger = $fs->file( $filename );

	return $logger;
}
function my_error_logger_log( $error_message ){
	global $logger;
    if( $logger ){
    	$logger->append( $error_message );
    }

	return $logger;
}

function my_error_handler( $errno, $errstr, $errfile, $errline ) {
    $error_message = "Error: $errstr at {$errfile}:{$errline}";

    $db = debug_backtrace();
    for( $i = 1; $i < count( $db ); $i++ ){
    	$db_item = $db[$i];

    	$log_line  = PHP_EOL . "#{$i}: ";
    	$log_line .= $db_item['file'].'('.$db_item['line'].'): ';

        $args = simplify_args( $db_item['args'] );
    	$args = implode( ', ', $args );

    	$log_line .= $db_item['function'] . "({$args})";
	    $error_message .= $log_line;
    }

    my_error_logger_log( $error_message );
    echol( $error_message );
}
set_error_handler("my_error_handler");

function my_exception_handler( Exception $exception ) {
    $error_message  = "Exception: " . $exception->getMessage() . " at " . $exception->getFile() . ":" . $exception->getLine() . PHP_EOL;
    $error_message .= $exception->getTraceAsString();

    my_error_logger_log( $error_message );
    echol( $error_message );
}
set_exception_handler("my_exception_handler");

class MemoryLogger{
	protected $memory_usage = false;
	protected $memory_start = false;

	protected $memory_lap   = false;
	protected $memory_leak  = false;

	public function lap(){
		$memory = memory_get_usage( true );
		if( ! $this->memory_start ){

			$this->memory_start = $memory;

		}else{

			$this->memory_lap  = $memory - $this->memory_usage;
			$this->memory_leak = $memory - $this->memory_start;

		}

		$this->memory_usage = $memory;
		return $this;
	}
	public function show( $lap = true, $leak = true, $now = true ){
		if( $lap  ) echom( 'LAP ', $this->memory_lap );
		if( $leak ) echom( 'LEAK', $this->memory_leak );
		if( $now  ) echom( 'NOW ' );

		return $this;
	}
}

function echom( $label, $size = null ){
	if( $size === null ){
		$size = memory_get_usage( true );
	}

    $unit = array( 'b','kb','mb','gb','tb','pb' );
    $undertheline = pow(1024,($i=floor(log($size,1024))));
    if( $undertheline == 0 ){ // avoid division by zero
    	$value = '< 1 kb';
    }else{
    	$unit = isset( $unit[$i] ) ? $unit[$i] : ' ?';
    	$value = @round( $size/$undertheline,2 ).' '.$unit;
    }

    echol( "MEMORY $label " . $value );
}

function memory_log( $memory_logger ){
	$memory_logger->lap()->show();
}

// http://docs.dev4press.com/tutorial/wordpress/internal-object-cache-in-wordpress/
function wp_clean_cache_full() {
	  global $wpdb, $wp_object_cache;
	 
	  unset( $wp_object_cache->cache );
	  $wp_object_cache->cache = array();
	  unset( $wpdb->queries );
	  $wpdb->queries = array();
}

function printforerror( $format ){
    $args = func_get_args();
    array_shift( $args );
    $args = simplify_args( $args );

    return printf_array( $format, $args );
}
function sprintforerror( $format ){
    $args = func_get_args();
    array_shift( $args );
    $args = simplify_args( $args );

    return sprintf_array( $format, $args );
}
function printf_array($format, $arr){
    return call_user_func_array( 'printf', array_merge( (array)$format, $arr) );
}
function sprintf_array($format, $arr){
    return call_user_func_array( 'sprintf', array_merge( (array)$format, $arr ) );
}

function simplify_arg( $arg ){
    if( $arg === null ){
        $arg = 'NULL';
    }else if( is_array( $arg ) ){
        $arg = 'Array('.count($arg).')';
    }else if( is_object( $arg ) ){
        $arg = 'Object('.get_class($arg).')';
    }else if( is_string( $arg ) ){
        if( strlen( $arg ) > 10 ){
            $arg = substr( $arg, 0, 10 ) . '..';
        }
    }

    return $arg;
}
function simplify_args( $args ){
    foreach( $args as &$arg ){
        $arg = simplify_arg( $arg );
    }

    return $args;    
}

function catchkill( $exit = true ){
    global $exec, $pid;
    $exec = new FS( ABSPATH . '/wp-exec' );

    if( ! $exec->exists( 'kill.txt' ) ){
        return false;
    }

    $raw = trim( $exec->raw( 'kill.txt' ) );
    if( $raw === '' ){
        return false;
    }

    if( $raw === 'all' ){
        echol( "killed by signal (kill 'all')" );
        if( $exit ) exit;
        else return true;
    }

    $ids = explode( ',', $raw );
    if( in_array( $pid, $ids ) ){
        echol( "killed by signal (kill '{$pid}')" );
        if( $exit ) exit;
        else return true;
    }

    return false;
}
function sendkill( $processes ){
    global $exec;

    $_processes = array();
    if( $exec->exists( 'kill.txt' ) ){
        $raw = trim( $exec->raw( 'kill.txt' ) );
        $_processes = explode( ',', $raw );
    }

    foreach( $processes as $process ){
        $_processes[] = $process;
    }

    $_processes = array_unique( $_processes );
    return $exec->put( 'kill.txt', implode( ',', $_processes ) );
}
function ensuredeath( $processes ){
    while( active_processes( $processes ) >= 1 ){}
    return true;
}
