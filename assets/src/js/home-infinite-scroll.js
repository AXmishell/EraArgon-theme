//首页无限滚动加载
//仅在首页文章列表存在且 Pjax 开启时启用；无 JS 时保留原有分页按钮作为降级
import { initAfterLoad } from './utils/init-after-load';
import __ from './i18n';

var $ = window.$;

const SENTINEL_ID = 'home-infinite-scroll-sentinel';
const LOADING_DOTS_HTML = "<div class='loading-css-animation'><div class='loading-dot loading-dot-1' ></div><div class='loading-dot loading-dot-2' ></div><div class='loading-dot loading-dot-3' ></div><div class='loading-dot loading-dot-4' ></div><div class='loading-dot loading-dot-5' ></div><div class='loading-dot loading-dot-6' ></div><div class='loading-dot loading-dot-7' ></div><div class='loading-dot loading-dot-8' ></div></div>";
//首页无限滚动结束后的版权声明（fixed 全宽贴底，复用原 #footer 样式；挂在 body 底部，Pjax 导航不会重建）
const FOOTER_CREDIT_HTML = "<footer id='footer' class='site-footer card shadow-sm border-0 argon-infinite-scroll-footer'><div>Theme <a href='https://github.com/solstice23/argon-theme' target='_blank' rel='noopener'><strong>Argon</strong></a> * <a href='https://github.com/AXmishell/EraArgon-theme' target='_blank' rel='noopener'><strong>EraArgon</strong></a>" + (window.argonConfig && window.argonConfig.hide_footer_author == true ? "" : " By solstice23") + "</div></footer>";

let observer = null;
let sentinel = null;
let footerEl = null;
let footerObserver = null;
let nextUrl = null;
let loading = false;
let ended = false;

function getNextPageUrl(mainEl){
	let link = mainEl.querySelector('a[aria-label="Next Page"]');
	return link ? link.getAttribute("href") : null;
}

function hidePagination(mainEl){
	$(mainEl).find("nav").addClass("d-none");
}

function showPagination(mainEl){
	$(mainEl).find("nav").removeClass("d-none");
}

function setLoadingVisible(visible){
	if (!sentinel) return;
	$(".loading-css-animation", sentinel).toggleClass("d-none", !visible);
}

//存在服务端渲染的静态全宽页脚时，不再注入固定版权条，避免出现两个页脚
function hasStaticFooter(){
	return !!document.getElementById("site-footer");
}

function ensureFooter(){
	//已有静态页脚，跳过固定版权条
	if (hasStaticFooter()){
		return null;
	}
	//版权条挂在 body 底部（fixed 全宽），仅在无限滚动结束时显示
	if (footerEl && footerEl.parentNode){
		return footerEl;
	}
	let tpl = document.createElement("div");
	tpl.innerHTML = FOOTER_CREDIT_HTML.trim();
	footerEl = tpl.firstChild;
	document.body.appendChild(footerEl);
	return footerEl;
}

function hideFooter(){
	if (footerEl){
		footerEl.classList.remove("argon-footer-visible");
	}
}

function showFooter(){
	var el = ensureFooter();
	if (!el){
		return;
	}
	el.classList.add("argon-footer-visible");
}

//版权条随"没有更多文章了"元素进出视口而显隐：滚到底部出现，往上返回时自动隐藏
function observeFooterTrigger(){
	if (footerObserver){
		footerObserver.disconnect();
		footerObserver = null;
	}
	if (!sentinel){
		return;
	}
	let endEl = sentinel.querySelector(".home-infinite-scroll-end");
	if (!endEl || typeof IntersectionObserver === "undefined"){
		//无 IntersectionObserver 时退化为常显
		showFooter();
		return;
	}
	//底部内缩，避免结束提示刚进视口时被固定版权条遮挡
	footerObserver = new IntersectionObserver(function(entries){
		for (let i = 0; i < entries.length; i++){
			if (entries[i].isIntersecting){
				showFooter();
			}else{
				hideFooter();
			}
		}
	}, {rootMargin: "0px 0px -70px 0px"});
	footerObserver.observe(endEl);
}

function stopFooterTrigger(){
	if (footerObserver){
		footerObserver.disconnect();
		footerObserver = null;
	}
	hideFooter();
}

function setEndVisible(visible){
	if (!sentinel) return;
	$(".home-infinite-scroll-end", sentinel).toggleClass("d-none", !visible);
	if (visible){
		observeFooterTrigger();
	}else{
		stopFooterTrigger();
	}
}

function setErrorVisible(visible){
	if (!sentinel) return;
	$(".home-infinite-scroll-error", sentinel).toggleClass("d-none", !visible);
}

function createSentinel(){
	let el = document.createElement("div");
	el.id = SENTINEL_ID;
	el.className = "home-infinite-scroll-sentinel";
	el.style.padding = "24px 0 130px";
	el.style.textAlign = "center";
	el.innerHTML = LOADING_DOTS_HTML
		+ "<div class='home-infinite-scroll-end d-none'>" + __("没有更多文章了") + "</div>"
		+ "<div class='home-infinite-scroll-error d-none' style='cursor: pointer;'>" + __("加载失败，点击重试") + "</div>";
	$(el).on("click", ".home-infinite-scroll-error", function(){
		setErrorVisible(false);
		loadNextPage();
	});
	return el;
}

async function loadNextPage(){
	if (loading || ended || !nextUrl){
		return;
	}
	loading = true;
	setLoadingVisible(true);
	setErrorVisible(false);
	try{
		let resp = await fetch(nextUrl, {
			credentials: "same-origin",
			headers: {"X-Requested-With": "XMLHttpRequest"}
		});
		if (!resp.ok){
			throw new Error("HTTP " + resp.status);
		}
		let html = await resp.text();
		let doc = new DOMParser().parseFromString(html, "text/html");
		let newMain = doc.querySelector("#main");
		if (!newMain){
			throw new Error("response has no #main");
		}
		//提取新页面中 #main 下的文章卡片（排除分页 nav、脚本与 footer）
		let nodes = Array.prototype.filter.call(newMain.children, function(el){
			return el.tagName != "NAV" && el.tagName != "SCRIPT" && el.tagName != "STYLE" && el.tagName != "FOOTER";
		});
		if (nodes.length == 0){
			ended = true;
		}else{
			let mainEl = document.querySelector("#main.article-list-home");
			if (!mainEl){
				return;
			}
			let frag = document.createDocumentFragment();
			for (let i = 0; i < nodes.length; i++){
				frag.appendChild(nodes[i]);
			}
			//插入到分页 nav 之前，保持分页在列表末尾
			let nav = mainEl.querySelector("nav");
			if (nav){
				mainEl.insertBefore(frag, nav);
			}else{
				mainEl.appendChild(frag);
			}
			//更新下一页状态
			nextUrl = getNextPageUrl(newMain);
			if (!nextUrl){
				ended = true;
			}
			//重跑主题初始化，保证新卡片样式/懒加载/高亮正常
			initAfterLoad();
		}
		if (ended){
			//全部加载完成：停止观察并显示结束提示
			if (observer){
				observer.disconnect();
				observer = null;
			}
			setLoadingVisible(false);
			setEndVisible(true);
		}
	}catch(err){
		console.error("[Argon] 首页无限滚动加载失败:", err);
		//加载失败：重置锁并显示重试提示，同时恢复分页按钮作为降级导航
		setLoadingVisible(false);
		setErrorVisible(true);
		let mainEl = document.querySelector("#main.article-list-home");
		if (mainEl){
			showPagination(mainEl);
		}
	}finally{
		loading = false;
	}
}

function onIntersect(entries){
	if (loading || ended || !nextUrl){
		return;
	}
	for (let i = 0; i < entries.length; i++){
		if (entries[i].isIntersecting){
			loadNextPage();
			return;
		}
	}
}

function startObserving(){
	if (observer || !sentinel){
		return;
	}
	observer = new IntersectionObserver(onIntersect, {rootMargin: "600px 0px"});
	observer.observe(sentinel);
}

function init(){
	//清理上一次状态（Pjax 导航后 #main 已被替换）；版权条先隐藏，待滚到底部时再显示
	stopFooterTrigger();
	if (observer){
		observer.disconnect();
		observer = null;
	}
	if (sentinel && sentinel.parentNode){
		sentinel.parentNode.removeChild(sentinel);
	}
	sentinel = null;
	nextUrl = null;
	loading = false;
	ended = false;

	let mainEl = document.querySelector("#main.article-list-home");
	if (!mainEl){
		return;
	}
	if (window.argonConfig.disable_pjax == true){
		return;
	}
	nextUrl = getNextPageUrl(mainEl);
	if (!nextUrl){
		//只有一页，无需无限滚动
		return;
	}
	//确保固定版权条存在于 body（初始隐藏，结束提示出现时再显示）
	ensureFooter();
	//隐藏分页按钮（仅 JS 生效时；DOM 保留，无 JS 时仍可翻页）
	hidePagination(mainEl);
	sentinel = createSentinel();
	mainEl.appendChild(sentinel);
	//首次滚动后才开始观察，保证初始只显示第 1 页
	window.addEventListener("scroll", startObserving, {once: true, passive: true});
}

document.addEventListener("DOMContentLoaded", init);
//Pjax 导航完成后重新初始化（首页进入/离开均会触发）
$(document).on("pjax:complete", init);