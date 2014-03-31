<?
function array_compare ($a, $b)
{
	sort ($a);
	sort ($b);
	
	return $a == $b;
}
