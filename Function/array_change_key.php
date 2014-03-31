<?php
function array_change_key(&$arr, $from, $to){
	if (!isset($arr[ $from ]) || isset($arr[ $to ])){
		return false;
	}
	
	$arr[ $to ] = $arr[ $from ];
	unset($arr[ $from ]);
	return true;
}

