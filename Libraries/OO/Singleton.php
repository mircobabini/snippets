<?php
class Singleton{
	public static function instance(){
		static $instance;
		if( $instance === null ){
			$instance = new static;
		}

		return $instance;
	}
	public function classname(){
		if( function_exists( 'get_called_class' ) ){
			return get_called_class();
		}else{
			throw new Exception( 'missing function get_called_class, try this fallback: https://github.com/mircobabini/snippets/blob/master/Fallback/get_called_class.php')
		}
	}
}
