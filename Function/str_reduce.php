<?
function str_reduce ($needle, $haystack, $howManyTimes = 1) {
	while ($howManyTimes--) {
		if (($pos = strpos ($haystack, $needle)) === false) {
			return false;
		}
		
		$haystack = substr ($haystack, $pos + 1);
	}
	
	return $haystack; 
}
