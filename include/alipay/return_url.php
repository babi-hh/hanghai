<?php
require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {
    $out_trade_no	= $_GET['out_trade_no'];
    $trade_no		= $_GET['trade_no'];
    $total_fee		= $_GET['total_fee'];

    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
	$db->query("update met_shop_orders set status=3 where ordernumber=$out_trade_no");
	$body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支付宝即时到帐付款成功</title>
</head>
<body style="text-align:center;">';
	$body.="
		<div style=\"font:14px/1.8 Tahoma,'Microsoft Yahei','Simsun'; width:560px; margin:0px auto; text-align:left; border:1px solid #ccc; background:#efefef; padding:8px 15px;\">
		<h2 style='color:#390;'>付款成功！</h2>
		<p>付款金额：{$total_fee} 元</p>
		<p>您现在可以：<a href='javascript:self.close()'>关闭该页面</a></p>
		</div>
	";
	$body.='</body></html>';
	echo $body;
}
else {
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />交易出现错误';
}
?>