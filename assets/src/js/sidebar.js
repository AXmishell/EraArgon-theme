import * as $ from 'jquery';

/*左侧栏随页面滚动浮动*/
document.addEventListener("DOMContentLoaded", () => {
	if ($("#leftbar").length == 0){
		let contentOffsetTop = $('#content').offset().top;
		function changeLeftbarStickyStatusWithoutSidebar(){
			let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			if( contentOffsetTop - 10 - scrollTop <= 20 ){
				document.body.classList.add('leftbar-can-headroom');
			}else{
				document.body.classList.remove('leftbar-can-headroom');
			}
		}
		changeLeftbarStickyStatusWithoutSidebar();
		document.addEventListener("scroll", changeLeftbarStickyStatusWithoutSidebar, {passive: true});
		$(window).resize(function(){
			contentOffsetTop = $('#content').offset().top;
			changeLeftbarStickyStatusWithoutSidebar();
		});
		return;
	}
	let $leftbarPart1 = $('#leftbar_part1');
	let $leftbarPart2 = $('#leftbar_part2');
	let leftbarPart1 = document.getElementById('leftbar_part1');
	let leftbarPart2 = document.getElementById('leftbar_part2');

	let part1OffsetTop = $('#leftbar_part1').offset().top;
	let part1OuterHeight = $('#leftbar_part1').outerHeight();

	function changeLeftbarStickyStatus(){
		let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		if( part1OffsetTop + part1OuterHeight + 10 - scrollTop <= (argonConfig.headroom != "absolute" ? 90 : 18) ){
			//滚动条在页面中间浮动状态
			leftbarPart2.classList.add('sticky');
		}else{
			//滚动条在顶部 不浮动状态
			leftbarPart2.classList.remove('sticky');
		}
		if( part1OffsetTop + part1OuterHeight + 10 - scrollTop <= 20 ){//侧栏下部分是否可以随 Headroom 一起向上移动
			document.body.classList.add('leftbar-can-headroom');
		}else{
			document.body.classList.remove('leftbar-can-headroom');
		}
	}
	changeLeftbarStickyStatus();
	document.addEventListener("scroll", changeLeftbarStickyStatus, {passive: true});
	$(window).resize(function(){
		part1OffsetTop = $leftbarPart1.offset().top;
		part1OuterHeight = $leftbarPart1.outerHeight();
		changeLeftbarStickyStatus();
	});
	new MutationObserver(function(){
		part1OffsetTop = $leftbarPart1.offset().top;
		part1OuterHeight = $leftbarPart1.outerHeight();
		changeLeftbarStickyStatus();
	}).observe(leftbarPart1, {attributes: true, childList: true, subtree: true});
});

/*右侧栏(三栏布局)的三个部件各自吸顶、依次向下堆叠,并且每块拥有各自独立的过渡:
  1) 计算累计偏移写入 --rightbar-sticky-offset(前面所有部件高度 + 间距);
  2) 按顺序写入 --rightbar-sticky-duration / --rightbar-sticky-delay,实现 A 错峰级联 + B 惯性递减;
  3) 滚动到停靠位时,每块依次播放一次"停靠"反馈(D:自下方上浮 + 轻微回弹)*/
let rightbarWidgets = [];
let rightbarDocked = [];

function updateRightbarStackOffsets(){
	let rightbar = document.getElementById('rightbar');
	if (rightbar == null){
		rightbarWidgets = [];
		rightbarDocked = [];
		return;
	}
	let offset = 0;
	rightbarWidgets = [];
	Array.prototype.forEach.call(rightbar.children, function(widget){
		if (!widget.classList.contains('widget')){
			return;
		}
		let index = rightbarWidgets.length;
		widget.style.setProperty('--rightbar-sticky-offset', offset + 'px');
		widget.style.setProperty('--rightbar-sticky-duration', (0.28 + index * 0.08).toFixed(2) + 's'); // B 惯性递减
		widget.style.setProperty('--rightbar-sticky-delay', (index * 0.06).toFixed(2) + 's');             // A 错峰级联
		rightbarWidgets.push({el: widget, offset: offset});
		offset += widget.offsetHeight + (parseFloat(getComputedStyle(widget).marginBottom) || 0);
	});
	rightbarDocked = rightbarWidgets.map(function(){ return false; });
	// 重算偏移(resize/pjax)时静默同步当前停靠状态,避免误播放停靠反馈
	updateRightbarDockedState(true);
}

function updateRightbarDockedState(silent){
	if (rightbarWidgets.length == 0){
		return;
	}
	let rightbar = document.getElementById('rightbar');
	if (rightbar == null){
		return;
	}
	// 窄屏 / 非三栏时侧栏被隐藏,不做任何处理
	if (rightbar.offsetWidth == 0 || getComputedStyle(rightbar).display == 'none'){
		rightbarDocked = rightbarWidgets.map(function(){ return false; });
		return;
	}
	let base = parseFloat(getComputedStyle(rightbarWidgets[0].el).getPropertyValue('--rightbar-sticky-base')) || 90;
	let top = rightbar.getBoundingClientRect().top;
	let reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	rightbarWidgets.forEach(function(item, index){
		let wasDocked = rightbarDocked[index];
		// 迟滞判断:已停靠时用更大的阈值判断"脱离",这样导航栏收回(基准位 90->20)引发的
		// 基准变化不会造成状态抖动或重复播放停靠反馈
		let isDocked = top <= base + (wasDocked ? 80 : 1);
		if (isDocked == wasDocked){
			return;
		}
		rightbarDocked[index] = isDocked;
		if (silent || !isDocked || reduceMotion){
			return;
		}
		// 几何上三块同时吸附,视觉上的"依次停靠"由递增的 delay 实现:
		// 每块先轻微下沉再回弹归位,首尾都等于静止状态,不会产生跳变
		item.el.animate([
			{transform: 'none', opacity: 1},
			{transform: 'translateY(10px) scale(.992)', opacity: 0.85, offset: 0.3},
			{transform: 'translateY(-2px) scale(1.004)', opacity: 1, offset: 0.7},
			{transform: 'none', opacity: 1}
		], {
			duration: 460,
			delay: index * 90,
			easing: 'cubic-bezier(.22, .61, .36, 1)'
		});
	});
}

document.addEventListener('DOMContentLoaded', updateRightbarStackOffsets);
window.addEventListener('load', updateRightbarStackOffsets);
window.addEventListener('resize', updateRightbarStackOffsets);
document.addEventListener('scroll', function(){ updateRightbarDockedState(false); }, {passive: true});
$(document).on('pjax:complete', updateRightbarStackOffsets);