<?php
header("Content-type: application/json; Charset=UTF-8");
$null = json_encode(null);

$q = isset($_GET['q']) ?
     urlencode(filter_var(
	     $_GET['q'],
	     FILTER_SANITIZE_STRING)) : die($null);
$url = "https://dictio.kurditgroup.org/dictio/$q";
$html = @file_get_contents($url) or die($null);
$dom = new DOMDocument;
@$dom->loadHTML($html);

$res = [];
$lmt = filter_var(@$_GET['n'], FILTER_VALIDATE_INT) ?
       $_GET['n'] : 10;
$n = 0;

foreach($dom->getElementsByTagName("div") as $div) {
	if($n == $lmt) break;
	if(strpos($div->getAttribute("class"), "dictio-result") !== FALSE)
	{
		$text = filter_var($div->nodeValue, FILTER_SANITIZE_STRING);
		$text = preg_replace("/^\s+/um", "", $text);
		$text = preg_replace("/\s+$/um", "", $text);
		$text = trim($text);
		$text = str_replace("\n", " - ", $text);

		$text = mb_strlen($text) > 150 ?
			mb_substr($text, 0, 150) . "..." : $text;	
		$res[] = [
			"text" => $text,
			"url" => $url,
		];
		
		$n++;
		break;
	}
}

if(empty($res)) die($null);
echo(json_encode($res));
?>
