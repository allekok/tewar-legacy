<?php
header("Content-type: application/json; Charset=UTF-8");
$null = json_encode(null);

$q = isset($_GET['q']) ? urlencode(filter_var(
	$_GET['q'],
	FILTER_SANITIZE_STRING)) : die($null);
$lmt = filter_var(@$_GET['n'], FILTER_VALIDATE_INT) ?
       $_GET['n'] : 10;
$url = "https://ku.wiktionary.org/w/api.php?action=query&list=search&srwhat=text&srsearch=$q&format=json&srlimit=$lmt";

$json = @file_get_contents($url) or die($null);
echo($json);
?>
