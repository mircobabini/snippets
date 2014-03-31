<?
function unsetor (&$var, $or = null)
{
	if (isset ($var))
	{
		$or = $var;
		unset ($var);
	}

	return $or;
}
