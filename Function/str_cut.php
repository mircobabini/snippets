<?
/**
 * @param String $str
 * @param int $limit
 * @param String $fade
 * @return String 
 */
function str_cut ($str, $limit, $fade = "..")
{
	if (strlen ($str) > $limit)
		$str = substr ($str, 0, $limit) . $fade;
	
	return $str;
}