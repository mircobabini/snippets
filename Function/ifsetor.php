<?
function ifsetor (&$var, $or = null)
{
	return (isset ($var)) ? $var : $or;
}
