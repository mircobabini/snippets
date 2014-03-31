<?php
if (!function_exists('debug_auto')) {
	function debug_auto() {
		if (isset($_GET['debug'])) {
			debug_on();
		}
	}
}
if (!function_exists('debug_on')) {
	function debug_on($level = 30711) { /* E_ALL ^ E_NOTICE */
		@ini_set('display_errors', 1);
		error_reporting($level);

		$GLOBALS['debug_errored'] = false;
	}
}

