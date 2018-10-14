<?php

header("Content-type: application/json; Charset=UTF-8");

$null = json_encode(null);
$q = !empty($_GET['q']) ? filter_var($_GET['q'], FILTER_SANITIZE_STRING) : die($null);

$url = "http://farhangumejuikawa.com/kawe/result.php";

$postdata = http_build_query(
    array(
        'strvar' => $q,
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

$html = file_get_contents($url, false, $context) or die($null);

$dom = new DOMDocument;
@$dom->loadHTML($html);

$res = [];
$id = 0;
$lmt = filter_var($_GET['n'], FILTER_VALIDATE_INT) ? $_GET['n'] : 10;
$n = 0;

foreach($dom->getElementsByTagName("td") as $td) {
    if($n == $lmt)  break;
    
    if($td->getAttribute("id") == "wrd") {
        
        $title = filter_var($td->nodeValue, FILTER_SANITIZE_STRING);
        
        $res[$id] = [
            "title"=>$title,
            ];
            
    }
    
    if($td->getAttribute("id") == "def") {
        
        $desc = filter_var($td->nodeValue, FILTER_SANITIZE_STRING);
        $desc = mb_strlen($desc) > 150 ? mb_substr($desc, 0, 150) . "..." : $desc;
        
        $res[$id] += [
            "link"=>"<form class='fmk' action='http://farhangumejuikawa.com/kawe/result.php' method='post'><input type='hidden' name='strvar' value='{$res[$id]['title']}'><button type='submit'>{$res[$id]['title']}</button></form> ",
            "desc"=>$desc,
            ];
        $id++;
        $n++;
    }
    
}

if(empty($res)) die($null);

echo(json_encode($res));

?>