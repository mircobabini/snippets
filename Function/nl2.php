<?
/**
 * @param string $string
 * @param string|array $to
 * @return boolean
 */
function nl2 ($string, $to)
{
	if (!is_string ($to) && (!is_array ($to) || sizeof ($to) != 3))
		return false;
	
	return str_replace (array ("\r\n", "\r", "\n"), $to, $string);
}