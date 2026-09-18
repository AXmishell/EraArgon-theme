//站点运行时间
//页脚由服务端渲染于 Pjax 容器之外，仅初始化一次；功能关闭时该元素不存在，代码安全空转
var INTERVAL_MS = 1000;

//data-start 优先为绝对 Unix 时间戳（秒），避免访客浏览器时区与站点时区不一致导致的偏移；
//同时兼容旧格式 "YYYY-MM-DD HH:mm:ss"
function parseStart(raw){
	if (raw === null || raw === undefined){
		return null;
	}
	raw = String(raw).trim();
	if (raw === ""){
		return null;
	}
	if (/^\d+$/.test(raw)){
		var fromTimestamp = new Date(parseInt(raw, 10) * 1000);
		if (!isNaN(fromTimestamp.getTime())){
			return fromTimestamp;
		}
	}
	//旧格式：Safari 无法解析 "YYYY-MM-DD HH:mm:ss"，需将 - 替换为 /
	var date = new Date(raw.replace(/-/g, "/"));
	if (isNaN(date.getTime())){
		return null;
	}
	return date;
}

function addDays(date, n){
	var result = new Date(date.getTime());
	result.setDate(result.getDate() + n);
	return result;
}

function addMonths(date, n){
	var result = new Date(date.getTime());
	result.setMonth(result.getMonth() + n);
	return result;
}

function addYears(date, n){
	var result = new Date(date.getTime());
	result.setFullYear(result.getFullYear() + n);
	return result;
}

function formatFull(elapsed, units){
	var totalSeconds = Math.floor(elapsed / 1000);
	var days = Math.floor(totalSeconds / 86400);
	var hours = Math.floor((totalSeconds % 86400) / 3600);
	var minutes = Math.floor((totalSeconds % 3600) / 60);
	var seconds = totalSeconds % 60;
	return days + units.days + " " + hours + units.hours + " " + minutes + units.minutes + " " + seconds + units.seconds;
}

function formatDays(elapsed, units){
	return Math.floor(elapsed / 86400000) + units.days;
}

//按自然年/月/日推算：从起始时间起逐整年、整月、整日前进，直到超过当前时间
function formatYmd(start, now, units){
	var cursor = new Date(start.getTime());
	var years = 0;
	var months = 0;
	var days = 0;
	while (addYears(cursor, 1).getTime() <= now.getTime()){
		cursor = addYears(cursor, 1);
		years++;
	}
	while (addMonths(cursor, 1).getTime() <= now.getTime()){
		cursor = addMonths(cursor, 1);
		months++;
	}
	while (addDays(cursor, 1).getTime() <= now.getTime()){
		cursor = addDays(cursor, 1);
		days++;
	}
	return years + units.years + " " + months + units.months + " " + days + units.days;
}

function readUnits(el){
	return {
		days: el.getAttribute("data-days") || "",
		hours: el.getAttribute("data-hours") || "",
		minutes: el.getAttribute("data-minutes") || "",
		seconds: el.getAttribute("data-seconds") || "",
		years: el.getAttribute("data-years") || "",
		months: el.getAttribute("data-months") || ""
	};
}

function render(el, valueEl, start, units){
	var elapsed = Date.now() - start.getTime();
	if (elapsed < 0){
		elapsed = 0;
	}
	var type = el.getAttribute("data-type") || "full";
	if (type === "days"){
		valueEl.textContent = formatDays(elapsed, units);
	}else if (type === "ymd"){
		valueEl.textContent = formatYmd(start, new Date(), units);
	}else{
		valueEl.textContent = formatFull(elapsed, units);
	}
}

function init(){
	var el = document.getElementById("site-footer-runtime");
	if (!el || el.__argonRuntimeInit){
		return;
	}
	el.__argonRuntimeInit = true;

	var valueEl = el.querySelector(".site-footer-runtime-value");
	if (!valueEl){
		return;
	}
	var start = parseStart(el.getAttribute("data-start"));
	if (!start){
		//起始时间无效时不写入，保持值为空
		return;
	}
	var units = readUnits(el);

	render(el, valueEl, start, units);
	setInterval(function(){
		render(el, valueEl, start, units);
	}, INTERVAL_MS);
}

if (document.readyState === "loading"){
	document.addEventListener("DOMContentLoaded", init);
}else{
	init();
}
