/*! Post Create and Edit Javascript */
var post_id = -1;
var timestamp = 0;

function initPostId(){
	if($('input:text[name="pid"]').length > 0){
		post_id = $('input:text[name="pid"]').val();
	}
}

function initTimestamp(){
    if($('input:text[name="timestamp"]').length > 0){
        timestamp = $('input:text[name="timestamp"]').val();
    }
}

function initSummernote() {
	$('#editor').summernote({
		height: 300,
		minHeight: null,
		maxHeight: null,
		lang: 'zh-CN',
		callbacks: {
			onImageUpload: function (files) {
				// upload image to server and create imgNode...
                $('.editor-msg').html('图片上传中...');
                $('.editor-cover').show();
				uploadImage(files[0]);
			}
		}
	});
	if($('textarea[name="context"]').val() != ''){
		//edit页面赋现有内容为值给编辑器
		var sHTML = $('textarea[name="context"]').val();
		$('#editor').summernote('code', sHTML);
	}

}

function uploadImage(file){
	var data = new FormData();
	data.append("file", file);
    data.append("post_id", post_id);
    data.append("timestamp", timestamp);
	$.ajax({
		data: data,
		type: "POST",
		dataType: 'json',
		url: upload_url,
		cache: false,
		processData: false,
		contentType: false,
		success: function(res) {
			if(res.message == 'success'){
				var path = res.path;
				$('#editor').summernote('insertImage', path);
                $('.editor-msg').html('上传成功！');
                $('.editor-cover').delay("slow").fadeOut();
			}else{
				var error_msg = res.error_msg;
                $('.editor-msg').html('上传失败！');
                $('.editor-cover').delay("slow").fadeOut();
				alert(error_msg);
			}
		}
	});

}

function submitPost(){
	var sHTML = $('#editor').summernote('code');
	$('textarea[name="context"]').val(sHTML);
	$('#postForm').submit();
}

function toggleRequireExcerpt(){
	if($('input:checkbox[name="auto_excerpt"]').prop('checked')){
		$('textarea[name="excerpt"]').prop('required',false);
	}else{
		$('textarea[name="excerpt"]').prop('required',true);
	}
}

