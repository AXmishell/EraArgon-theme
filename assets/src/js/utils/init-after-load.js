import { waterflowInit } from '../waterflow';
import { lazyloadInit } from '../lazyload';
import { highlightJsRender } from '../code-highlight';
import { panguInit } from '../pangu';
import { clampInit } from './clamp';

/*页面内容加载完成后的公共初始化序列
 * 提取自 pjax.js 的 pjax:complete 回调与 home-infinite-scroll.js 的 loadNextPage()，
 * 两个调用方都按以下顺序执行这 5 个初始化：
 *   waterflowInit() -> lazyloadInit() -> highlightJsRender() -> panguInit() -> clampInit()
 *
 * 调用方在公共序列之外各自追加的额外初始化（本模块不包含）：
 *   - pjax.js (pjax:complete) 额外调用：zoomifyInit、getGithubInfoCardContent、
 *     showPostOutdateToast、calcHumanTimesOnPage、foldLongComments、foldLongShuoshuo、
 *     $("html").trigger("resize")；pjax:end 事件还额外调用 shareInit、tippyInit
 *   - home-infinite-scroll.js 无额外初始化
 *
 * 重构时可将各调用方内联的公共序列替换为对 initAfterLoad() 的单次调用。
 */
export const initAfterLoad = () => {
	waterflowInit();
	lazyloadInit();
	highlightJsRender();
	panguInit();
	clampInit();
}