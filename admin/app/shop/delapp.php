<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
$query="delete from $met_admin_column where url='app/shop/index.php'";
$db->query($query);

$tables_name=explode('|',$met_tablename);
$tables_name_str='';
foreach($tables_name as $key=>$val){
	if(stripos("|shop_orders|shop_shopcart|shop_slist|shop_consignee|shop_slists|shop_province|shop_city|shop_district|shop_journal|shop_balance|",'|'.$val.'|')===false)$tables_name_str.=$val.'|';
}
$tables_name_str=trim($tables_name_str,'|');
$query="update $met_config set value='$tables_name_str' where name='met_tablename'";
$db->query($query);
/*
$query="select * from $met_config where name='met_shop_price'";
$priceids=$db->get_all($query);
foreach($priceids as $key=>$val){
	$query="delete from $met_parameter where id='$val[value]'";
	$db->query($query);
	$query="delete from $met_plist where paraid='$val[value]'";
	$db->query($query);
}
*/
$query="delete from $met_config where name='met_shop_key'";
$db->query($query);
$query="delete from $met_config where name='met_shop_partner'";
$db->query($query);
$query="delete from $met_config where name='met_shop_seller_email'";
$db->query($query);

$query="delete from $met_config where name='met_shop_shopok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_cash'";
$db->query($query);
$query="delete from $met_config where name='met_shop_invoice'";
$db->query($query);
$query="delete from $met_config where name='met_shop_invoicetype'";
$db->query($query);
$query="delete from $met_config where name='met_shop_invoicescontent'";
$db->query($query);
$query="delete from $met_config where name='met_shop_price'";
$db->query($query);
$query="delete from $met_config where name='met_shop_method'";
$db->query($query);


$query="delete from $met_config where name='met_shop_user_orders_email_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_orders_sms_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_payment_email_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_payment_sms_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_shipments_email_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_shipments_sms_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_orders_email_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_orders_sms_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_payment_email_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_payment_sms_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_shipments_email_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_shipments_sms_ok'";
$db->query($query);

$query="delete from $met_config where name='met_shop_user_orders_email_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_orders_sms_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_payment_email_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_payment_sms_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_shipments_email_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_shipments_sms_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_orders_email_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_orders_sms_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_payment_email_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_payment_sms_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_shipments_email_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_shipments_sms_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_orders_email_address'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_orders_sms_tel'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_payment_email_address'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_payment_sms_tel'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_shipments_email_address'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_shipments_sms_tel'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_orders_email_title'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_payment_email_title'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_shipments_email_title'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_orders_email_title'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_payment_email_title'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_shipments_email_title'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_recharge_email_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_recharge_email_title'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_recharge_email_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_recharge_sms_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_user_recharge_sms_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_recharge_email_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_recharge_email_address'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_recharge_email_title'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_recharge_email_content'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_recharge_sms_ok'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_recharge_sms_tel'";
$db->query($query);
$query="delete from $met_config where name='met_shop_admin_recharge_sms_content'";
$db->query($query);			
$query="DROP TABLE $met_shop_consignee";
$db->query($query);
$query="DROP TABLE $met_shop_orders";
$db->query($query);
$query="DROP TABLE $met_shop_shopcart";
$db->query($query);
$query="DROP TABLE $met_shop_slist";
$db->query($query);
$query="DROP TABLE $met_shop_slists";
$db->query($query);
$query="DROP TABLE $met_shop_city";
$db->query($query);
$query="DROP TABLE $met_shop_district";
$db->query($query);
$query="DROP TABLE $met_shop_province";
$db->query($query);
$query="DROP TABLE $met_shop_journal";
$db->query($query);
$query="DROP TABLE $met_shop_balance";
$db->query($query);
unlink('../../../member/templates/met/met_shop_address.html');
unlink('../../../member/templates/met/met_shop_addressview.html');
unlink('../../../member/templates/met/met_shop_orders.html');
unlink('../../../member/templates/met/met_shop_orderview.html');
unlink('../../../member/templates/met/met_shop_settle.html');
unlink('../../../member/templates/met/met_shop_shop.html');
unlink('../../../member/templates/met/met_shop_index_shop.html');
unlink('../../../member/templates/met/met_shop_journal.html');

unlink('../../../member/met_shop_address.php');
unlink('../../../member/met_shop_addressview.php');
unlink('../../../member/met_shop_orders.php');
unlink('../../../member/met_shop_orderview.php');
unlink('../../../member/met_shop_settle.php');
unlink('../../../member/met_shop_shop.php');
unlink('../../../member/met_shop_return.php');
unlink('../../../member/templates/met/met_shop_journal.php');

unlink('../../../include/shopcart.class.php');
deldir('../../../include/alipay');
deldir('../../../public/app/shop');
deldir('../shop');
$query="delete from $met_app where no=9 and download=1";
$db->query($query);
echo "卸载成功,3秒后刷新后台<script type=\"text/javascript\">setTimeout(function (){parent.window.location.reload();},3000);</script>";
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>