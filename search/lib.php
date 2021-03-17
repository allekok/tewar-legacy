<?php
const DEF_LIMIT = 10;
const DEF_QUERY = NULL;

function get_element_by_id($parent, $id, $tag = "*") {
	foreach($parent->getElementsByTagName($tag) as $el)
		if($id == $el->getAttribute("id"))
			return $el;
}
function get_elements_by_class($parent, $class, $tag = "*") {
	$elements = [];
	foreach($parent->getElementsByTagName($tag) as $el) {
		$el_class = $el->getAttribute("class");
		$class_list = preg_split("/\s+/u", $el_class,
					-1, PREG_SPLIT_NO_EMPTY);
		if(in_array($class, $class_list))
			$elements[] = $el;
	}
	return $elements;
}
function get_element_by_class($parent, $class, $tag="*", $i=0) {
	return get_elements_by_class($parent, $class, $tag)[$i];
}
function download($url) {
	return @file_get_contents($url);
}
function parse_html($html) {
	$dom = new DOMDocument;
	@$dom->loadHTML($html);
	return $dom;
}
function get_query() {
	return isset($_REQUEST["q"]) ?
	       filter_var($_REQUEST["q"], FILTER_SANITIZE_STRING) :
	       DEF_QUERY;
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
?>
