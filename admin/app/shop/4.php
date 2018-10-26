<?php
global $met_shop_shopok,$lang,$navurl,$met_ch_lang,$met_lang_mark,$index_hadd_ok,$met_waplink,$met_wap;
if($met_shop_shopok){
	if( ((!$met_waplink&&!$met_wap) || !$met_waplink) && !$met_ch_lang)$label='';
	$metinfo.=$label."<a href='{$navurl}member/met_shop_orders.php?lang={$lang}' title='我的订单' class='shopweba'>我的订单</a>";
}
?>