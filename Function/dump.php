<?
function dump ()
{
	$bt = debug_backtrace ();
	if (!isset ($bt[0]['file'])) {
		return false;
	} 
	
	echo "{$bt[0]['file']} ({$bt[0]['line']})\n";
	var_dump (func_get_args ());
}

function dumpie () {
	dump (func_get_args ());
	die;
}