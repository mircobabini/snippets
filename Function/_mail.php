<?
_lib ("Com/Mail/Mail.php");
_lib ("Tool/Function/str_replace_spaces.php");
function _mail ($address, $subject, $body, $headers = "", $sender = false)
{
	if (is_string ($address) && strpos ($address, ",") !== false)
	{
		$address = str_replace_spaces ($address);
		$address = explode (",", $address);
	}
	
	if (is_array ($address))
	{
		$address = array_unique ($address);
		foreach ($address as $addr)
			_mail ($addr, $subject, $body, $headers, $sender);

		return;
	}

	$address = trim ($address);
	if (!Mail::valid ($address))
		return false;
	
	return @mail ($address, $subject, $body, $headers);
}
