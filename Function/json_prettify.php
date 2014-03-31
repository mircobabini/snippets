<?php
if (!function_exists('json_prettify')) {
	function json_prettify($ugly) {
		$pretty = "";
		$indent = "";
		$last = '';
		$pos = 0;
		$level = 0;
		$string = false;
		while ($pos < strlen($ugly)) {
			$char = substr($ugly, $pos++, 1);
			if (!$string) {
				if ($char == '{' || $char == '[') {
					if ($char == '[' && substr($ugly, $pos, 1) == ']') {
						$pretty .= "[]";
						$pos++;
					} else if ($char == '{' && substr($ugly, $pos, 1) == '}') {
						$pretty .= "{}";
						$pos++;
					} else {
						$pretty .= "$char\n";
						$indent = str_repeat('	', ++$level);
						$pretty .= "$indent";
					}
				} else if ($char == '}' || $char == ']') {
					$indent = str_repeat('	', --$level);
					if ($last != '}' && $last != ']') {
						$pretty .= "\n$indent";
					} else if (substr($pretty, -2, 2) == '	') {
						$pretty = substr($pretty, 0, -2);
					}
					$pretty .= $char;
					if (substr($ugly, $pos, 1) == ',') {
						$pretty .= ",";
						$last = ',';
						$pos++;
					}
					$pretty .= "\n$indent";
				} else if ($char == ':') {
					$pretty .= ": ";
				} else if ($char == ',') {
					$pretty .= ",\n$indent";
				} else if ($char == '"') {
					$pretty .= '"';
					$string = true;
				} else {
					$pretty .= $char;
				}
			} else {
				if ($last != '\\' && $char == '"') {
					$string = false;
				}
				$pretty .= $char;
			}
			$last = $char;
		}
		return $pretty;
	}
}

