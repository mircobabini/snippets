<?php
	function array_get_closest($search, $arr, $round) {
		$closest = null;
		foreach ($arr as $item) {
			if ($closest == null){
				switch ($round){
					case 0:
						$closest = $item;
						break;
					case 1:
						$closest = max($arr);
						break;
					case -1:
						$closest = min($arr);
						break;
				}
			}
			
			if (abs($search - $closest) > abs($item - $search)) {
				switch ($round){
					case 0:
						$closest = $item;
						break;
					case 1:
						if ($item >= $search){
							$closest = $item;
						}
						break;
					case -1:
						if ($item <= $search){
							$closest = $item;
						}
						break;
				}
			}
			
		}
		return $closest;
	}

