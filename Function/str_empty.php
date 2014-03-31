<?
/**
 * @param string $str
 * @param bool $trim
 * @return bool
 */
function str_empty ($str, $trim = false)
{
	if ($trim)
		$str = trim ($str);
	
	return $str === "";
}