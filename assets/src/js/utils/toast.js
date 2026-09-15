import iziToast from 'izitoast';
import 'izitoast/dist/css/iziToast.min.css';

/*izitoast 提示封装
 * 统一使用主题内各模块通用的 iziToast.show 配置：
 *   class: 'shadow-sm'
 *   position: 'topRight'
 *   titleColor / messageColor / iconColor / progressBarColor: '#ffffff'
 *   timeout: 5000
 * 错误提示 backgroundColor: '#f5365c'，icon: 'fa fa-close'
 * 成功提示 backgroundColor: '#2dce89'，icon: 'fa fa-check'
 * （依据 shuoshuo-vote.js、comment-vote.js、comment-pin.js、send-comment.js 中的现有配置提取）
 */

/*显示错误提示
 * @param {string} title 提示标题（通常为 __("...失败") 之类的本地化文案）
 * @param {string} [text] 提示正文（可选，与现有模块中部分 toast 不带 message 字段的行为一致）
 */
export const toastError = (title, text) => {
	let config = {
		title: title,
		class: 'shadow-sm',
		position: 'topRight',
		backgroundColor: '#f5365c',
		titleColor: '#ffffff',
		messageColor: '#ffffff',
		iconColor: '#ffffff',
		progressBarColor: '#ffffff',
		icon: 'fa fa-close',
		timeout: 5000
	};
	if (text){
		config.message = text;
	}
	iziToast.show(config);
}

/*显示成功提示
 * @param {string} title 提示标题（通常为 __("...成功") 之类的本地化文案）
 * @param {string} [text] 提示正文（可选）
 */
export const toastSuccess = (title, text) => {
	let config = {
		title: title,
		class: 'shadow-sm',
		position: 'topRight',
		backgroundColor: '#2dce89',
		titleColor: '#ffffff',
		messageColor: '#ffffff',
		iconColor: '#ffffff',
		progressBarColor: '#ffffff',
		icon: 'fa fa-check',
		timeout: 5000
	};
	if (text){
		config.message = text;
	}
	iziToast.show(config);
}