<?php
header("Content-type: application/json; Charset=UTF-8");
$null = json_encode(null);

$q = isset($_GET['q']) ?
     urlencode(filter_var(
	 $_GET['q'],
	 FILTER_SANITIZE_STRING)) : die($null);
$url = "http://dictio.kurditgroup.org/dictio/$q";
$html = @file_get_contents($url) or die($null);
$dom = new DOMDocument;
@$dom->loadHTML($html);

$res = [];
$lmt = filter_var(@$_GET['n'], FILTER_VALIDATE_INT) ?
       $_GET['n'] : 10;
$n = 0;

foreach($dom->getElementsByTagName("div") as $div) {
    if($n == $lmt)  break;
    
    if($div->getAttribute("class") ==
	"translation clear direct parent " or
	$div->getAttribute("class") ==
	    "translation clear index parent ")
    {
        $ckb = filter_var(
	    $div->getElementsByTagName("div")[2]->nodeValue,
	    FILTER_SANITIZE_STRING);
        $ckb = mb_strlen($ckb) > 150 ?
	       mb_substr($ckb, 0, 150) . "..." : $ckb;
        $en = filter_var(
	    $div->getElementsByTagName("div")[1]->nodeValue,
	    FILTER_SANITIZE_STRING);
        $en = mb_strlen($en) > 150 ?
	      mb_substr($en, 0, 150) . "..." : $en;
	
        $res[] = [
            "ckb" => $ckb,
            "en" => $en,
        ];

        $n++;
    }
}

if(empty($res)) die($null);
echo(json_encode($res));
?>
