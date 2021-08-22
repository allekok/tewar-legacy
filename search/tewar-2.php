<?php
require("lib.php");

send_http_headers();

$q = get_query_encoded();
$lmt = get_limit();
$url = "https://allekok.ir/tewar/src/backend/lookup.php?q={$q}&dicts=all&n={$lmt}&output=json";
$json = json_decode(download($url), true);
array_pop($json);

$res = [];

foreach($json as $i => $r) {
	$res[] = [
		"word" => $r[1],
		"mean" => $r[2],
		"dict" => $r[0],
		"url" => "https://allekok.ir/tewar/?q={$r[1]}"
	];
}

output($res);
?>
