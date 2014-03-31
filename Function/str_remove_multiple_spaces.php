<?
_lib ("Tool/Function/str_replace_multiple.php");
function str_remove_multiple_spaces ($string)
{
	return str_replace_multiple ("\s", " ", $string);
}
