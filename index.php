<!DOCTYPE HTML>

<html lang="ckb" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            تەوار <?php if(!empty($_GET['q'])) { echo "&rsaquo; " . htmlspecialchars($_GET['q']); } ?>
        </title>
        <meta name="keywords" content="واتای وشە,مانای وشە,فەرهەنگی کوردی">
        <meta name="description" content="گەڕان بۆ واتای وشە لە پێنج فەرهەنگی کوردی">

        <style>
            html {
                height:100%;
            }
            body {
                margin:0;
                font-family:'kurd', arial;
                background: #fafafa;
                font-size:18px;
                height:100%;
                display: flex;
                flex-direction: column;
            }
            @font-face{font-family:'kurd';font-style:normal;font-weight:400;src:url('/style/font/DroidNaskh-Regular.woff') format('woff');font-display:swap;}
            @media only screen and (min-width:600px) {
                body {
                    font-size:22px;
                }
            }
            
            h1, form, input, button, a {
                font-family: inherit;
                box-sizing: border-box;
                transition: .15s ease;
                -webkit-transition: .15s ease;
            }
            
            h1 {
                font-weight:normal;
            }
            
            #frmS input[name=q] {
                display:block;
                width:100%;
                max-width:600px;
                margin:auto;
                padding:1em;
                border: 1px solid #f6f6f6;
                box-shadow: 0 5px 10px -12px;
                outline: 0;
                -webkit-appearance: none;
                appearance:none;
                font-size:.8em;
                border-radius:0;
            }
            #frmS button[type=submit] {
                display:block;
                padding:.8em 3em;
                background:#f0f0f0;
                color:#444;
                margin: 1em auto 0;
                box-shadow:0 4px 5px -5px #aaa;
                outline:0;
                border:0;
                -webkit-appearance: none;
                appearance:none;
                font-size:.8em;
                border-radius:2px;
            }
            #frmS button[type=submit]:hover {
                background:#e6e6e6;
            }
            #frmS input[name=q]:focus {
                border:1px solid #ddd;
            }
            .fmk button {
                color: #00e;
                text-decoration: underline;
                border:0;
                outline:0;
                -webkit-appearance: none;
                background: none;
                cursor:pointer;
                font-size:1em;
                padding:0;
            }
            
            @keyframes loading {
                0% {
                    background: #999;
                }
                10% {
                    background: #aaa;
                    transform: scale(.5);
                }
                70% {
                    background: #666;
                    transform: scale(.8);
                }
                100% {
                    background: #999;
                }
            }
            
            #res {
                max-width: 850px;
                margin: auto;
                padding: 1em;
            }
            
            #res_ferheng div, #res_dictiwa div, #res_farhangumejuikawa div, #res_dictio div, #res_wiktionary div, #res_googleTranslate div {
                margin: 1em auto;
                
            }
            
            #res_ferheng div section:nth-child(even), #res_dictiwa div section:nth-child(even), #res_farhangumejuikawa div section:nth-child(even), #res_dictio div section:nth-child(even), #res_wiktionary div section:nth-child(even), #res_googleTranslate div section:nth-child(even) {
                font-size: .7em;
                word-wrap: break-word;
            }
            
            .tp {
                background: #eee;
                display: block;
                padding: .6em;
                color: #222;
                font-size: .85em;
            }
            small a:link, small a:visited {
                color:#00e;
                text-decoration:none;
            }
            small a:hover {
                text-decoration:underline;
            }
            .loader {
                width:1.5em;
                height:1.5em;
                border-radius:100%;
                animation:loading 1s ease infinite;
                margin:1em auto;
                display:block;
            }
            @keyframes loaded {
                0% {
                    opacity:0;
                }
                100% {
                    opacity:1;
                }
            }
            footer {
                margin: 1em auto;
                border-top: 1px solid #ddd;
                padding: 1em 0;
                max-width:800px;
                width:90%;
            }
            footer a {
                font-size:.8em;
                color:#555;
                border-bottom:1px solid #ccc;
                padding:.8em .5em;
                text-decoration:none;
                margin:0 1em;
            }
            footer a:hover {
                background:#eee;
                border-bottom:0;
            }
        </style>
    </head>
    <body style="animation: loaded .8s ease forwards">
    <div style="flex: 1 0 auto;">
        <h1 style='text-align:center;margin:0;padding:.5em 0 .3em;font-size:3em'><a style="text-decoration:none;color:black;" href='index.php'>
            تەوار
        </a></h1>
        <small style="font-size: .7em;color: #444;text-align: center;display: block;margin-bottom:1em">
            گەڕان بۆ واتای وشە لە پێنج فەرهەنگ‌دا
            <div style='font-size:.95em'>
                <a target='_blank' rel='noopener noreferrer nofollow' href="http://ferheng.info/">
                ئەناهیتا
                </a>
                &bull;
                <a target='_blank' rel='noopener noreferrer nofollow' href="https://dictiwa.com/">
                هیوا
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
            </div>
        </small>
        <form id="frmS" method="GET">
            <input type="text" name="q" value="<?php if(!empty($_GET['q'])) { echo htmlspecialchars($_GET['q']); } ?>" placeholder="وشە..." >
            <button type="submit">گەڕان</button>
        </form>
        
        <div id="res">
            <div id="res_dictiwa"></div>
            <div id="res_farhangumejuikawa"></div>
            <div id="res_ferheng"></div>
            <div id="res_wiktionary"></div>
            <div id="res_dictio"></div>
        </div>
    </div>
        
        
        <footer style="text-align:center;flex-shrink: 0;">
            <a href="/">
                ئاڵەکۆک
            </a>
            <a href="dev.html">
                کۆد
            </a>
        </footer>
    
        <script>
            const loader = "<div class='loader'></div>";
            const q = document.querySelector("input[name=q]");
        
            document.querySelector("#frmS").addEventListener("submit", function(e) {
                
                e.preventDefault();
                
                
                if( q.value == "" )   { q.focus(); return; }
                
                search();
            });
            
            function search() {
                search_wiktionary ( q.value, "#res_wiktionary" )
                search_dictiwa ( q.value, "#res_dictiwa" );
                search_farhangumejuikawa ( q.value, "#res_farhangumejuikawa" );
                search_ferheng ( q.value, "#res_ferheng" );
                search_dictio ( q.value, "#res_dictio" );

                window.history.pushState({q : q.value}, "", `?q=${q.value}`);
                document.title = `تەوار › ${q.value}`;
            }
            
            
            function search_ferheng (q, t) {
                t = document.querySelector(t);
                t.innerHTML = loader;
                var res, fin = "";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function() {
                    
                    if (this.responseText == "null") {
                        t.innerHTML = "";
                        return;
                    }
                    
                    var res = JSON.parse(this.responseText);
                    
                    fin += "<span class='tp'>فەرهەنگی ئەناهیتا: </span>";
                    
                    for( var a in res ) {
                        
                        fin += "<div><section><a rel='noopener noreferrer nofollow' href='"+res[a].link+"'>"+res[a].title+"</a></section>";
                        fin += "<section>"+res[a].desc+"</section></div>";
                    }
                    
                    t.style.animation="loaded 1s ease forwards";
                    t.innerHTML = fin;
                }
                xmlhttp.open("get", `ferheng.info.php?q=${q}&n=3`, true);
                xmlhttp.send();
            }
            
            function search_dictiwa (q, t) {
                t = document.querySelector(t);
                t.innerHTML = loader;
                var res, fin = "";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function() {
                    
                    if (this.responseText == "null") {
                        t.innerHTML = "";
                        return;
                    }
                    
                    var res = JSON.parse(this.responseText);
                    
                    fin += "<span class='tp'>فەرهەنگی هیوا: </span>";
                    
                    for( var a in res ) {
                        
                        fin += "<div><section><a rel='noopener noreferrer nofollow' href='"+res[a].link+"'>"+res[a].title+"</a></section>";
                        fin += "<section>"+res[a].desc+"</section></div>";
                    }
                    
                    t.style.animation="loaded 1s ease forwards";
                    t.innerHTML = fin;
                }
                xmlhttp.open("get", `dictiwa.com.php?q=${q}&n=3`, true);
                xmlhttp.send();
            }
            
            function search_farhangumejuikawa (q, t) {
                t = document.querySelector(t);
                t.innerHTML = loader;
                var res, fin = "";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function() {
                    
                    if (this.responseText == "null") {
                        t.innerHTML = "";
                        return;
                    }
                    
                    var res = JSON.parse(this.responseText);
                    
                    fin += "<span class='tp'>فەرهەنگی کاوە: </span>";
                    
                    for( var a in res ) {
                        
                        fin += "<div><section>"+res[a].link+"</section>";
                        fin += "<section>"+res[a].desc+"</section></div>";
                    }
                    
                    t.style.animation="loaded 1s ease forwards";
                    t.innerHTML = fin;
                }
                xmlhttp.open("get", `farhangumejuikawa.com.php?q=${q}&n=3`, true);
                xmlhttp.send();
            }
            function search_dictio (q, t) {
                t = document.querySelector(t);
                t.innerHTML = loader;
                var res, fin = "";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function() {
                    
                    if (this.responseText == "null") {
                        t.innerHTML = "";
                        return;
                    }
                    
                    var res = JSON.parse(this.responseText);
                    
                    fin += "<span class='tp'>دیکتیۆ: </span>";
                    
                    for( var a in res ) {
                        
                        fin += "<div><section>"+res[a].en+"</section>";
                        fin += "<section>"+res[a].ckb+"</section></div>";
                    }
                    
                    t.style.animation="loaded 1s ease forwards";
                    t.innerHTML = fin;
                }
                xmlhttp.open("get", `dictio.kurditgroup.org.php?q=${q}&n=3`, true);
                xmlhttp.send();
            }
            
            function search_wiktionary (q, t) {
                t = document.querySelector(t);
                t.innerHTML = loader;
                var res, fin = "";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function() {
                    
                    if (this.responseText == "null") {
                        t.innerHTML = "";
                        return;
                    }
                    
                    var res = JSON.parse(this.responseText);
                    
                    if(res.query.searchinfo.totalhits == 0) {
                        t.innerHTML = "";
                        return;
                    }
                    
                    fin += "<span class='tp'>ویکیفەرهەنگ: </span>";
                    
                    var rqs = res.query.search;
                    
                    for( var a in rqs ) {
                        
                        fin += "<div><section><a rel='noopener noreferrer nofollow' href='https://ku.wiktionary.org/wiki/"+encodeURIComponent(rqs[a].title)+"'>"+rqs[a].title+"</a></section>";
                        fin += "<section>"+rqs[a].snippet+"</section></div>";
                    }
                    
                    t.style.animation="loaded 1s ease forwards";
                    t.innerHTML = fin;
                }
                xmlhttp.open("get", `ku.wiktionary.org.php?q=${q}&n=3`, true);
                xmlhttp.send();
            }
            
            <?php if(!empty($_GET['q'])) { ?>
                search();
            <?php } ?>
        </script>
        
    </body>
    
</html>