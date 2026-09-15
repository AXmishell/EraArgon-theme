import 'izitoast/dist/css/iziToast.css';
import { argonAjax } from './utils/ajax';
import { toastError, toastSuccess } from './utils/toast';
var $ = window.$;
$(document).on("click" , ".shuoshuo-upvote" , function(){
	$this = $(this);
	ID = $this.attr("data-id");
	$this.addClass("shuoshuo-upvoting");
	argonAjax("upvote_shuoshuo", { shuoshuo_id: ID }, function(result){
		$this.removeClass("shuoshuo-upvoting");
		if (result.status == "success"){
			$(".shuoshuo-upvote-num" , $this).html(result.total_upvote);
			$("i.fa-thumbs-o-up", $this).removeClass("fa-thumbs-o-up").addClass("fa-thumbs-up");
			$this.addClass("upvoted");
			$this.addClass("shuoshuo-upvoted-animation");
			toastSuccess(result.msg);
		}else{
			$(".shuoshuo-upvote-num" , $this).html(result.total_upvote);
			toastError(result.msg);
		}
	}, function(xhr){
		$this.removeClass("shuoshuo-upvoting");
		toastError(__("点赞失败"));
	});
});