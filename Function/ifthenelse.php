<?
function ifthenelse (&$var, $then, $else = null)
{
	return (isset ($var)) ? $then : $else;
}
