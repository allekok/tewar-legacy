<?php
require("lib.php");

send_http_headers();

$q = get_query_encoded();
$lmt = get_limit();
$url = "https://dictio.kurditgroup.org/dictio/{$q}";

$html = download($url);
$dom = parse_html($html);
$div = get_element_by_class($dom, "dictio-result", "div");

$text = clean_string($div->nodeValue);
$text = trim($text);
if(!$text)
	die_null();
$text = preg_replace("/\s*\n+\s*/u", " - ", $text);
$text = preg_replace("/\s+/u", " ", $text);
$text = snippet($text);

output([
	[
		"text" => $text,
		"url" => $url,
	]
]);
?>
