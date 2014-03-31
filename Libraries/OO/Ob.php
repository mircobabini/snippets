<?
abstract class Ob
{
	public static function open ()
	{
		ob_start ();
	}
	public static function close ()
	{
		$c = ob_get_contents ();
		ob_clean ();

		return $c;
	}
}