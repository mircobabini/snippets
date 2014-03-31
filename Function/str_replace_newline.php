<?
function str_replace_newline ($string, $replacement = "")
{
	return (string)str_replace (array ("\r", "\r\n", "\n"), $replacement, $string);
}
