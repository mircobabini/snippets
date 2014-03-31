<?php

function _xml_single ($singular_name, $parts) {
	$rss = _rss ();
	$xml = $rss->addChild ($singular_name);
	foreach ($parts as $tag => $value) {
		_xml_add_child ($xml, $tag, $value);
	}
	
	_reply_xml (_format_xml ($rss));
}
function _xml_list ($plural_name, $singular_name, $items, $format = true) {
	$rss = _rss ();
	$xml = $rss->addChild ($plural_name);
	$xml->addAttribute ('items', sizeof ($items));

	foreach ($items as $item) {
		$child = $xml->addChild ($singular_name);
		foreach ($item as $tag => $value) {
			_xml_add_child ($child, $tag, $value);
		}
	}
	
	return ($format) ? _format_xml ($rss) : $rss->asXML ();
}
function _xml_add_child ($xml, $tag, $value) {
	$child = $xml->addChild ($tag);
	if (is_array ($value)) {
		foreach ($value as $tag => $v) {
			_xml_add_child ($child, $tag, $v);
		}
	} else {
		$xml->$tag = $value;
	}
	
	return $xml;
}
/**
 * @param string $version
 * @return \SimpleXMLElement
 */
function _rss ($version = '2.0') {
	$rss = new SimpleXMLElement ('<rss/>');
	$rss->addAttribute ('version', $version);
	
	return $rss;
}
/**
 * @param \SimpleXMLElement $simplexml
 * @return string
 */
function _format_xml ($simplexml) {
	$dom = dom_import_simplexml ($simplexml)->ownerDocument;
	$dom->formatOutput = true;
	return $dom->saveXML ();
}

function _xml_reply ($xml) {
	if (!$xml) {
		header('HTTP/1.0 404 Not Found');

	} else {
		header ("Content-type: text/xml; charset=utf-8");
		echo $xml;

	}

	die;
}
