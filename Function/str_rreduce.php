<?
/**
 * example on needle='/', haystack='/a/b/c'
 * returns '/a/b'
 * 
 * @param string $needle
 * @param string $haystack
 * @param int $howManyTimes
 * @return bool
 */
function str_rreduce ($needle, $haystack, $howManyTimes = 1) {
	while ($howManyTimes --) {
		if (($pos = strrpos ($haystack, $needle)) === false)
			return false;
		
		$haystack = substr ($haystack, 0, $pos);
	}
	
	return $haystack; 
}
