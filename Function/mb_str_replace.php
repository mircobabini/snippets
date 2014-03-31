<?
if(!function_exists('mb_str_replace')) {
	/**
	 * @param String $search
	 * @param String $replace
	 * @param String $subject
	 * @return string 
	 * 
	 * @link https://github.com/alecgorge/PHP-String-Class/blob/master/string.php
	 */
	function mb_str_replace($search, $replace, $subject) {
		if(is_array($subject)) {
			$ret = array();
			foreach($subject as $key => $val) {
				$ret[$key] = mb_str_replace($search, $replace, $val);
			}
			return $ret;
		}
		foreach((array) $search as $key => $s) {
			if($s == '') {
				continue;
			}
			$r = !is_array($replace) ? $replace : (array_key_exists($key, $replace) ? $replace[$key] : '');
			$pos = mb_strpos($subject, $s);
			while($pos !== false) {
				$subject = mb_substr($subject, 0, $pos) . $r . mb_substr($subject, $pos + mb_strlen($s));
				$pos = mb_strpos($subject, $s, $pos + mb_strlen($r));
			}
		}
		return $subject;
	}
}
