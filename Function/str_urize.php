<?
/**
 * @param mixed $string
 * @return mixed
 */
function str_urize ($string)
{
	_lib ("Tool/Function/str_replace_multiple.php");
	_lib ("Tool/Function/str_sanitize.php");

	if (is_array ($string))
	{
		$out = array ();
		foreach ($string as $key => $s)
			$out[ $key ] = str_urize ($s);
				
		return $out;
	}
	
	if (!is_string ($string))
		return false;
	
//	$cleanable = array ("-", ".", "&");
//	$replacements = array (" ", "", "");

//	$str_to_lower = strtolower ($string);
//	$str_no_dashes = str_replace ($cleanable, $replacements, $str_to_lower);
	
//	$str_clean = ($convert_spaces) ? str_replace (" ", "-", $str_no_multiple_spaces) : $str_no_multiple_spaces;

	// get a sane string
	$string = str_sanitize ($string);
	
	// replace non letter or digits by -
	$string = preg_replace ('~[^\\pL\d]+~u', '-', $string);
	
	// trim
	$string = trim (trim ($string, '-'));

	// transliterate
	$string = iconv ('utf-8', 'us-ascii//TRANSLIT', $string);

	// lowercase
	$string = strtolower ($string);

	// remove unwanted characters
	$string = preg_replace ('~[^-\w]+~', '', $string);

	// remove multiple dashes
	$string = str_replace_multiple ("-", "-", $string);

	return $string;
}
function str_urize2 ($string)
{
	$string = str_sanitize ($string);
	
	// replace non letter or digits by -
	$string = preg_replace ('~[^\\pL\d]+~u', '-', $string);
	
	// trim
	$string = trim (trim ($string, '-'));

	// transliterate
	$string = iconv ('utf-8', 'us-ascii//TRANSLIT', $string);

	// lowercase
	$string = strtolower ($string);

	// remove unwanted characters
	$string = preg_replace ('~[^-\w]+~', '', $string);

	// remove multiple dashes
	$string = str_replace_multiple ("-", "-", $string);
	
	return $string;
}
