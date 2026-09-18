//首页文章加载核心：与具体模式无关的公共逻辑
//负责状态管理、下一页抓取与解析、文章追加、分页显隐、结束/失败 UI、页脚版权条触发
//三种模式的差异（无限滚动 / 加载更多）由对应控制器通过 setController() 注入
import { initAfterLoad } from '../utils/init-after-load';
import __ from '../i18n';

var $ = window.$;

const SENTINEL_ID = 'home-infinite-scroll-sentinel';
const LOADING_DOTS_HTML = "<div class='loading-css-animation'><div class='loading-dot loading-dot-1' ></div><div class='loading-dot loading-dot-2' ></div><div class='loading-dot loading-dot-3' ></div><div class='loading-dot loading-dot-4' ></div><div class='loading-dot loading-dot-5' ></div><div class='loading-dot loading-dot-6' ></div><div class='loading-dot loading-dot-7' ></div><div class='loading-dot loading-dot-8' ></div></div>";
//首页无限滚动结束后的版权声明（fixed 全宽贴底，复用原 #footer 样式；挂在 body 底部，Pjax 导航不会重建）
const FOOTER_CREDIT_HTML = "<footer id='footer' class='site-footer card shadow-sm border-0 argon-infinite-scroll-footer'><div>Theme <a href='https://github.com/solstice23/argon-theme' target='_blank' rel='noopener'><strong>Argon</strong></a> * <a href='https://github.com/AXmishell/EraArgon-theme' target='_blank' rel='noopener'><strong>EraArgon</strong></a>" + (window.argonConfig && window.argonConfig.hide_footer_author == true ? "" : " By solstice23") + "</div></footer>";

//共享状态：各模式控制器直接读写 state 上的字段
export const state = {
	mode: null,
	observer: null,
	sentinel: null,
	footerEl: null,
	footerObserver: null,
	nextUrl: null,
	loading: false,
	ended: false
};

//当前控制器（无限滚动 / 加载更多），提供生命周期钩子
let controller = null;

export function setController(c){
	controller = c || null;
}

export function getController(){
	return controller;
}

export function getNextPageUrl(mainEl){
	let link = mainEl.querySelector('a[aria-label="Next Page"]');
	return link ? link.getAttribute("href") : null;
}

export function hidePagination(mainEl){
	$(mainEl).find("nav").addClass("d-none");
}

export function showPagination(mainEl){
	$(mainEl).find("nav").removeClass("d-none");
}

export function setLoadingVisible(visible){
	if (!state.sentinel) return;
	$(".loading-css-animation", state.sentinel).toggleClass("d-none", !visible);
}

function setEndVisible(visible){
	if (!state.sentinel) return;
	$(".home-infinite-scroll-end", state.sentinel).toggleClass("d-none", !visible);
	if (visible){
		observeFooterTrigger();
	}else{
		stopFooterTrigger();
	}
}

function setErrorVisible(visible){
	if (!state.sentinel) return;
	$(".home-infinite-scroll-error", state.sentinel).toggleClass("d-none", !visible);
}

//存在服务端渲染的静态全宽页脚时，不再注入固定版权条，避免出现两个页脚
function hasStaticFooter(){
	return !!document.getElementById("site-footer");
}

export function ensureFooter(){
	//已有静态页脚，跳过固定版权条
	if (hasStaticFooter()){
		return null;
	}
	//版权条挂在 body 底部（fixed 全宽），仅在无限滚动结束时显示
	if (state.footerEl && state.footerEl.parentNode){
		return state.footerEl;
	}
	let tpl = document.createElement("div");
	tpl.innerHTML = FOOTER_CREDIT_HTML.trim();
	state.footerEl = tpl.firstChild;
	document.body.appendChild(state.footerEl);
	return state.footerEl;
}

function hideFooter(){
	if (state.footerEl){
		state.footerEl.classList.remove("argon-footer-visible");
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
	if (state.footerObserver){
		state.footerObserver.disconnect();
		state.footerObserver = null;
	}
	if (!state.sentinel){
		return;
	}
	let endEl = state.sentinel.querySelector(".home-infinite-scroll-end");
	if (!endEl || typeof IntersectionObserver === "undefined"){
		//无 IntersectionObserver 时退化为常显
		showFooter();
		return;
	}
	//底部内缩，避免结束提示刚进视口时被固定版权条遮挡
	state.footerObserver = new IntersectionObserver(function(entries){
		for (let i = 0; i < entries.length; i++){
			if (entries[i].isIntersecting){
				showFooter();
			}else{
				hideFooter();
			}
		}
	}, {rootMargin: "0px 0px -70px 0px"});
	state.footerObserver.observe(endEl);
}

function stopFooterTrigger(){
	if (state.footerObserver){
		state.footerObserver.disconnect();
		state.footerObserver = null;
	}
	hideFooter();
}

//无限滚动模式的哨兵：始终可见的加载动画 + 结束/失败提示
export function createSentinel(){
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

//加载更多模式的容器：按钮 + 按需显示的加载动画 + 结束/失败提示
export function createLoadMore(){
	let el = document.createElement("div");
	el.id = SENTINEL_ID;
	el.className = "home-infinite-scroll-sentinel home-load-more";
	el.style.padding = "24px 0 130px";
	el.style.textAlign = "center";
	el.innerHTML = "<button type='button' class='btn btn-primary home-load-more-btn'>" + __("加载更多") + "</button>"
		+ LOADING_DOTS_HTML
		+ "<div class='home-infinite-scroll-end d-none'>" + __("没有更多文章了") + "</div>"
		+ "<div class='home-infinite-scroll-error d-none' style='cursor: pointer;'>" + __("加载失败，点击重试") + "</div>";
	//加载动画初始隐藏，点击"加载更多"时才显示
	$(".loading-css-animation", el).addClass("d-none");
	$(el).on("click", ".home-load-more-btn", function(){
		loadNextPage();
	});
	$(el).on("click", ".home-infinite-scroll-error", function(){
		setErrorVisible(false);
		loadNextPage();
	});
	return el;
}

//抓取并解析下一页，追加文章卡片；结束/失败时通知当前控制器
export async function loadNextPage(){
	if (state.loading || state.ended || !state.nextUrl){
		return;
	}
	state.loading = true;
	setLoadingVisible(true);
	setErrorVisible(false);
	let ctrl = controller;
	if (ctrl && ctrl.onStart){
		ctrl.onStart();
	}
	try{
		let resp = await fetch(state.nextUrl, {
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
			state.ended = true;
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
			state.nextUrl = getNextPageUrl(newMain);
			if (!state.nextUrl){
				state.ended = true;
			}
			//重跑主题初始化，保证新卡片样式/懒加载/高亮正常
			initAfterLoad();
		}
		if (state.ended){
			//全部加载完成：显示结束提示（控制器负责停止自身观察/隐藏按钮）
			setLoadingVisible(false);
			setEndVisible(true);
			if (ctrl && ctrl.onEnded){
				ctrl.onEnded();
			}
		}else if (ctrl && ctrl.onLoaded){
			ctrl.onLoaded();
		}
	}catch(err){
		console.error("[Argon] 首页文章加载失败:", err);
		//加载失败：显示重试提示，控制器负责恢复自身降级入口
		setLoadingVisible(false);
		setErrorVisible(true);
		if (ctrl && ctrl.onError){
			ctrl.onError();
		}
	}finally{
		state.loading = false;
	}
}

//重置上一次状态（Pjax 导航 / bfcache 恢复后 #main 可能已被替换）
//清理 observer、哨兵与版权条触发，保证重复调用不会重复注入
export function reset(mode){
	stopFooterTrigger();
	if (state.observer){
		state.observer.disconnect();
		state.observer = null;
	}
	if (state.sentinel && state.sentinel.parentNode){
		state.sentinel.parentNode.removeChild(state.sentinel);
	}
	state.sentinel = null;
	state.nextUrl = null;
	state.loading = false;
	state.ended = false;
	state.mode = mode || null;
}
