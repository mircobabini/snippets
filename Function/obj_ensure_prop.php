<?
function obj_ensure_prop (&$obj, $prop, $default = null)
{
	if (!is_object ($obj))
		throw new Exceptions ();

	if (!property_exists ($obj, $prop))
	{
		if ($default === null)
			$default = new stdClass ();
		
		$obj->$prop = $default;
	}
}
