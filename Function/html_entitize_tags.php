<?
/**
 * @param String $str
 * @return String
 */
function html_entitize_tags ($str)
{
	$str = str_replace ("<", "&lt;", $str);
	$str = str_replace (">", "&gt;", $str);
	return $str;
}