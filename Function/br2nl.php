<?
/**
 * @param String $string
 * @return String
 * 
 * @see http://www.webdeveloper.com/forum/showthread.php?t=215476
 */
function br2nl ($string)
{
	return preg_replace ('#<br\s*?/?>#i', "\n", $string); 
}