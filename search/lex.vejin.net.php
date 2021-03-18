<?php
require("lib.php");

send_http_headers();

$null = json_encode(null);
$res = [];

$q = get_query_encoded();
if(!$q) die($null);

$lmt = get_limit();

$url = "https://lex.vejin.net/ck/search/?t={$q}";
$html = download($url);
$dom = parse_html($html);

$results_el = $dom->getElementById("results");

foreach(get_elements_by_class($results_el, "item", "div") as $item) {
	if($lmt-- == 0) break;
	$header_el = get_element_by_class($item, "header", "a");
	$link = clean_string($header_el->getAttribute("href"));
	
	$dict_el = get_element_by_class($header_el, "fromDict", "span");
	$dict = clean_string($dict->nodeValue);
	
	$header_el->removeChild($dict_el);
	$title = clean_string($header_el->nodeValue);
	
	$desc = get_element_by_class($item, "description", "div");
	$desc = clean_string($desc->nodeValue);
	$desc = mb_strlen($desc) > 100 ?
		mb_substr($desc, 0, 100) . "..." :
		$desc;
	$desc = preg_replace("/\n+/u", "<br>", trim($desc));
	$res[] = [
		"title" => $title,
		"wordlist" => $dict,
		"def" => $desc,
		"url" => "https://lex.vejin.net{$link}",
	];
}
if(!$res) echo $null;
else echo json_encode($res);
?>
