/* Globals */
const q = document.querySelector('input[name=q]')

/* Events */
document.querySelector('#frmS').addEventListener('submit', e => {
	e.preventDefault()
	search()
})
window.addEventListener('load', search)

/* Functions */
function search() {
	const query = q.value.trim()
	if(!query) {
		q.focus()
		return
	}
	
	search_wikipedia(query, '#res_wikipedia')
	search_wiktionary(query, '#res_wiktionary')
	search_farhangumejuikawa(query, '#res_farhangumejuikawa')
	search_ferheng(query, '#res_ferheng')
	search_dictio(query, '#res_dictio')
	search_vejin(query, '#res_vejin')
	search_tewar_2(query, '#res_tewar_2')
	search_ferheng_org(query, '#res_ferheng_org')
}
function search_ferheng(q, t) {
	const dict = 'فەرهەنگی ئەناهیتا'
	t = document.querySelector(t)
	t.innerHTML = get_loader(dict)
	get_json(`search/ferheng.info.php?q=${q}&n=3`, res => {
		if(res == null) {
			t.innerHTML = ''
			return
		}
		
		let html = ''
		for(const r of res) {
			html += '<div><section><span class="tp">' +
				dict +
				'</span><a rel=' +
				'"noopener noreferrer nofollow" ' +
				'href="' + r.link + '">' +
				r.title + '</a></section>' +
				'<section>' + r.desc +
				'</section></div>'
		}
		t.innerHTML = html
	})
}
function search_farhangumejuikawa(q, t) {
	const dict = 'فەرهەنگی کاوە'
	t = document.querySelector(t)
	t.innerHTML = get_loader(dict)
	get_json(`search/farhangumejuikawa.com.php?q=${q}&n=3`, res => {
		if(res == null) {
			t.innerHTML = ''
			return
		}

		let html = ''
		for(const r of res) {
			html += '<div><section><span class="tp">' +
				dict +
				'</span>' +
				r.link +
				'</section>' +
				'<section>' + r.desc +
				'</section></div>'
		}
		t.innerHTML = html
	})
}
function search_dictio(q, t) {
	const dict = 'دیکتیۆ'
	t = document.querySelector(t)
	t.innerHTML = get_loader(dict)
	get_json(`search/dictio.kurditgroup.org.php?q=${q}&n=3`, res=>{
		if(res == null) {
			t.innerHTML = ''
			return
		}

		let html = ''
		for(const r of res) {
			html += '<div><section><span class="tp">' +
				dict +
				'</span>' +
				'<a rel=' +
				'"noopener noreferrer nofollow" ' +
				'href="' + r.url + '">' +
				q + '</a></section>' + 
				'<section>' + r.text +
				'</section></div>'
		}
		t.innerHTML = html
	})
}
function search_wiktionary(q, t) {
	const dict = 'ویکیفەرهەنگ'
	t = document.querySelector(t)
	t.innerHTML = get_loader(dict)
	get_json(`search/ku.wiktionary.org.php?q=${q}&n=3`, res => {
		if(res == null) {
			t.innerHTML = ''
			return
		}
		if(res.query.searchinfo.totalhits == 0) {
			t.innerHTML = ''
			return
		}
		
		let html = ''
		const rqs = res.query.search
		for(const r of rqs) {
			html += '<div><section><span class="tp">' +
				dict +
				'</span><a rel=' +
				'"noopener noreferrer nofollow" href' +
				'="https://ku.wiktionary.org/wiki/' +
				encodeURIComponent(r.title) +
				'">' + r.title + '</a></section>' + 
				'<section>' + r.snippet +
				'</section></div>'
		}
		t.innerHTML = html
	})
}
function search_wikipedia(q, t) {
	const dict = 'ویکیپیدیا'
	t = document.querySelector(t)
	t.innerHTML = get_loader(dict)
	get_json(`search/ckb.wikipedia.org.php?q=${q}&n=3`, res => {
		if(res == null) {
			t.innerHTML = ''
			return
		}		
		if(res.query.searchinfo.totalhits == 0) {
			t.innerHTML = ''
			return
		}
		
		let html = ''
		const rqs = res.query.search
		for(const r of rqs) {
			html += '<div><section><span class="tp">' +
				dict +
				'</span><a rel=' +
				'"noopener noreferrer nofollow" href' +
				'="https://ckb.wikipedia.org/wiki/' +
				encodeURIComponent(r.title) +
				'">' + r.title + '</a></section>' +
				'<section>' + r.snippet +
				'</section></div>'
		}
		t.innerHTML = html
	})
}
function search_vejin(q, t) {
	const dict = 'فەرهەنگەکانی ڤەژین'
	t = document.querySelector(t)
	t.innerHTML = get_loader(dict)
	get_json(`search/lex.vejin.net.php?q=${q}&n=3`, res => {
		if(res == null) {
			t.innerHTML = ''
			return
		}

		let html = ''
		for(const r of res) {
			html += '<div><section><span class="tp">' +
				dict + ' - ' + r.wordlist +
				'</span><a rel=' +
				'"noopener noreferrer nofollow" ' +
				'href="' + r.url + '">' +
				r.title + '</a></section>' + 
				'<section>' + r.def +
				'</section></div>'
		}
		t.innerHTML = html
	})
}
function search_tewar_2(q, t) {
	const dict = 'تەوار - وەشانی ٢'
	t = document.querySelector(t)
	t.innerHTML = get_loader(dict)
	get_json(`search/tewar-2.php?q=${q}&n=3`, res => {
		if(res == null) {
			t.innerHTML = ''
			return
		}
		
		let html = ''
		for(const r of res) {
			html += '<div><section><span class="tp">' +
				dict +
				'</span><a rel=' +
				'"noopener noreferrer nofollow" ' +
				'href="' + r.url + '">' +
				r.word + '</a></section>' +
				'<section>' + r.mean +
				'</section></div>'
		}
		t.innerHTML = html
	})
}
function search_ferheng_org(q, t) {
	const dict = 'Ferheng.org'
	t = document.querySelector(t)
	t.innerHTML = get_loader(dict)
	get_json(`search/ferheng.org.php?q=${q}&n=3`, res => {
		if(res == null) {
			t.innerHTML = ''
			return
		}

		const langs = {
			kurd: 'کوردی',
			eng: 'ئینگلیسی',
			turk: 'تورکی',
			ger: 'ئاڵمانی',
			zaza: 'زازاکی'
		}
		
		let html = ''
		for(const r of res) {
			const dict_name = r.dict
			delete r.dict
			html += '<div><section><span class="tp">' +
				dict + ' - ' + dict_name +
				'</span></section><section>'
			for(const lang in r) {
				html += '<p>' +
					`${langs[lang]}: ${r[lang]}` +
					'</p>'
			}
			html += '</section></div>'
		}
		t.innerHTML = html
	})
}
function clear_screen(e) {
	e.preventDefault()
	q.value = ''
	document.querySelectorAll('#res div').forEach(
		d => d.innerHTML = '')
	search()
}
function get_url(url, callback) {
	const x = new XMLHttpRequest
	x.open('get', url)
	x.onload = e => callback(x.responseText)
	x.send()
}
function get_json(url, callback) {
	get_url(url, txt => callback(JSON.parse(txt)))
}
function get_loader(dict) {
	return `<section style="margin:.5em 0">` +
		`<span class="tp">${dict} ` +
		`<div class="loader" style="display:inline-block;` +
		`vertical-align:middle"></div></span></section>`
}
