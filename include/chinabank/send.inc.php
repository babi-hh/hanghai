<?php
$db_settings = parse_ini_file('../../config/config_db.php');
@extract($db_settings);
require_once '../mysql_class.php';
$db = new dbmysql();
$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
$query="select * from {$tablepre}bank where bankid='chinabank'";
$partner=$db->get_one($query);

$query="select * from {$tablepre}config where name='met_weburl' and lang='cn'";
$met_weburl=$db->get_one($query);
$met_weburl=$met_weburl['value'];

$v_mid = $partner['partnerid']; // 商户号
$v_url = $receive_url; // 返回url
$key = $partner['keycode']; // MD5密钥

$v_oid = $_GET['orders']; 
$v_amount = $_GET['total']; //支付金额                 
$v_moneytype = 'CNY'; //币种

$text = $v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key; //md5加密拼凑串,注意顺序
$v_md5info = strtoupper(md5($text));

$remark1 = $charge_title ? $charge_title : $DT['sitename'].' - 会员['.$_username.']帐户充值'; //备注字段1
$remark2 = isset($remark2) ? trim($remark2) : ''; //备注字段2
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>正在跳转到网银在线在线支付平台...</title>
</head>
<body onLoad="document.getElementById('pay').submit();">
<form method="post" action="https://pay.chinabank.com.cn/select_bank" id="pay" target="_self">
<input type="hidden" name="v_mid"       value="<?php echo $v_mid;?>">
<input type="hidden" name="v_oid"       value="<?php echo $v_oid;?>">
<input type="hidden" name="v_amount"    value="<?php echo $v_amount;?>">
<input type="hidden" name="v_moneytype" value="<?php echo $v_moneytype;?>">
<input type="hidden" name="v_url"       value="<?php echo $v_url;?>">
<input type="hidden" name="v_md5info"   value="<?php echo $v_md5info;?>">
<input type="hidden" name="remark1"     value="<?php echo $remark1;?>">
<input type="hidden" name="remark2"     value="<?php echo $remark2;?>">
</form>
</body>
</html>