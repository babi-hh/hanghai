<?php
if($mdname=='product'&&$news&&$met_shop_shopok){
	//新模板
	$appscriptcss ="<link rel='stylesheet' type='text/css' href='{$navurl}public/app/shop/css/metinfo.css' />\n";
	$appscriptcss.="<script type='text/javascript'>\nvar metapp_shop_ym=1,shop_lang = '{$lang}',shop_shopid = '{$news[id]}',shop_alertxt='{$lang_Choice}';langnow='{$lang}';\n{$pastr}</script>";
	$met_footstat.="<script src='{$navurl}public/app/shop/js/metinfo.js' type='text/javascript'></script>";
	//老模板
	$methtml_foot.="<script src='{$navurl}public/app/shop/js/metinfo.js' type='text/javascript'></script>";
	$methtml_head.="\n<link rel='stylesheet' type='text/css' href='{$navurl}public/app/shop/css/metinfo.css' />\n";
	$methtml_head.="<script type='text/javascript'>\nvar metapp_shop_ym=1,shop_lang = '{$lang}',shop_shopid = '{$news[id]}',shop_alertxt='{$lang_Choice}';langnow='{$lang}';\n{$pastr}</script>";
}
?>