<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
$backurl='../app/shop/pfieldlist.php?anyid='.$anyid.'&bigid='.$bigid.'&lang='.$lang.'&class1='.$class1;
if($action=="add"){
	$list_if=$db->get_one("SELECT * FROM $met_shop_slists WHERE info='$info' and bigid='$bigid' ");
	if($list_if)metsave('-1',$lang_dataerror,$depth);
	$list_ok=$db->get_one("SELECT * FROM $met_shop_slists WHERE bigid='$bigid' and no_order=99999 ");
	if($listproduct=="metinfo" && $list_ok){
		$query=(trim($info)==0)?"delete from $met_shop_slists where bigid='$bigid' and no_order=99999":"update $met_shop_slists set info='$info' where bigid='$bigid' and no_order=99999";
	}else{
	   $query="insert into $met_shop_slists set
			   info     ='$info',
			   no_order ='$no_order',
			   lang     ='$lang',
			   bigid    ='$bigid'";
	}
	$db->query($query);
	metsave($backurl,'',$depth);
}elseif($action=="addsave"){
	$newslit = "<tr class='mouse newlist'>\n";
	$newslit.= "<td class='list-text'><input name='id' type='checkbox' value='new$lp' checked='checked' /><input name='bigid_new$lp' type='hidden' value='$bigid' /></td>\n";	
	$newslit.= "<td class='list-text'><input name='no_order_new$lp' type='text' class='text no_order' /></td>\n";	
	$newslit.= "<td class='list-text' style='text-align:left; padding-left:15px;'><input name='info_new$lp' type='text' class='text nonull' /></td>\n";	
	$newslit.= "<td class='list-text'><a href='javascript:;' class='hovertips' style='padding:0px 5px;' onclick='delettr($(this));'>$lang_js49</a></td>\n";
	$newslit.= "</tr>";
	echo $newslit;
}elseif($action=="editor"){
	$allidlist=explode(',',$allid);
	$adnum = count($allidlist)-1;
	for($i=0;$i<$adnum;$i++){
		$info = 'info_'.$allidlist[$i];
		$info = $$info;
		$no_order = 'no_order_'.$allidlist[$i];
		$no_order = $$no_order;
		$bigid    = 'bigid_'.$allidlist[$i];
		$bigid    = $$bigid;
		$thumb    = 'thumb_'.$allidlist[$i];
		$thumb    = $$thumb;
		$price    = 'price_'.$allidlist[$i];
		$price    = $$price;
		$tpif = is_numeric($allidlist[$i])?1:0;
		$sql = $tpif?"id='$allidlist[$i]'":'';
		if($sql!='')$skin_m=$db->get_one("SELECT * FROM $met_shop_slists WHERE $sql");
		if($tpif){
			if(!$skin_m){metsave('-1',$lang_dataerror,$depth);}
		}else{
			$list_if=$db->get_one("SELECT * FROM $met_shop_slists WHERE info='$info' and bigid='$bigid' ");
			if($list_if)metsave('-1',$lang_parameternameexist,$depth);
		}
		
		$uptp = $tpif?"update":"insert into";
		$upbp = $tpif?"where id='$allidlist[$i]'":",lang='$lang'";
		$query="$uptp $met_shop_slists set
				info       ='$info',
				no_order   ='$no_order',
				thumb      ='$thumb',
				price      ='$price'
				$upbp";
				//exit(var_dump($query));
		$db->query($query);
	}
    metsave($backurl,'',$depth);
}elseif($action=="delete"){
	if($action_type=="del"){
		$allidlist=explode(',',$allid);
		foreach($allidlist as $key=>$val){
			$query = "delete from {$met_shop_slists} where id='{$val}'";
			$db->query($query);
		}
	}else{
		$query="delete from $met_shop_slists where id='$id'";
		$db->query($query);
	}
	metsave($backurl,'',$depth);
}else{
	$query = "SELECT * FROM $met_shop_slists  where bigid='$bigid' order BY no_order";
	$result = $db->query($query);
	while($list = $db->fetch_array($result)) {
		$fd_list[]=$list;
	}
	include template_app('shop/pfieldlist',$EXT="html");
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>