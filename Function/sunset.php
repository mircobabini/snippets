<?php
if (!function_exists('sunset')) {

	function sunset() {
		$args = func_get_args_byref();
		foreach ($args as $arg) {
			if ($arg === null)
				continue;

			unset($arg);
		}
	}

}

