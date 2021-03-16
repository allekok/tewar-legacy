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
$pages = 1;
$n = 0;

for($pg=1; $pg<=$pages; $pg++) {
	
	$url = "http://ferheng.info/page/$pg/?s=$q";
	$html = @file_get_contents($url) or die($null);    
	$dom = new DOMDocument;
	@$dom->loadHTML($html);

	foreach($dom->getElementsByTagName("article") as $art)
	{
		$h2 = $art->getElementsByTagName("h2")[0];
		$title = filter_var($h2->nodeValue,
				    FILTER_SANITIZE_STRING);
		$link = filter_var($h2->getElementsByTagName("a")[0]
				      ->getAttribute("href"),
				   FILTER_SANITIZE_STRING);
		$desc = filter_var($art->getElementsByTagName("div")[0]
				       ->nodeValue,
				   FILTER_SANITIZE_STRING);
		$desc = mb_strlen($desc) > 150 ?
			mb_substr($desc, 0, 150) . "..." : $desc; 
		
		if(stristr($link, "alfba")) {
			$res[] = [
				"stristr" =>
					(stristr($title, $q0) or
						stristr($q0, $title)),
				"rank" =>
					(similar_text($title, $q0) /
						mb_strlen($title)),
				"title" => $title,
				"link" => $link,
				"desc" => $desc,
			];
		}
	}
}

if(empty($res)) die($null);

rsort($res);

$res2 = [];
foreach($res as $r) {
	if($lmt == $n)  break;
	$res2[] = $r;
	$n++;
}

echo(json_encode($res2));
?>
