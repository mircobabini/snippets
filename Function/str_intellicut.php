<?
function str_intellicut ($text, $limit = 0, $append = "..")
{
	if ($limit === 0 || strlen ($text) <= $limit)
		return $text;
	
	$text = strip_tags ($text);
	$semitext = substr ($text, 0, $limit);
	$pos = strrpos ($semitext, " ");
	$semitext = substr ($semitext, 0, $pos);
	return $semitext . $append;
}