<?php
const DEF_LIMIT = 10;
const DEF_SNIPPET_LEN = 150;

function get_element_by_id($parent, $id, $tag="*") {
	foreach($parent->getElementsByTagName($tag) as $el)
	if($id == $el->getAttribute("id"))
		return $el;
}
function get_elements_by_class($parent, $class, $tag="*", $lmt=-1) {
	$elements = [];
	foreach($parent->getElementsByTagName($tag) as $el) {
		$el_class = $el->getAttribute("class");
		$class_list = preg_split("/\s+/u", $el_class,
					-1, PREG_SPLIT_NO_EMPTY);
		if(in_array($class, $class_list)) {
			if(!$lmt--)
				break;
			$elements[] = $el;
		}
	}
	return $elements;
}
function get_element_by_class($parent, $class, $tag="*", $i=0) {
	return get_elements_by_class($parent, $class, $tag)[$i];
}
function download($url) {
	if($body = @file_get_contents($url))
		return $body;
	die_null();
}
function post($url, $data) {
	$data = http_build_query($data);
	$opts = ["http" => [
		"method" => "POST",
		"header"
		=> "Content-type: application/x-www-form-urlencoded",
		"content" => $data
	]];
	$context = stream_context_create($opts);
	if($body = @file_get_contents($url, false, $context))
		return $body;
	die_null();
}
function parse_html($html) {
	$dom = new DOMDocument;
	@$dom->loadHTML($html);
	return $dom;
}
function get_query() {
	return isset($_REQUEST["q"]) ?
	       filter_var($_REQUEST["q"], FILTER_SANITIZE_STRING) :
	       die_null();
}
function get_query_encoded() {
	return urlencode(get_query());
}
function get_limit() {
	return filter_var(@$_REQUEST["n"], FILTER_VALIDATE_INT) ?
	       $_REQUEST["n"] :
	       DEF_LIMIT;
}
function send_http_headers() {
	header("Content-type: application/json; Charset=UTF-8");
}
function clean_string($str) {
	return filter_var($str, FILTER_SANITIZE_STRING);
}
function die_null() {
	die(json_encode(null));
}
function output($obj) {
	if(!$obj)
		die_null();
	echo json_encode($obj);
}
function snippet($text, $len=DEF_SNIPPET_LEN) {
	return mb_strlen($text) > $len ?
	       mb_substr($text, 0, $len) . "..." :
	       $text;
}
?>
