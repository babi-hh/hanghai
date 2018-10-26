function MetFromVer_blank(required){
	var returnok=true,tagename='';
	required.each(function(){
		if(returnok){
			var mplx = $(this).find("input,select,textarea");
				tagename = mplx[0].tagName;
				mplx = mplx.eq(0);
			switch(tagename){
				case 'INPUT':
					var mtype = mplx.attr('type');
					if(mtype=='text'||mtype=='password'){
						if(mplx.val()==''){
							alert(mplx.attr('placeholder')+Empty);
							mplx.focus();
							//myScroll.scrollToElement("", 300);
							returnok=false;
						}
					}
					if(mtype=='checkbox'){
						var ched = $(this).find("input[type='checkbox']:checked").size();
						if(ched<1){
							alert($(this).find("span.name").html()+Empty);
							mplx.focus();
							returnok=false;
						}
					}
				break;
				case 'SELECT':
				break;
				case 'TEXTAREA':
					if(mplx.val()==''){
						alert(mplx.attr('placeholder')+Empty);
						mplx.focus();
						returnok=false;
					}
				break;
			}
		}
	});
	return returnok;
}

function MetFromVer(dom){
	var returnok=true;//true,false
		//文字最小长度
	var met_minsize = dom.find("input[met_minsize]");
		if(met_minsize.size()>0){
			if(returnok){ 
				met_minsize.each(function(){
					var lsh = $(this).val().length;
					var min = $(this).attr("met_minsize");
					if(lsh>0){
						if(lsh<min){
							if(min==3)member_err2=member_err4;
							alert(member_err2);
							$(this).focus();
							returnok=false;
						}
					}
				});
			}
		}
		//文字最大长度
	var met_maxsize = dom.find("input[met_maxsize]");
		if(met_maxsize.size()>0){
			if(returnok){ 
				met_maxsize.each(function(){
					var lsh = $(this).val().length;
					if(lsh>0){
						if(lsh>$(this).attr("met_maxsize")){
							alert(member_err3);
							$(this).focus();
							returnok=false;
						}
					}
				});
			}
		}
		//密码确认
		var passfor = dom.find("input[passfor]");
		if(passfor.size()>0){
			if(returnok){
				var forpass = dom.find("input[name='"+passfor.attr('passfor')+"']");
				if(passfor.val()!=forpass.val()&&forpass.val()!=''){
					alert(member_err1);
					passfor.focus();
					returnok=false;
				}
			}
		}
		//不能为空或必选
	var required=dom.find(".required");
		if(required.size()>0){
			if(returnok){ returnok = MetFromVer_blank(required); }
		}
		//邮箱验证
	//var met_type=dom.find("input[met_type='email']");
	return returnok;//true,false||returnok
}
$(document).ready(function() {
	$(".signupForm").submit(function(){
		return MetFromVer($(this));
	});
});