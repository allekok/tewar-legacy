<?php
require("lib.php");

send_http_headers();

$q = get_query();
$lmt = get_limit();
$url = "https://kawedic.info/index.php";
$data = [
	"search" => "",
	"searchWrd" => $q
];

$html = post($url, $data);
$dom = parse_html($html);

$res = [];
$id = 0;

$parent = $dom->documentElement->getElementsByTagName("body")[0];
$founds = get_elements_by_class($parent, "found0", "div", $lmt);
$founds = [
	[$founds, "div"],
	[get_elements_by_class($parent, "found1", "div", $lmt-count($founds)),
	 "span"]
];

foreach($founds as $a) {
	foreach($a[0] as $f) {
		if(!$lmt--)
			break;

		$divs = $f->getElementsByTagName($a[1]);
		@$title = clean_string($divs[0]->nodeValue);
		@$desc = snippet(clean_string($divs[1]->nodeValue));
		$link = "<form class='fmk'" .
			"action='{$url}' method='post'>" .
			"<input type='hidden' name='search'>" .
			"<input type='hidden'" .
			"name='searchWrd' value='{$title}'><button" .
			" type='submit'>{$title}</button></form>";

		$res[] = [
			"title" => $title,
			"desc" => $desc,
			"link" => $link
		];
	}
}

output($res);
?>
