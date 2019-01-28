<?php

// DOMDocument class is necessary to run this program. (php-xml, php-7.*-xml)
// Multibyte string class is necessary(line:40,..). (php-mbstring, php-7.*-mbstring)

// output: json
header("Content-type: application/json; Charset=UTF-8");

// json encoded null object=>stands for no result.
// either because of error or nothing been found.
$null = json_encode(null);

$q = !empty($_GET['q']) ? urlencode(filter_var($_GET['q'], FILTER_SANITIZE_STRING)) : die($null); // search query
$url = "http://dictio.kurditgroup.org/dictio/{$q}"; // search url

$html = file_get_contents($url) or die($null); // download the search result page($uri).

// till now we have downloaded the search result page,
// and from now we try to extract definition parts.
$dom = new DOMDocument; // declare a new DOM object.
@$dom->loadHTML($html);
// "@" used to ignore html parsing warnings. that caused by undefined html structures.

$res = []; // final results
$lmt = filter_var($_GET['n'], FILTER_VALIDATE_INT) ? $_GET['n'] : 10;
// apply a limit on number of results that will be store in $res.

$n = 0; // a checkpoint counter for $lmt.

// going through every div element.
foreach($dom->getElementsByTagName("div") as $div) {
    if($n == $lmt)  break; // checkpoint for $lmt.
    
    if( $div->getAttribute("class") == "translation clear direct parent " || "translation clear index parent " == $div->getAttribute("class") ) {
        // check for div classes.
        // we want div elements that have one of these classes:
        // "translation clear direct parent " or "translation clear index parent "
        
        $ckb = filter_var($div->getElementsByTagName("div")[2]->nodeValue, FILTER_SANITIZE_STRING);
        $ckb = mb_strlen($ckb) > 150 ? mb_substr($ckb, 0, 150) . "..." : $ckb;
        
        $en = filter_var($div->getElementsByTagName("div")[1]->nodeValue, FILTER_SANITIZE_STRING);
        $en = mb_strlen($en) > 150 ? mb_substr($en, 0, 150) . "..." : $en;
        
        // save results
        $res[] = [
            "ckb" => $ckb,
            "en" => $en,
        ];

        // checkpoint counter + 1
        $n++;
    }
    
}

// print results or null
if(empty($res)) die($null);
echo(json_encode($res));

?>
