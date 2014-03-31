<?php
function crumb_format_phone_usa($phone) {
	$numbers = preg_replace("/[^0-9]/", '', $phone);
	if (strlen($numbers) != 10)
		return $phone;

	$phone = "(" . substr($numbers, 0, 3) . ")";
	$phone .= " " . substr($numbers, 3, 3) . "-";
	$phone .= substr($numbers, 6, 4);
	return $phone;
}

