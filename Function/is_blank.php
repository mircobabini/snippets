<?php
if (!function_exists('is_blank')) {

	function is_blank($value) {
		return empty($value) && !is_numeric($value);
	}

}

