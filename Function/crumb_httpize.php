<?php
function crumb_httpize($uri) {
	$p = @parse_url($uri);

	if (!isset($p['scheme'])) {
		$uri = "http://{$uri}";
	}

	return $uri;
}


