<?php
if (!function_exists('obj_2_array')) {

	/**
	 * Convert a object to an array
	 * 
	 * @param   object  $object The object we want to convert
	 * 
	 * @return  array
	 */
	function obj_2_array($object) {
		// First we convert the object into a json string
		$json = json_encode($object);

		// Then we convert the json string to an array
		$array = json_decode($json, true);

		return $array;
	}

}

