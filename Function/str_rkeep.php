<?
function str_rkeep ($needle, $haystack, $howManyTimes = 1) {
	while ($howManyTimes--) {
		if (($pos = strrpos ($haystack, $needle)) === false) {
			return false;
		}
		
		$haystack = substr ($haystack, $pos + 1);
	}
	
	return $haystack; 
}
