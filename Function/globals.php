<?
if (!function_exists ('globals')) {
	function globals ($name, $value = null) {
		if ($value !== null)
			$GLOBALS[$name] = $value;

		$_value = isset ($GLOBALS[$name]) ? $GLOBALS[$name] : null;
		return $_value;
	}
}