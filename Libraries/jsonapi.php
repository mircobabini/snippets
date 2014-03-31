<?php
if (!function_exists('jsonapi_error')) {
	function jsonapi_error($message){
		global $json_api;
		return $json_api->error($message);
	}
}
if (!function_exists('jsonapi_get')) {
	function jsonapi_get() {
		global $json_api;
		$args = func_get_args();

		if (func_num_args() > 1) {
			$_params = $json_api->query->get($args);
		} else {
			$args = array_shift($args);
			foreach ($args as $param => $list) {
				if (is_array($list)) {
					list ($value, $default) = $list;
				} else {
					$default = $list;
					$value = null;
				}

				if ($value === null) {

					$values = $json_api->query->get(array($param));

					if (sizeof($values) > 0) {

						$value = array_shift($values);
						if (empty($value)) {
							$value = @$_GET[$param];
							if (is_blank($value)) {
								$value = $default;
							}
						}
					} else {
						$value = $default;
					}
				}

				$_params[$param] = $value;
			}
		}

		return $_params;
	}
}

if (!function_exists('query_get')) {
	function query_get(){
		// deprecated
		return call_user_func_array('jsonapi_get', func_get_args());
	}
}

