<?
/**
 * returns the first true-valued value
 * 
 * @param mixed $if
 * @param mixed $or
 * @return mixed
 * 
 * @package Handframe/Tool/Function
 * @author Mirco Babini <mirkolofio@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc/3.0/
 */
function ifor ($if, $or)
{
	$args = func_get_args ();
	do {
		$arg = array_shift ($args);
		if ($arg) return $arg;
	}
	while (sizeof ($args) > 0);
	
	return null;
}