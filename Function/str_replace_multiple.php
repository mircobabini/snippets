<?
/**
 * @param string $semipattern	for example multiple	"\s"
 * @param string $replacement	can be replaced with	"single-whitespace"
 * @param string $subject		in a string with multiple whitespaces
 * @return string
 */
function str_replace_multiple ($semipattern, $replacement, $subject)
{
	$pattern = "#[{$semipattern}][{$semipattern}]+#";
	return (string)preg_replace ($pattern, $replacement, $subject);
}
