<?
function str_sanitize ($text)
{
	_lib ("Tool/Function/seems_utf8.php");
	_lib ("Tool/Function/str_convert_chars.php");
	_lib ("Tool/Function/specialchars.php");
	_lib ("Tool/Function/remove_accents.php");
	
	if (!seems_utf8 ($text))
	{
		$text = (seems_utf8 ($text)) ?
			str_convert_chars ($text) :
			str_convert_chars (utf8_encode ($text));
	}
	
	$text = preg_replace ('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', ' ', $text);
	$text = specialchars ($text);
	$text = remove_accents ($text);
	return $text;
}