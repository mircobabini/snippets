<?
function sum ()
{
	$total = 0;

	for ($argCount = func_num_args (), $index = 0; $index < $argCount; $index++)
	{
		$add = func_get_arg ($index);
		foreach ($add as $value)
			$total += $value;
	}

	return $total;
}
