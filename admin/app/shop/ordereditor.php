<?php
$depth='../';
require_once $depth.'../login/login_check.php';
if($action=='modify'){
	$query="select * from $met_shop_orders where id='$id'";
	$orders=$db->get_one($query);
	$total=$total-$oldf+$freight;
	$query="update $met_shop_orders set freight='$freight',waybill='$waybill',total='$total',status='$status',remark='$remark' where id='$id'";
	$db->query($query);
	if($orders['status']<4&&$status==4){
		require_once '../../../include/export.func.php';
		require_once '../../../include/jmail.php';
		if($met_shop_user_shipments_email_ok){
			jmailsend($met_fd_usename,$met_fd_fromname,$orders['email'],$met_shop_user_shipments_email_title,$met_shop_user_shipments_email_content,$met_fd_usename,$met_fd_password,$met_fd_smtp);
		}
		if($met_shop_user_shipments_sms_ok){
			sendsms($orders['tel'],$met_shop_user_shipments_sms_content,6);
		}
		if($met_shop_admin_shipments_email_ok){
			jmailsend($met_fd_usename,$met_fd_fromname,$met_shop_admin_shipments_email_address,$met_shop_admin_shipments_email_title,$met_shop_admin_shipments_email_content,$met_fd_usename,$met_fd_password,$met_fd_smtp);
		}
		if($met_shop_admin_shipments_sms_ok){
			$met_shop_admin_shipments_sms_tel=str_replace('|',',',$met_shop_admin_shipments_sms_tel);
			sendsms($met_shop_admin_shipments_sms_tel,$met_shop_admin_shipments_sms_content,6);
		}
	}
	metsave('../app/shop/index.php?lang='.$lang.'&anyid='.$anyid.'&cs=1','操作成功',$depth);
}
$query="select * from $met_shop_orders where id='$id'";
$orders=$db->get_one($query);
$orders['payment']=$orders['payment']==0?"货到付款":"在线支付";
$status1[$orders['status']]="selected='selected'";
$orders[time]=date('Y-m-d h:i:s',$orders[time]);
$query="select * from $met_shop_shopcart where ordernumber='$orders[ordernumber]'";
$cart=$db->get_all($query);
$met_shop_cash1[$met_shop_cash]="checked='checked'";
$met_shop_invoice1[$met_shop_invoice]="checked='checked'";
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template_app('shop/ordereditor',$EXT="html");
footer();
?>