<?
abstract class Debug
{
	/**
	 * @var bool
	 */
	private static $enable = false;
	/**
	 * @param bool $bool
	 */
	public static function enable ()
	{
		self::$enable = true;
	}
	public static function disable ()
	{
		self::$enable = false;
	}
	public static function isEnabled ()
	{
		return self::$enable;
	}


	/**
	 * @var String
	 */
	public static $logBuffer;
	/**
	 * @param String $message
	 */
	public static function flush ($message = "")
	{
		if (!self::$enable)
			return;
		
		self::$logBuffer .= $message . "\n";
		echo $message . "\n";
	}
	public static function out ($elem, $dump = true)
	{
		if ($dump)
			var_dump ($elem);
		else
			echo $elem;
	}
	
	private static function stackCalls ()
	{
		return debug_backtrace ();
	}
	public static function stackCall ($callNo)
	{
		// #1  Debug::stackCall(0) called at [/lab/handframe/data/lib/Handframe/HF_App.php:16]
		$stack = self::stackCalls ();
		return ifsetor_array ($stack, $callNo + 2);
	}
	public static function getStackCall ($callNo)
	{
		$stackCall = self::stackCall ($callNo + 1);
		return ($stackCall === null) ? null : (object)$stackCall;
	}
	public static function echoStackCall ($callNo)
	{
		$stackCall = self::getStackCall ($callNo + 1);
		if ($stackCall === null)
			return;
		
		$buff  = "";
		$buff .= $stackCall->class;
		$buff .= $stackCall->type;
		$buff .= $stackCall->function . "(";
		$buff .= implode (", ", $stackCall->args);
		$buff .= ") called at [";
		$buff .= $stackCall->file . ":" . $stackCall->line;
		$buff .= "]\n";
		
		echo $buff;
	}
}
