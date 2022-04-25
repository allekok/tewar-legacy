<?php
require("lib.php");

send_http_headers();

$q = get_query_encoded();
$lmt = get_limit();
$url = "https://lex.vejin.net/ck/search/?t={$q}";

$html = download($url);
$dom = parse_html($html);

$res = [];

$results_el = $dom->getElementById("results");
$items = get_elements_by_class($results_el, "result", "div", $lmt);
foreach($items as $item) {
	$header = get_element_by_class($item, "resultHead", "div")->firstChild;
	$link = clean_string($header->getAttribute("href"));
	
	$dict_el = get_element_by_class($header, "fromDict", "span");
	$dict = clean_string($dict_el->nodeValue);
	
	$header->removeChild($dict_el);
	$title = trim(clean_string($header->nodeValue));
	
	$desc = get_element_by_class($item, "resultDef", "div");
	$desc = snippet(trim(clean_string($desc->nodeValue)));
	$desc = preg_replace("/\n+/u", "<br>", $desc);

	$res[] = [
		"title" => $title,
		"wordlist" => $dict,
		"def" => $desc,
		"url" => "https://lex.vejin.net{$link}",
	];
}

output($res);
?>
