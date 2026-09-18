//加载更多模式：仅在点击"加载更多"按钮时加载下一页
import * as core from './core';

const MODE = "loadmore";

function getButton(){
	if (!core.state.sentinel){
		return null;
	}
	return core.state.sentinel.querySelector(".home-load-more-btn");
}

//控制器钩子：按钮禁用/恢复、结束后隐藏按钮
const controller = {
	onStart: function(){
		let btn = getButton();
		if (btn){
			btn.disabled = true;
		}
	},
	onLoaded: function(){
		//成功加载且仍有下一页：收起动画，恢复按钮
		core.setLoadingVisible(false);
		let btn = getButton();
		if (btn){
			btn.disabled = false;
		}
	},
	onEnded: function(){
		//没有更多：隐藏按钮，保留"没有更多文章了"
		let btn = getButton();
		if (btn){
			btn.classList.add("d-none");
		}
	},
	onError: function(){
		//加载失败：恢复按钮，保留"加载失败，点击重试"
		let btn = getButton();
		if (btn){
			btn.disabled = false;
		}
	}
};

function init(){
	core.reset(MODE);
	core.setController(controller);

	let mainEl = document.querySelector("#main.article-list-home");
	if (!mainEl){
		return;
	}
	//点击驱动，不受 disable_pjax 限制；但依赖 pjax:complete 重新初始化
	core.state.nextUrl = core.getNextPageUrl(mainEl);
	if (!core.state.nextUrl){
		//只有一页，无需加载更多
		return;
	}
	core.ensureFooter();
	core.hidePagination(mainEl);
	core.state.sentinel = core.createLoadMore();
	mainEl.appendChild(core.state.sentinel);
}

export default { init: init };
