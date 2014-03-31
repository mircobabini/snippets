<?php
if (!function_exists('array_2_obj')) {

	/**
	 * Convert an array into a stdClass()
	 * 
	 * @param   array   $array  The array we want to convert
	 * 
	 * @return  object
	 */
	function array_2_obj($array) {
		// First we convert the array to a json string
		$json = json_encode($array);

		// The we convert the json string to a stdClass()
		$object = json_decode($json);

		return $object;
	}

}

