<!DOCTYPE HTML>
<html lang="ckb" dir="rtl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			تەوار
			<?php
			if(isset($_GET['q']))
				echo "&rsaquo; " . htmlspecialchars($_GET['q']);
			?>
		</title>
		<meta name="keywords" content="واتای وشە,مانای وشە,فەرهەنگی کوردی">
		<meta name="description" content="گەڕان بۆ واتای وشە لە حەوت فەرهەنگی کوردی">
		{SERVICE_WORKER}
		{STYLE}
	</head>
	<body style="animation: loaded .8s ease forwards">
		<div style="flex: 1 0 auto;">
			<h1 style='text-align:center;margin:0 1em;padding:.5em 0 0;font-size:2em'><a style="text-decoration:none;color:black;" href='index.php'>
				تەوار
			</a></h1>
			<small style="font-size: .7em;color: #444;display: block;margin: 0 1em 0">
				گەڕان بۆ واتای وشە لە فەرهەنگەکانی: 
				<div style='font-size:.95em'>
					<a target='_blank' rel='noopener noreferrer nofollow' href="http://ferheng.info/">
						ئەناهیتا
					</a>
					&bull;
					<a target='_blank' rel='noopener noreferrer nofollow' href="http://farhangumejuikawa.com/kawe/">
						کاوە
					</a>
					&bull;
					<a target='_blank' rel='noopener noreferrer nofollow' href="http://dictio.kurditgroup.org/">
						دیکتیۆ
					</a>
					&bull;
					<a target='_blank' rel='noopener noreferrer nofollow' href="https://ku.wiktionary.org/">
						ویکیفەرهەنگ
					</a>
					&bull;
					<a target='_blank' rel='noopener noreferrer nofollow' href="https://ckb.wikipedia.org/">
						ویکیپیدیا
					</a>
					&bull;
					<a target='_blank' rel='noopener noreferrer nofollow' href="https://lex.vejinbooks.com/">
						فەرهەنگەکانی ڤەژین
					</a>
					&bull;
					<a target='_blank' rel='noopener noreferrer nofollow' href="https://allekok.ir/tewar/">
						تەوار - وەشانی ٢
					</a>
				</div>
			</small>
			<form id="frmS" method="GET">
				<input type="text" name="q"
				       value="<?php 
					      if(isset($_GET['q'])) 
						      echo htmlspecialchars($_GET['q']); 
					      ?>" placeholder="وشە..." >
				<button type="submit">گەڕان &rsaquo;</button>
			</form>
			
			<div id="res">
				<div id="res_tewar_2"></div>
				<div id="res_vejin"></div>
				<div id="res_farhangumejuikawa"></div>
				<div id="res_ferheng"></div>
				<div id="res_wikipedia"></div>
				<div id="res_wiktionary"></div>
				<div id="res_dictio"></div>
			</div>
		</div>
		
		<footer style="text-align:center;flex-shrink:0">
			<a href="https://allekok.github.io/donate/"
			   style="color:#00E">
				یارمەتیی ماڵی
			</a>
			<a href="dev.html">
				کۆد
			</a>
			<a href="https://allekok.github.io/">
				بەرنامەکانی ئاڵەکۆک
			</a>
		</footer>
		{SCRIPT}
	</body>    
</html>
