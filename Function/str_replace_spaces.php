<?
function str_replace_spaces ($string, $replacement = "")
{
	return (string)preg_replace ("#\s*#", $replacement, $string);
}
