<?
function get_dump ($assoc = false)
{
	$args = func_get_args ();

	$result = array ();
	foreach ($args as $arg)
	{
		ob_start();
		var_dump ($object);
		$content = ob_get_contents ();
		ob_end_clean();

		if ($assoc)
			$result[ $arg ] = $content;
		else
			$result[] = $content;
	}

	return $result;
}
