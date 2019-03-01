<?php

header("Content-type: application/json; Charset=UTF-8");

$null = json_encode(null);
$q = !empty(@$_GET['q']) ? urlencode(filter_var($_GET['q'], FILTER_SANITIZE_STRING)) : die($null);

$html = file_get_contents("https://dictiwa.com/");
$dom = new DOMDocument;
@$dom->loadHTML($html);

/*
$kind = [];

foreach($dom->getElementsByTagName("ul") as $ul) {
    if($ul->getAttribute("id") == "dicts_list") {
        foreach($ul->getElementsByTagName("li") as $li) {
            $a = filter_var($li->getElementsByTagName("a")[0]->getAttribute("href"), FILTER_SANITIZE_STRING);
            $kind[] = substr($a, -5);
        }
    }
}
 */
$kind = [ "so/so", "sh/so", "so/sh", "fa/so", "so/fa", "ar/so" , "so/ar", "sh/sh" ];

$res = [];
$lmt = filter_var(@$_GET['n'], FILTER_VALIDATE_INT) ? $_GET['n'] : 10;
$n = 0;

foreach($kind as $k) {

    $url = "https://dictiwa.com/search/{$q}/{$k}";
    
    $html = file_get_contents($url) or die($null);
    
    $dom = new DOMDocument;
    @$dom->loadHTML($html);
    
    
    foreach($dom->getElementsByTagName("div") as $div) {
        if($n == $lmt)  break;
        
        if( stristr($div->getAttribute('class'), 'word_block') ) {
            $h3a = $div->getElementsByTagName("h3")[0]->getElementsByTagName("a")[0];
            $title = filter_var($h3a->nodeValue, FILTER_SANITIZE_STRING);
            $link = filter_var($h3a->getAttribute("href"), FILTER_SANITIZE_STRING);
            
            $desc = filter_var($div->getElementsByTagName("div")[0]->getElementsByTagName("p")[0]->nodeValue, FILTER_SANITIZE_STRING);
            $desc = mb_strlen($desc) > 150 ? mb_substr($desc, 0, 150) . "..." : $desc;
            
            if(! empty($desc) ) {
                $res[] = [
                    "title" => $title,
                    "link" => $link,
                    "desc" => $desc,
                    ];
                $n++;
            }
        }
        
    }
}

if(empty($res)) die($null);

echo(json_encode($res));

?>
