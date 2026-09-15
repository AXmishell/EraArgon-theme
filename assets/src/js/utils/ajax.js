import __ from "../i18n";
import { toastError } from "./toast";

var $ = window.$;

/*admin-ajax POST 请求封装
 * 统一使用主题内各 AJAX 模块的现有请求格式：
 *   url: window.argonConfig.wp_path + "wp-admin/admin-ajax.php"
 *   type: "POST"
 *   dataType: "json"
 *   data 中自动附带 action 字段
 * （依据 shuoshuo-vote.js、comment-vote.js、comment-pin.js、comment-edit-history.js、send-comment.js 中的现有请求提取）
 *
 * 用法示例（回调风格，与现有模块一致）：
 *   argonAjax("upvote_comment", { comment_id: ID }, function(result){
 *       // result.status == "success" 时处理成功逻辑
 *   }, function(xhr){
 *       // 自定义错误处理（可选）
 *   });
 *
 * 也可省略 onError 使用默认错误提示，或省略两个回调后通过返回的 jqXHR 链式调用 .done()/.fail()。
 */

/*向 admin-ajax.php 发送 POST 请求
 * @param {string} action WordPress AJAX action 名，会自动写入 data.action
 * @param {object} [data] 附加请求参数（不含 action）
 * @param {function} [onSuccess] 成功回调，参数为解析后的 JSON 结果（dataType: "json"）
 * @param {function} [onError] 错误回调，参数为 jQuery XHR 对象；省略时显示默认错误 toast
 * @returns {jqXHR} jQuery XHR 对象，可继续链式调用 .done()/.fail()/.always()
 */
export const argonAjax = (action, data = {}, onSuccess, onError) => {
	return $.ajax({
		type: "POST",
		url: window.argonConfig.wp_path + "wp-admin/admin-ajax.php",
		dataType: "json",
		data: Object.assign({ action: action }, data),
		success: onSuccess,
		error: function(xhr){
			if (typeof onError === "function"){
				onError(xhr);
			}else{
				//默认错误提示：与现有模块的 error 分支一致（红色 topRight toast）
				//注意：__("请求失败") 未收录在 i18n 词典中，会原样显示；
				//需要本地化/动作相关标题时请传入 onError 自行处理
				toastError(__("请求失败"), __("未知原因"));
			}
		}
	});
}