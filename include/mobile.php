<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
function mobilejump($tp){
	global $met_wap_tpa,$met_wap_tpb,$met_wap_url,$met_wap,$met_mobileok,$lang,$index;
	$met_mobileok=$tp?$met_mobileok:0;
	if($met_wap&&!$met_mobileok){
		$Loaction = $index?'wap/index.php?lang='.$lang:'../wap/index.php?lang='.$lang;
		if($met_wap_tpa==1){
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			if($_SERVER['HTTP_USER_AGENT']){
				$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
				if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap')){
					if (!empty($Loaction)){
						if($met_wap_tpb==1&&$met_wap_url!='')$Loaction=$met_wap_url.$Loaction;
						header("Location: $Loaction\n");
						exit;
					}
				}
			}
		}
		if($met_wap_tpb==1){
			$localurl="http://";
			$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
			$localurl=dirname($localurl);
			if(substr($localurl,-1,1)!="/")$localurl.="/";
			if(strstr($localurl,$met_wap_url)){
				header("Location: $Loaction\n");
				exit;
			}
		}
	}
}
met_setcookie("pcok",$pcok,0);
if($pcok!='pc'){
	if(!$met_wap_url)$met_wap_url=$met_index_url[$lang];

	if(($met_mobileok||!$index)&&strstr($_SERVER['HTTP_USER_AGENT'],"UCWEB/2.0")){
		$met_mobileok='';
		mobilejump(1);
	}
	if($index=='index'&&$met_wap&&!$met_mobileok)mobilejump(1);
	if($index!='index'&&$met_wap&&!$met_mobileok){
		$met_mobileok=0;
		if($met_wap_tpa==1){
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			if($_SERVER['HTTP_USER_AGENT']){
				$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
				if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap')){
					if (!empty($wap_skin_user)){
						if($met_wap_tpb&&$met_wap_url){
							$localurl="http://";
							$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
							$localurl=dirname($localurl);
							if(substr($localurl,-1,1)!="/")$localurl.="/";
							if(!strstr($localurl,$met_wap_url)){
								$mobile_prefix=request_uri();
								$mobile_prefix=str_replace($met_weburl,$met_wap_url,$mobile_prefix);
								header("Location: $mobile_prefix\n");
								exit;
							}
						}
						$met_mobileok = 1;
					}
				}
			}
		}
		if($met_wap_tpb==1){
			$localurl="http://";
			$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
			$localurl=dirname($localurl);
			if(substr($localurl,-1,1)!="/")$localurl.="/";
			if(strstr($localurl,$met_wap_url)){
				$met_mobileok = 1;
			}
		}
	}
	$mobilesql='';
	if($met_mobileok){
		$met_skin_user = $wap_skin_user;
		$met_online_type=3;
		$met_memberlogin_code=0;
		$met_news_list = $wap_news_list;
		$met_product_list = $wap_product_list;
		$met_download_list = $wap_download_list;
		$met_img_list = $wap_img_list;
		$met_job_list = $wap_job_list;
		$met_message_list = $wap_message_list;
		$met_search_list = $wap_search_list;
		$met_flasharraytd = array();
		foreach($met_flasharray as $key=>$val){
			$val[type] = $val[wap_type];
			$met_flasharraytd[$key] = $val;
		}
		$met_flasharray = $met_flasharraytd;
		if($wap_title){
			$met_hometitle=$wap_title;
			$met_webname=$wap_title;
			$met_title_type=2;
		}
		if($met_wap_url){
			$met_weburl=$met_wap_url;
		}
		if($met_wap_logo)$met_logo=$met_wap_logo;
		$mobilesql = $met_wap_ok?"and wap_ok='1'":'';
		$met_skin_css=$wap_skin_css;
		$met_webhtm=0;
		$met_pseudo=0;
	}
}else{
	if($pcok=='wap'){
		$met_webhtm=0;
		$met_pseudo=0;
		$met_mobileok=0;
	}
}
function wap_foot_menu($type){
    global $met_title,$show,$m_now_year,$navurl,$met_js_access,$met_skin_css,$img_url,$met_webname,$metcms_v,$appscriptcss,$met_ch_lang,$lang,$met_ch_mark,$met_url,$metinfouiok,$classnow,$class_list,$met_headstat;
	global $met_wap,$met_wap_tpa,$met_wap_tpb,$met_webhtm,$met_wap_url,$module,$metinfonow,$met_member_force,$met_weburl,$met_wapshowtype,$lang_foottext1,$lang_foottext2,$lang_foottext3,$lang_foottext4,$lang_footnav_tel,$index_url;
if($type==1){
$metinfo="<div id='footernav'>
	<div class='footerboxnav'>
	
         <div id='jisou-info' class='jisou-info' style='display:none;'></div>
             <div class='info-nr'>
                <div id='info-nr-phone' class='info-nr-phone color-orange'>
                  <input id='info-nr-btn' type='checkbox' class='info-nr-menu'>
                     <div> <a href='tel:{$lang_footnav_tel}'><span class='icon-phone tel'></span></a> </div>
                     <div> <a href='{$navurl}index.php?lang=$lang&map=1&met_mobileok=1'><span class='icon-map-marker map'></span></a> </div>
                     <div> <a href='{$navurl}message/index.php?lang=$lang'><span class='icon-edit message'></span></a> </div>
                     <div> <a href='{$index_url}'><span class='icon-home home'></span></a> </div>
                </div>
        </div>
  
	</div>
</div>";
            }
if($type==2){
$metinfo="<div id='footer'>
	<div class='footerbox'>
	<div class='footerlist'>
		<ul>
			<li><a href='tel:{$lang_footnav_tel}'><span class='icon tel'></span><span class='txt'>{$lang_foottext1}</span></a></li>
			<li><a href='{$navurl}index.php?lang=$lang&map=1&met_mobileok=1'><span class='icon map'></span><span class='txt'>{$lang_foottext2}</span></a></li>
			<li><a href='{$navurl}message/index.php?lang=$lang'><span class='icon message'></span><span class='txt'>{$lang_foottext3}</span></a></li>
			<li><a href='{$index_url}'><span class='icon home'></span><span class='txt'>{$lang_foottext4}</span></a></li>
		</ul>
	</div>
	</div>
    </div>";

           }
	return $metinfo;
				}    

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>