/*! Archives Javascript */
var loadTrigger = true;
var offset = 0;
var post_num = 10;
$(function(){
	bindScrollTrigger();
});

function bindScrollTrigger(){
	$(window).scroll(function() {
		var triggerOffset = $('.vertical-timeline').get(0).offsetTop + $('.vertical-timeline').height();
		if($(document).scrollTop() + $(window).height() > triggerOffset && loadTrigger == true){
			loadArchivesPosts();
		}
	});
}

function loadArchivesPosts(){
	loadTrigger = false;
	var temp_offset = offset + post_num;
	$('.timeline-loading-msg').show();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: site_url+"api/archives/get_posts/"+temp_offset+"/"+post_num,
		cache: false,
		async : false,
		success: function(res) {
			if(res.code == 200){
				var data =  res.data;
				addPostLists(data);
				offset = temp_offset;
				loadTrigger = true;
			}else{
				//loadTrigger = true;
			}
			$('.timeline-loading-msg').hide();
		}
	});
}
function addPostLists(post_list){
	var year;
	var month;
	$.each(post_list,function(index, data){
		if(this.type == 'year'){
			year = this.data;
			if($('.vt-year').last().attr('data-value') == year) {
				return true;
			}else{
				var li_str = '<li class="vt-year" data-value="'+year+'">'
					+'<div class="vt-label">'+year+'</div>'
					+'<div class="vt-circle"></div>'
					+'<div class="clearfix"></div>'
					+'</li>';
				$('.vertical-timeline ul').append(li_str);
			}
		}else if(data.type == 'month'){
			month = year+'-'+this.data;
			if($('.vt-month').last().attr('data-value') == month){
				return true;
			}else{
				var li_str = '<li class="vt-month" data-value="'+month+'">'
				+'<div class="vt-label">'+this.data+'月</div>'
				+'<div class="vt-circle"></div>'
				+'<div class="clearfix"></div>'
				+'</li>';
				$('.vertical-timeline ul').append(li_str);
			}
		}else{
			var li_str = '<li class="vt-date">'
				+'<div class="vt-label">'+this.data.display_date+'<span class="vt-time">'+this.data.display_time+'</span></div>'
				+'<div class="vt-circle"></div>'
				+'<div class="vt-content">'
				+'<h4><a href="'+site_url+'posts/'+this.data.post_slug+'">'+this.data.post_title+'</a></h4>'
				+'<p>'+this.data.post_excerpt+'</p>'
				+'</div>'
				+'<div class="clearfix"></div>'
				+'</li>';
			$('.vertical-timeline ul').append(li_str);
		}
	});
}


