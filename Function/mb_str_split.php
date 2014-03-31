<?
if(!function_exists('mb_str_split')) {
	/**
	 * @param String $str
	 * @param int $length
	 * @return bool
	 * 
	 * @link https://github.com/alecgorge/PHP-String-Class/blob/master/string.php
	 */
	function mb_str_split($str, $length = 1) {
		if ($length < 1) return FALSE;

		$result = array();

		for ($i = 0; $i < mb_strlen($str); $i += $length) {
			$result[] = mb_substr($str, $i, $length);
		}

		return $result;
	}
}
