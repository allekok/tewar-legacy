<?php
header("Content-type: application/json; Charset=UTF-8");
$null = json_encode(null);
$q0 = isset($_GET['q']) ? filter_var(
    $_GET['q'],
    FILTER_SANITIZE_STRING) : die($null);
$q = urlencode($q0);
$res = [];
$lmt = filter_var(@$_GET['n'], FILTER_VALIDATE_INT) ?
       $_GET['n'] : 10;
$url = "https://lex.vejinbooks.com/ck/search/{$q}?fields=0&dictId=0";
$html = @file_get_contents($url);
preg_match_all("/\[{\"head\":.+\]/u", $html, $results);
$results = json_decode($results[0][0], true);
foreach($results as $r) {
    if($lmt-- == 0) break;
    $desc = filter_var($r["definition"], FILTER_SANITIZE_STRING);
    $desc = mb_strlen($desc) > 100 ?
	    mb_substr($desc, 0, 100) . "..." :
	    $desc;
    $desc = preg_replace("/\n+/u", "؛ ", $desc);
    $res[] = [
	"title" => $r["head"],
	"wordlist" => $r["dictTitle"],
	"def" => $desc,
	"url" => "https://lex.vejinbooks.com/ck/def/{$r["url"]}/{$r["head"]}",
    ];
}
if(!$res) echo $null;
else echo json_encode($res);
?>
