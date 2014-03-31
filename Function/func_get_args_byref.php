<?php
if (!function_exists('func_get_args_byref')) {

	function func_get_args_byref() {
		$trace = debug_backtrace();
		return $trace[1]['args'];
	}

}

