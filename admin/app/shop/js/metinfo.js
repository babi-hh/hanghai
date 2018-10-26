function momethod(){
	var num=$('#methodnum').val();
	var str="";
	$("#newmethodlist li").each(function(){
		str+='|'+$(this).find('.method_1').val()+','+$(this).find('.method_2').val();
	});
	$('#method').val(str);
	return ture;
}
function newmethod_del(my){
	my.parent('li').fadeOut("fast",function(){
		$(this).remove();
	});
}
function newmethod(){
	if($('#newmethod1').val()==''){
		alert("物流名称不能为空！");
		$('#newmethod1').focus();
		return false;
	}
	if($('#newmethod2').val()==''){
		alert("价格不能为空！");
		$('#newmethod2').focus();
		return false;
	}
	$("#newmethodlist").append('<li><img src="' + metimgurl + 'loadings.gif" style="position:relative; top:3px;" /></li>');
	var url ='set.php?lang='+lang+'&action=newmethod&method='+$('#newmethod1').val()+','+$('#newmethod2').val();
	$.ajax({
		url: url,
		type: "POST",
		success: function(data) {
			var mp = data.split(",");
			$("#newmethodlist li:last").remove();
			$("#newmethodlist").append('<li><input class="method_1" value="'+mp[0]+'" style="width:60px;" />&nbsp;&nbsp;<input class="method_2" value="'+mp[1]+'" style="width:30px;" />&nbsp;&nbsp;<a href="javascript:;" onclick="newmethod_del($(this))">删除</a></li>');
			$('#newmethod1').val('');
			$('#newmethod2').val('');
			$('#newmethod1').focus();
		}
	});
}
$(document).ready(function(){
	//
	$(".metshopk_xz_box .xz_tj span").click(function(){
		var mok = $(this).prev().data('mok');
		if(mok==0){
			$(this).hide();
			$(this).prev().prev().show();
			$(this).prev().show().focus();
		}
	});
	$(".metshopk_xz_box .xz_tj input").focusout(function(){
		if($(this).val()==''){
			$(this).hide();
			$(this).prev().hide();
			$(this).next().show();
		}
	});
	$(".metshopk_xz_box .xz_tj input").live('keyup',function(){ 
		$(this).prev().hide();
		var current=$(this).val().replace(/[^\u0000-\u00ff]/g,"aa").length;
		var size=current;
		var wd = size*10;
			wd = wd+25;
		$(this).css("width",wd+'px');
	});
	$(".metshopk_xz_box .xz_tj input").keypress(function (e) {
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if (keyCode == 13 ){
			var myval = $(this).val().replace(/[ ]/g,"");
				myval = myval.replace('|',"");
			if(myval!=''){
				$(this).parent("li").before('<li class="xz_list"><span>'+myval+'</span><a></a></li>');
				$(this).parent("li").parent("ul").prev('.metshopk_xz_val').find("input").val(function(){
					return $(this).val()==''?myval:$(this).val()+'|'+ myval;
				});
				$(this).val('');
			}
			return false;
		}else{
			return true;
		}
	});
	$(".metshopk_xz_box .xz_list").live('hover',
	function(tm) {
		if (tm.type == 'mouseover' || tm.type == 'mouseenter') $(this).addClass("on");
		if (tm.type == 'mouseout' || tm.type == 'mouseleave') $(this).removeClass("on");
	});
	$(".metshopk_xz_box .xz_list a").live('hover',
	function(tm) {
		if (tm.type == 'mouseover' || tm.type == 'mouseenter') $(this).addClass("on");
		if (tm.type == 'mouseout' || tm.type == 'mouseleave') $(this).removeClass("on");
	});
	$(".metshopk_xz_box .xz_list a").live('click',function(){
		var kl = $(this).parent('li').index();
		var dm = $(this).parent("li").parent("ul").prev('.metshopk_xz_val').find("input");
		dm.val(function(){
			var v = $(this).val(),vn='';
				v = v.split('|');
			for(var i=0;i<v.length;i++){
				if(i!=kl){
					vn += v[i]+'|';
				}
			}
			if(vn.charAt(vn.length - 1)=='|')vn=vn.substring(0,vn.length-1);
			return vn;
		});
		$(this).parent("li").remove();
	});
	//
	$("#newmethod1,#newmethod2").keypress(function (e) {
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if (keyCode == 13 ){
			newmethod();
			return false;
		}else{
			return true;
		}
	});
	//
	$(".tixing_box input,.tixing_box textarea").each(function(){
		if($(this).val()=='')$(this).parent().find("label").show();
	});
	$(".tixing_box input,.tixing_box textarea").focus(function(){
		$(this).parent().find("label").css("color",'#ccc');
	});
	$(".tixing_box input,.tixing_box textarea").focusout(function(){
		$(this).parent().find("label").css("color",'#999');
	});
	$(".tixing_box input,.tixing_box textarea").live('keyup',function(){ 
		if($(this).val()==''){
			$(this).parent().find("label").show();
		}else{
			$(this).parent().find("label").hide();
		}
	});
});