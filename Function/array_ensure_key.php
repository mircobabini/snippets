<?
function array_ensure_key (&$arr, $key, $default = array ())
{
	if (!isset ($arr[$key]))
		$arr[$key] = $default;
}