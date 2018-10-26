<?php
global $met_shop_shopok,$shopon;
if($met_shop_shopok){
	if($type==1){
	$metinfo.="<dt {$shopon[1]}><a href='met_shop_orders.php?lang={$lang}' rel='nofollow' title='我的订单'>我的订单</a></dt>";
	$metinfo.="<dt {$shopon[2]}><a href='met_shop_journal.php?lang={$lang}' rel='nofollow' title='财务管理'>财务管理</a></dt>";
	$metinfo.="<dt {$shopon[3]}><a href='met_shop_address.php?lang={$lang}' rel='nofollow' title='收货地址管理'>收货地址管理</a></dt>";
	}
	else{
	$metinfo.="<li {$shopon[1]}><a href='met_shop_orders.php?lang={$lang}' rel='nofollow' title='我的订单'>我的订单</a></li>";
	$metinfo.="<li {$shopon[2]}><a href='met_shop_journal.php?lang={$lang}' rel='nofollow' title='财务管理'>财务管理</a></li>";
	$metinfo.="<li {$shopon[3]}><a href='met_shop_address.php?lang={$lang}' rel='nofollow' title='收货地址管理'>收货地址管理</a></li>";
	}
}
?>