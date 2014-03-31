<?
function mysql_real_escape_array ($a)
{
	return array_map ("str_escape",$a); 
} 