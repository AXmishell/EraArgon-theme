/*第二栏(主内容文章列表)卡片:滚动进入视口时逐卡轻微落位
  幅度约为第三栏吸顶落位动画的一半:5px / 300ms / 45ms 错峰,且无回弹。
  在 <head> 执行时即给 <html> 加 gating class,卡片从解析起就是隐藏态,不会首屏闪现;
  不支持 IntersectionObserver 或系统偏好"减少动态效果"时完全不启用(卡片保持原样)。*/
let cardRevealEnabled = false;
if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches){
	document.documentElement.classList.add('argon-card-reveal');
	cardRevealEnabled = true;
}

let cardRevealObserver = null;

/*读取 CSS 变量定义的时间(支持 s / ms 两种写法),让错峰间隔由 CSS 统一控制*/
function midColTimeMs(name, fallbackMs){
	let raw = getComputedStyle(document.documentElement).getPropertyValue(name).trim();
	if (raw === ''){
		return fallbackMs;
	}
	let value = parseFloat(raw);
	if (isNaN(value)){
		return fallbackMs;
	}
	if (/^[\d.]+s$/i.test(raw)){
		value *= 1000;
	}
	return value;
}

function onCardRevealIntersect(entries){
	const stagger = midColTimeMs('--mid-col-reveal-stagger', 45);
	let order = 0;
	entries.forEach(function(entry){
		if (!entry.isIntersecting){
			return;
		}
		let card = entry.target;
		// 同一批进入视口的卡片依次错峰(限幅,避免长列表累积过长延迟)
		card.style.setProperty('--argon-reveal-delay', Math.min(order++, 3) * stagger + 'ms');
		card.classList.add('argon-revealed');
		if (cardRevealObserver){
			cardRevealObserver.unobserve(card);
		}
	});
}

function cardRevealScan(){
	if (!cardRevealEnabled){
		return;
	}
	if (cardRevealObserver == null){
		cardRevealObserver = new IntersectionObserver(onCardRevealIntersect, {threshold: 0.08, rootMargin: '0px 0px -5% 0px'});
	}
	let cards = document.querySelectorAll('#main.article-list article.post:not(.argon-reveal-init)');
	Array.prototype.forEach.call(cards, function(card){
		card.classList.add('argon-reveal-init');
		cardRevealObserver.observe(card);
	});
}

//兜底:仅在"本该可见却仍未显示"(如观察器失效)时补显示,不会提前显示视口外的卡片
function cardRevealFallback(){
	if (!cardRevealEnabled){
		return;
	}
	Array.prototype.forEach.call(document.querySelectorAll('#main.article-list article.post:not(.argon-revealed)'), function(card){
		let rect = card.getBoundingClientRect();
		if (rect.top < window.innerHeight && rect.bottom > 0){
			card.classList.add('argon-revealed');
		}
	});
}

let cardRevealListObserved = false;
function cardRevealObserveList(){
	let main = document.querySelector('#main.article-list');
	if (main == null || cardRevealListObserved){
		return;
	}
	cardRevealListObserved = true;
	//无限滚动/Pjax 之外的新增卡片(如瀑布流分页追加)
	new MutationObserver(function(mutations){
		for (let i = 0; i < mutations.length; i++){
			if (mutations[i].addedNodes.length > 0){
				cardRevealScan();
				return;
			}
		}
	}).observe(main, {childList: true});
}

document.addEventListener('DOMContentLoaded', function(){
	cardRevealScan();
	cardRevealObserveList();
	setTimeout(cardRevealFallback, 2500);
});
window.addEventListener('load', cardRevealScan);

let $ = window.$;
$(document).on('pjax:complete', function(){
	cardRevealListObserved = false;
	cardRevealScan();
	cardRevealObserveList();
});
