<?
function ifemptyset (&$var, $set, $trim = false)
{
	if (is_string ($var) && $trim)
		$var = trim ($var);
	
	return (empty ($var)) ? $set : $var;
}