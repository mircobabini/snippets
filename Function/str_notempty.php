<?
function str_notempty (&$str)
{
	if (!isset ($str) || !is_string ($str))
		return false;
	
	return $str !== "";
}