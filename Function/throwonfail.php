<?
function throwonfail ($bool)
{
	if (!$bool) throw new Exception ();
	return true;
}