<?
function ifsetor_array ($array, $key, $or = null)
{
	return (isset ($array[ $key ])) ? $array[ $key ] : $or;
}
