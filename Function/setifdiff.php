<?
function setifdiff (&$handler, $value)
{
	if ($handler !== $value)
	{
		$handler = $value;
		return true;
	}
	
	return false;
}