<?php
header("Content-type: application/json; Charset=UTF-8");
$null = json_encode(null);

$q = isset($_GET['q']) ?
     urlencode(filter_var(
	     $_GET['q'],
	     FILTER_SANITIZE_STRING)) : die($null);
$url = "https://dictio.kurditgroup.org/?q=$q";
$html = @file_get_contents($url) or die($null);
$dom = new DOMDocument;
@$dom->loadHTML($html);

$res = [];
$lmt = filter_var(@$_GET['n'], FILTER_VALIDATE_INT) ?
       $_GET['n'] : 10;
$n = 0;

foreach($dom->getElementsByTagName("div") as $div) {
	if($n == $lmt) break;
	if($div->getAttribute("class") == "result ltr" or
		$div->getAttribute("class") == "result rtl")
	{
		$text = filter_var($div->nodeValue, FILTER_SANITIZE_STRING);
		$text = mb_strlen($text) > 150 ?
			mb_substr($text, 0, 150) . "..." : $text;	
		$res[] = [
			"text" => $text,
		];
		
		$n++;
	}
}

if(empty($res)) die($null);
echo(json_encode($res));
?>
