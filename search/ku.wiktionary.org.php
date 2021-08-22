<?php
require("lib.php");

send_http_headers();

$q = get_query_encoded();
$lmt = get_limit();
$url = "https://ku.wiktionary.org/w/api.php?action=query&list=search&srwhat=text&srsearch={$q}&format=json&srlimit={$lmt}";

echo download($url);
?>
