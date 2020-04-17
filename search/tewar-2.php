<?php
header("Content-type: application/json; Charset=UTF-8");
$null = json_encode(null);
$q0 = isset($_GET['q']) ? filter_var(
    $_GET['q'],
    FILTER_SANITIZE_STRING) : die($null);
$q = urlencode($q0);
$res = [];
$lmt = filter_var(@$_GET['n'], FILTER_VALIDATE_INT) ?
       $_GET['n'] : 1;
$url = "https://allekok.ir/tewar/src/backend/lookup.php?q={$q}&dicts=all&n={$lmt}&output=json";
$json = @file_get_contents($url);
$results = json_decode($json, true);
$res = [];
foreach($results as $i => $r) {
    if($i == "time") continue;
    foreach($r as $arr)
    $res[] = ["word" => $arr[1],
	      "mean" => $arr[2],
	      "dict" => $i,
	      "url" => "https://allekok.ir/tewar/?q={$arr[1]}"];
}
if(!$res) echo $null;
else echo json_encode($res);
?>
