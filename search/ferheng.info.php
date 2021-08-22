<?php
require("lib.php");

send_http_headers();

$q0 = get_query();
$q = urlencode($q0);
$lmt = get_limit();
$pages = 1;

$res = [];

for($pg=1; $pg <= $pages; $pg++) {
	$url = "http://ferheng.info/page/{$pg}/?s={$q}";
	$html = download($url);
	$dom = parse_html($html);

	foreach($dom->getElementsByTagName("article") as $art) {
		$h2 = $art->getElementsByTagName("h2")[0];
		$title = clean_string($h2->nodeValue);
		$link = clean_string($h2->getElementsByTagName("a")[0]
					->getAttribute("href"));
		$desc = clean_string($art->getElementsByTagName(
			"div")[0]->nodeValue);
		$desc = snippet($desc);
		$sis = stristr($title, $q0) || stristr($q0, $title);
		$rank = similar_text($title, $q0) / mb_strlen($title);
		
		if(stristr($link, "alfba"))
			$res[] = [
				"stristr" => $sis,
				"rank" => $rank,
				"title" => $title,
				"link" => $link,
				"desc" => $desc,
			];
	}
}

if(empty($res))
	die_null();

rsort($res);

$_res = [];
foreach($res as $r) {
	if(!$lmt--)
		break;
	$_res[] = $r;
}

output($_res);
?>
