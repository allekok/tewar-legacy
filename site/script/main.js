const loader = "<div class='loader'></div>";
const q = document.querySelector("input[name=q]");

document.querySelector("#frmS").addEventListener("submit", function(e) {
	e.preventDefault();
	search();
});

function search() {
	const query = q.value.trim();
	if(! query)
	{
		q.focus();
		return;
	}
	
	search_wikipedia ( query, "#res_wikipedia" );
	search_wiktionary ( query, "#res_wiktionary" );
	search_farhangumejuikawa ( query, "#res_farhangumejuikawa" );
	search_ferheng ( query, "#res_ferheng" );
	search_dictio ( query, "#res_dictio" );
	search_vejin ( query , "#res_vejin" );
	search_tewar_2 ( query , "#res_tewar_2" );
	
	window.history.pushState({q : query}, "", `?q=${query}`);
	document.title = `تەوار › ${query}`;
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
		
		for( var a in res ) {
			
			fin += "<div><section><span class='tp'>فەرهەنگی ئەناهیتا</span><a rel='noopener noreferrer nofollow' href='"+res[a].link+"'>"+res[a].title+"</a></section>";
			fin += "<section>"+res[a].desc+"</section></div>";
		}
		
		t.style.animation="loaded 1s ease forwards";
		t.innerHTML = fin;
	}
	xmlhttp.open("get", `search/ferheng.info.php?q=${q}&n=3`);
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
		
		for( var a in res ) {
			
			fin += "<div><section><span class='tp'>فەرهەنگی کاوە</span>"+res[a].link+"</section>";
			fin += "<section>"+res[a].desc+"</section></div>";
		}
		
		t.style.animation="loaded 1s ease forwards";
		t.innerHTML = fin;
	}
	xmlhttp.open("get", `search/farhangumejuikawa.com.php?q=${q}&n=3`);
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
		
		for( var a in res ) {
			
			fin += "<div><section><span class='tp'>دیکتیۆ</span>";
			fin += "<a rel='noopener noreferrer nofollow' href='"+res[a].url+"'>"+q+"</a></section>";
			fin += "<section>"+res[a].text+"</section></div>";
		}
		
		t.style.animation="loaded 1s ease forwards";
		t.innerHTML = fin;
	}
	xmlhttp.open("get", `search/dictio.kurditgroup.org.php?q=${q}&n=3`);
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
		
		var rqs = res.query.search;
		
		for( var a in rqs ) {
			
			fin += "<div><section><span class='tp'>ویکیفەرهەنگ</span><a rel='noopener noreferrer nofollow' href='https://ku.wiktionary.org/wiki/"+encodeURIComponent(rqs[a].title)+"'>"+rqs[a].title+"</a></section>";
			fin += "<section>"+rqs[a].snippet+"</section></div>";
		}
		
		t.style.animation="loaded 1s ease forwards";
		t.innerHTML = fin;
	}
	xmlhttp.open("get", `search/ku.wiktionary.org.php?q=${q}&n=3`);
	xmlhttp.send();
}

function search_wikipedia (q, t) {
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
		
		var rqs = res.query.search;
		
		for( var a in rqs ) {
			
			fin += "<div><section><span class='tp'>ویکیپیدیا </span><a rel='noopener noreferrer nofollow' href='https://ckb.wikipedia.org/wiki/"+encodeURIComponent(rqs[a].title)+"'>"+rqs[a].title+"</a></section>";
			fin += "<section>"+rqs[a].snippet+"</section></div>";
		}
		
		t.style.animation="loaded 1s ease forwards";
		t.innerHTML = fin;
	}
	xmlhttp.open("get", `search/ckb.wikipedia.org.php?q=${q}&n=3`);
	xmlhttp.send();
}

function search_vejin (q, t) {
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
		
		for( var a in res ) {
			
			fin += "<div><section><span class='tp'>فەرهەنگەکانی ڤەژین: "+res[a].wordlist+"</span><a rel='noopener noreferrer nofollow' href='"+res[a].url+"'>"+res[a].title+"</a></section>";
			fin += "<section>"+res[a].def+"</section></div>";
		}
		
		t.style.animation="loaded 1s ease forwards";
		t.innerHTML = fin;
	}
	xmlhttp.open("get", `search/lex.vejinbooks.com.php?q=${q}&n=3`);
	xmlhttp.send();
}

function search_tewar_2 (q, t) {
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
		
		for( var a in res ) {
			
			fin += "<div><section><span class='tp'>تەوار - وەشانی ٢</span><a rel='noopener noreferrer nofollow' href='"+res[a].url+"'>"+res[a].word+"</a></section>";
			fin += "<section>"+res[a].mean+"</section></div>";
		}
		
		t.style.animation="loaded 1s ease forwards";
		t.innerHTML = fin;
	}
	xmlhttp.open("get", `search/tewar-2.php?q=${q}&n=3`);
	xmlhttp.send();
}

window.addEventListener('load', function () {
	search();
});
