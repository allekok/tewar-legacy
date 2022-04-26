<?php
require("lib.php");

send_http_headers();

$q = get_query();
$lmt = get_limit();
$url = "http://farhangumejuikawa.com/kawe/result.php";
$data = [
	"strvar" => $q
];

$html = post($url, $data);
$dom = parse_html($html);

$res = [];
$id = 0;

foreach($dom->getElementsByTagName("td") as $td) {
	if($td->getAttribute("id") == "wrd") {
		$title = clean_string($td->nodeValue);
		$res[$id] = [
			"title" => $title
		];
	} else if($td->getAttribute("id") == "def") {
		$desc = clean_string($td->nodeValue);
		$desc = snippet($desc);
		$res[$id] += [
			"link" => "<form class='fmk'
action='{$url}' method='post'><input type='hidden'
name='strvar' value='{$res[$id]['title']}'><button
type='submit'>{$res[$id]['title']}</button></form>",
			"desc" => $desc,
		];
		$id++;

		if(!$lmt--)
			break;
	}
}

output($res);
?>
