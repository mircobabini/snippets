<?
/**
 * @return array
 */
function get_argv ()
{
	$argvs = array ();

	$params = $_SERVER['argv'];
	if (sizeof ($params) > 1) {
		array_shift ($params);

		foreach ($params as $param) {
			list ($key, $value) = explode ("=", $param);
			$argvs[ $key ] = $value;
		}
	}

	return $argvs;
}
