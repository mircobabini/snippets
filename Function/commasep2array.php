<?php

/**
 * @param string $string
 * @param string $separator
 * @return array
 */
function commasep2array ($string, $separator = ',') {
	$string = trim (trim ($string), $separator);
	if ($string === '')
		return array ();
	
	$strings = explode ($separator, $string);
	return $string;
}