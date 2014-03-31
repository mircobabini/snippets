<?
function str_keep ($needle, $haystack, $howManyTimes = 1) {
	while ($howManyTimes--) {
		if (($pos = strpos ($haystack, $needle)) === false) {
			return false;
		}
		
		$kaystack = substr ($haystack, 0, $pos);
	}
	
	return $kaystack; 
}
