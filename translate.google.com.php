<?php

header("Content-type: application/json; Charset=UTF-8");

$null = json_encode(null);
$q0 = !empty($_GET['q']) ? filter_var($_GET['q'], FILTER_SANITIZE_STRING) : die($null);
$q = urlencode($q0);

$res = [];

$sls = ['auto'];
$tls = ['en', 'fa', 'ar', 'ku'];
$tls_ckb = [
    "ئینگلیزی",
    "پارسی",
    "عەرەبی",
    "کوردیی باکووری",
    ];

foreach($sls as $sl) {
    foreach($tls as $a => $tl) {
        $url = "https://translate.google.com/?hl=en&eotf=0&sl={$sl}&tl={$tl}&q={$q}";

        $html = @file_get_contents($url);
        
        $dom = new DOMDocument;
        @$dom->loadHTML($html);
        
        $spans = $dom->getElementsByTagName("span");
        
        foreach($spans as $span) {
            if($span->getAttribute("id") == "result_box") {
                $r = filter_var($span->nodeValue, FILTER_SANITIZE_STRING);
                $r = mb_strlen($r) > 150 ? mb_substr($r, 0, 150) . "..." : $r;
                
                $res[$tl] = [$tls_ckb[$a], $r];
            }
        }
        
    }
}


if(empty($res)) die($null);

echo(json_encode($res));

?>