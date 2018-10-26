<?php
$db_settings = parse_ini_file('../../config/config_db.php');
@extract($db_settings);
require_once '../mysql_class.php';
$db = new dbmysql();
$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);

$query="select * from {$tablepre}bank where bankid='tenpay'";
$parm=$db->get_one($query);

$query="select * from {$tablepre}config where name='met_weburl' and lang='cn'";
$met_weburl=$db->get_one($query);
$met_weburl=$met_weburl['value'];

$partner = trim($parm['partnerid']);
$key = trim($parm['keycode']);
$return_url = $met_weburl.'include/tenpay/return_url.php';
$notify_url = $met_weburl.'include/tenpay/notify.php';
?>