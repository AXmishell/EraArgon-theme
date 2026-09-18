//首页文章加载入口：根据 window.argonConfig.home_load_mode 分发到对应控制器
//  pagination - 不做任何 JS 增强，保留服务端分页
//  infinite   - 无限滚动（默认）
//  loadmore   - 点击"加载更多"按钮加载
import * as core from './core';
import infinite from './infinite';
import loadmore from './loadmore';

var $ = window.$;

function getController(){
	let mode = window.argonConfig ? window.argonConfig.home_load_mode : null;
	if (mode === "loadmore"){
		return loadmore;
	}
	if (mode === "pagination"){
		return null;
	}
	//配置缺失或未知时回退到无限滚动（与旧行为一致）
	return infinite;
}

function init(){
	let controller = getController();
	if (controller){
		controller.init();
	}else{
		//分页模式为纯 no-op，但仍需清理可能由 Pjax 切换遗留的哨兵/观察器
		core.reset("pagination");
		core.setController(null);
	}
}

document.addEventListener("DOMContentLoaded", init);
//Pjax 导航完成后重新初始化（首页进入/离开均会触发）
$(document).on("pjax:complete", init);
//bfcache 恢复（浏览器后退）时页面状态被冻结，需要重新初始化
window.addEventListener("pageshow", function(event){
	if (event.persisted){
		init();
	}
});
