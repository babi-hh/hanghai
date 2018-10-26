<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
if($action=="editor"){
	$allidlist=explode(',',$allid);
	$adnum = count($allidlist)-1;
	for($i=0;$i<$adnum;$i++){
		$name     = "name_".$allidlist[$i];	
		$name     = $$name;
		$no_order = "no_order_".$allidlist[$i];
		$no_order = $$no_order;
		$class1   = "class1_".$allidlist[$i];
		$class1   = $$class1;
		$wr_ok    = "wr_ok_".$allidlist[$i];
		$wr_ok    = $$wr_ok;
		$tpif = is_numeric($allidlist[$i])?1:0;
		$sql = $tpif?"id='$allidlist[$i]'":'';
		$uptp = $tpif?"update":"insert into";
		$upbp = $tpif?"where id='$allidlist[$i]'":",lang='$lang'";
		$query="$uptp $met_shop_slist set
				name               = '$name',
				no_order           = '$no_order',
				class1             = '$class1'
				$upbp";
		$db->query($query);
	}
	metsave('../app/shop/pfield.php?anyid='.$anyid.'&lang='.$lang.'&class1='.$class1.'&cs=3&module=3','',$depth);
}elseif($action=="del"){
	$query="delete from $met_shop_slist where id='$id'";
	$db->query($query);
	metsave('../app/shop/pfield.php?anyid='.$anyid.'&lang='.$lang.'&class1='.$class1.'&cs=3&module=3','',$depth);
}elseif($action=="delete"){
	$allidlist=explode(',',$allid);
	foreach($allidlist as $key=>$val){
		$query="delete from $met_shop_slist where id='$val'";
		$db->query($query);
	}
	metsave('../app/shop/pfield.php?anyid='.$anyid.'&lang='.$lang.'&class1='.$class1.'&cs=3&module=3','',$depth);
}elseif($action=="addsave"){
	$newslit = "<tr class='mouse newlist'>\n"; 
	$newslit.= "<td class='list-text'><input name='id' type='checkbox' value='new$lp' checked='checked' /></td>\n";
	$newslit.= "<td class='list-text'><input name='no_order_new$lp' type='text' class='text no_order' /></td>\n";
	$newslit.= "<td class='list-text' style='padding-left:15px; text-align:left;'><input name='name_new$lp' type='text' class='text nonull' /></td></td>\n";	
	$newslit.= "<td class='list-text'>\n";
	$newslit.= "<select name='class1_new$lp' >\n";
	$newslit.= "<option value='0' selected='selected'>$lang_allcategory</option>\n";
		foreach($met_classindex[$module] as $key=>$val1){
	$newslit.= "<option value='$val1[id]' >$val1[name]</option>\n";
		}
	$newslit.= "</select>\n";
	$newslit.= "<td class='list-text'><a href='javascript:;' class='hovertips' style='padding:0px 5px;' onclick='delettr($(this));'>$lang_js49</a></td>\n";
	$newslit.= "</tr>";
	echo $newslit;
}else{
    $query="select * from $met_shop_slist where lang='$lang' order by no_order";
	$list= $db->get_all($query);
	$cs=isset($cs)?$cs:1;
	$listclass[$cs]='class="now"';
	$css_url=$depth."../templates/".$met_skin."/css";
	$img_url=$depth."../templates/".$met_skin."/images";
	include template_app('shop/pfield',$EXT="html");
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>