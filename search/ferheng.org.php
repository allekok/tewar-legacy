<?php
require("lib.php");

send_http_headers();

$q = get_query_encoded();
$lmt = get_limit();
$dicts = [["kurd2eng", "کوردی-ئینگلیسی", "kurd", "eng"],
	  ["kurd2turk", "کوردی-تورکی", "kurd", "turk"],
	  ["kurd2ger", "کوردی-ئاڵمانی", "kurd", "ger"],
	  ["zaza2turk", "زازاکی-تورکی", "zaza", "turk"]];
$result = [];

foreach($dicts as $d) {
	if(!$lmt)
		break;
	
	$dict = urlencode($d[0]);
	$dict_name = $d[1];
	$url = "http://api.ferheng.org/get.php?lang={$dict}&word={$q}";
	$first_lang = $d[2];
	$second_lang = $d[3];

	$json = json_decode(download($url), true);
	foreach($json as $r) {
		if(!$lmt--)
			break 2;
		$f = snippet(trim(clean_string($r[$first_lang])));
		$s = snippet(trim(clean_string($r[$second_lang])));
		$result[] = [
			"dict" => $dict_name,
			$first_lang => $f,
			$second_lang => $s
		];
	}
}

output($result);
?>
