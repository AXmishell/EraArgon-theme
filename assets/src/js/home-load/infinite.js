//无限滚动模式：哨兵进入视口（含 600px 提前量）时自动加载下一页
import * as core from './core';

const MODE = "infinite";

//控制器钩子：结束时停止观察；失败时恢复服务端分页作为降级导航
const controller = {
	onEnded: function(){
		if (core.state.observer){
			core.state.observer.disconnect();
			core.state.observer = null;
		}
	},
	onError: function(){
		let mainEl = document.querySelector("#main.article-list-home");
		if (mainEl){
			core.showPagination(mainEl);
		}
	}
};

function onIntersect(entries){
	if (core.state.loading || core.state.ended || !core.state.nextUrl){
		return;
	}
	for (let i = 0; i < entries.length; i++){
		if (entries[i].isIntersecting){
			core.loadNextPage();
			return;
		}
	}
}

function startObserving(){
	if (core.state.observer || !core.state.sentinel){
		return;
	}
	core.state.observer = new IntersectionObserver(onIntersect, {rootMargin: "600px 0px"});
	core.state.observer.observe(core.state.sentinel);
}

//哨兵是否已处于触发范围内（与 rootMargin: 600px 0px 的判定保持一致）
function sentinelInRange(){
	let sentinel = core.state.sentinel;
	if (!sentinel){
		return false;
	}
	let rect = sentinel.getBoundingClientRect();
	let viewportHeight = window.innerHeight || document.documentElement.clientHeight;
	return rect.top <= viewportHeight + 600 && rect.bottom >= -600;
}

//兜底：浏览器可能在 load 之后才恢复滚动位置且不派发 scroll 事件，主动检查一次
function checkSentinelAfterInit(){
	if (core.state.loading || core.state.ended || !core.state.nextUrl){
		return;
	}
	requestAnimationFrame(function(){
		if (sentinelInRange()){
			core.loadNextPage();
		}
	});
}

function init(){
	core.reset(MODE);
	core.setController(controller);

	let mainEl = document.querySelector("#main.article-list-home");
	if (!mainEl){
		return;
	}
	if (window.argonConfig.disable_pjax == true){
		return;
	}
	core.state.nextUrl = core.getNextPageUrl(mainEl);
	if (!core.state.nextUrl){
		//只有一页，无需无限滚动
		return;
	}
	//确保固定版权条存在于 body（初始隐藏，结束提示出现时再显示）
	core.ensureFooter();
	//隐藏分页按钮（仅 JS 生效时；DOM 保留，无 JS 时仍可翻页）
	core.hidePagination(mainEl);
	core.state.sentinel = core.createSentinel();
	mainEl.appendChild(core.state.sentinel);
	//立即开始观察：600px rootMargin 保证离哨兵较远时不会提前加载，
	//同时修复浏览器恢复滚动位置到底部（不触发 scroll）导致永不加载的问题
	startObserving();
	checkSentinelAfterInit();
	if (document.readyState != "complete"){
		window.addEventListener("load", checkSentinelAfterInit, {once: true});
	}
	//部分浏览器恢复滚动晚于 load，再补一次短延时检查
	window.setTimeout(checkSentinelAfterInit, 300);
}

export default { init: init };
