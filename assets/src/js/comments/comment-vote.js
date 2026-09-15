var $ = window.$;
import __ from '../i18n';
import 'izitoast/dist/css/iziToast.min.css';
import { argonAjax } from '../utils/ajax';
import { toastError } from '../utils/toast';
$(document).on("click" , ".comment-upvote" , function(){
	$this = $(this);
	ID = $this.attr("data-id");
	$this.addClass("comment-upvoting");
	argonAjax("upvote_comment", { comment_id: ID }, function(result){
		$this.removeClass("comment-upvoting");
		if (result.status == "success"){
			$(".comment-upvote-num" , $this).html(result.total_upvote);
			$this.addClass("upvoted");
		}else{
			$(".comment-upvote-num" , $this).html(result.total_upvote);
			toastError(result.msg);
		}
	}, function(xhr){
		$this.removeClass("comment-upvoting");
		toastError(__("点赞失败"));
	});
});