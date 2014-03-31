<?php
function t_start() {
	global $_timer;

	// start a new timer
	$_timer = microtime(true);
}

function t_stop($print = false) {
	global $_timer;

	// store & start a new timer
	$spent = t_partial();
	if ($print) {
		var_dump($spent);
	}

	t_start();
	return $spent;
}

function t_partial($print = false) {
	global $_timer;

	$spent = microtime(true) - $_timer;
	if ($print) {
		var_dump($spent);
	}

	return $spent;
}

