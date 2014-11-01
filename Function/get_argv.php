<?
/**
 * @return array
 * @version 2
 */
function get_argv( $key = null ){
	global $_argvs;
	if( ! $_argvs ){
		$_argvs = array();
		
		if( isset( $_SERVER['argv'] ) && count( $_SERVER['argv'] ) > 1 ){
			$argv = $_SERVER['argv'];
			array_shift( $argv );

			foreach( $argv as $arg ){
				parse_str( $arg, $_argvs );
			}
		}else{
			$_argvs = $_GET;
		}
	}

	if( $key === null ){
		return $_argvs;
	}else{
		if( isset( $_argvs[ $key ] ) ){
			return $_argvs[ $key ];
		}else{
			return null;
		}
	}
}
