<?php
require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
header("Content-type: text/html;charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyNotify();
if($verify_result) {
	$out_trade_no	= $_POST['out_trade_no'];
    $trade_no		= $_POST['trade_no'];
    $total_fee		= $_POST['total_fee'];
	$subject		= $_POST['subject'];	
	$body		    = $_POST['body'];
	$status         = $_POST['trade_status'];
	$refund_status  = $_POST['refund_status'];
    if($status == 'TRADE_FINISHED'||$status == 'TRADE_SUCCESS') {
		$db_settings = parse_ini_file('../../config/config_db.php');
		@extract($db_settings);
		require_once '../mysql_class.php';
		require_once '../export.func.php';
		require_once '../jmail.php';
		$time=time();
		$db = new dbmysql();
		$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
		$query="select * from {$tablepre}config where name='met_tablename' and lang='metinfo'";
		$mettable=$db->get_one($query);
		$mettables=explode('|',$mettable[value]);
		foreach($mettables as $key=>$val){
			$tablename='met_'.$val;	
			$$tablename=$tablepre.$val;
		}
		if(mb_substr($subject,0,2,'utf-8')=='订单'){
			$query="select * from {$tablepre}shop_orders where ordernumber='$out_trade_no'";
			$orders=$db->get_one($query);
			if($orders){
				$query = "SELECT * FROM {$tablepre}config WHERE lang='$orders[lang]' or lang='metinfo'";
				$result = $db->query($query);
				while($list_config= $db->fetch_array($result)){
					$settings_arr[]=$list_config;
					if($list_config['columnid']){
						$settings[$list_config['name'].'_'.$list_config['columnid']]=$list_config['value'];
					}else{
						$settings[$list_config['name']]=$list_config['value'];
					}
				}
				@extract($settings);
				if($orders['status']<3){
					$query="update {$tablepre}shop_orders set status='3',alipay='$trade_no' where ordernumber='$out_trade_no'";
					$db->query($query);
					$query="select * from {$tablepre}admin_table where id='$orders[userid]'";
					$user=$db->get_one($query);
					if($user){
						$query="select * from $met_shop_balance where userid='$user[id]'";
						$balance=$db->get_one($query);
						if(!$balance){
							$query="insert into $met_shop_balance set userid='$user[id]',balance=0";
							$db->query($query);
						}
						$balance=$balance[balance];
						$balance=$balance+$total_fee;
						$query="insert into {$tablepre}shop_journal set alipay_id='$trade_no',ordernumber='$out_trade_no',user_id='$user[id]',user_name='$user[admin_id]',time='$time',state='2',cost='$total_fee',balance='$balance',remark='订单{$out_trade_no}充值,支付宝号：{$trade_no}',lang='$lang'";
						$db->query($query);
						$balance=$balance-$total_fee;
						$query="insert into {$tablepre}shop_journal set ordernumber='$out_trade_no',user_id='$user[id]',user_name='$user[admin_id]',time='$time',state='1',cost='$total_fee',balance='$balance',remark='订单{$out_trade_no}扣款',lang='$lang'";
						$db->query($query);
						if($met_shop_user_payment_email_ok){
							jmailsend($met_fd_usename,$met_fd_fromname,$orders['email'],$met_shop_user_payment_email_title,$met_shop_user_payment_email_content,$met_fd_usename,$met_fd_password,$met_fd_smtp);
						}
						if($met_shop_user_payment_sms_ok){
							sendsms($orders['tel'],$met_shop_user_payment_sms_content,6);
						}
						if($met_shop_admin_payment_email_ok){
							jmailsend($met_fd_usename,$met_fd_fromname,$met_shop_admin_payment_email_address,$met_shop_admin_payment_email_title,$met_shop_admin_payment_email_content,$met_fd_usename,$met_fd_password,$met_fd_smtp);
						}
						if($met_shop_admin_payment_sms_ok){
							$met_shop_admin_payment_sms_tel=str_replace('|',',',$met_shop_admin_payment_sms_tel);
							sendsms($met_shop_admin_payment_sms_tel,$met_shop_admin_payment_sms_content,6);
						}
					}
				}
			}
		}
		else{
			$recharge_id=mb_substr($out_trade_no,14);
			$query="select * from {$tablepre}admin_table where id='$recharge_id'";
			$user=$db->get_one($query);
			if($user){
				$query="select * from {$tablepre}shop_balance where userid='$user[id]'";
				$balance=$db->get_one($query);
				if(!$balance){
					$query="insert into {$tablepre}shop_balance set userid='$user[id]',balance='$total_fee'";
					$db->query($query);
				}
				$balance=$balance['balance'];
				$balance=$total_fee+$balance;
				$query="update {$tablepre}shop_balance set balance='$balance' where userid='$user[id]'";
				$db->query($query);
				$query="insert into {$tablepre}shop_journal set alipay_id='$trade_no',user_id='$user[id]',user_name='$user[admin_id]',time='$time',state='2',cost='$total_fee',balance='$balance',remark='用户充值,支付宝号:$trade_no',lang='$lang'";
				$db->query($query);	
				$bodys=explode('-',$body);
				$query = "SELECT * FROM {$tablepre}config WHERE lang='$bodys[2]' or lang='metinfo'";
				$result = $db->query($query);
				while($list_config= $db->fetch_array($result)){
					$settings_arr[]=$list_config;
					if($list_config['columnid']){
						$settings[$list_config['name'].'_'.$list_config['columnid']]=$list_config['value'];
					}else{
						$settings[$list_config['name']]=$list_config['value'];
					}
				}
				@extract($settings);
				if($met_shop_user_recharge_email_ok){
					jmailsend($met_fd_usename,$met_fd_fromname,$user['admin_email'],$met_shop_user_recharge_email_title,$met_shop_user_recharge_email_content,$met_fd_usename,$met_fd_password,$met_fd_smtp);
				}
				if($met_shop_user_recharge_sms_ok){
					sendsms($user['admin_mobile'],$met_shop_user_recharge_sms_content,6);
				}
				if($met_shop_admin_recharge_email_ok){
					jmailsend($met_fd_usename,$met_fd_fromname,$met_shop_admin_recharge_email_address,$met_shop_admin_recharge_email_title,$met_shop_admin_recharge_email_content,$met_fd_usename,$met_fd_password,$met_fd_smtp);
				}
				if($met_shop_admin_recharge_sms_ok){
					$met_shop_admin_recharge_sms_tel=str_replace('|',',',$met_shop_admin_recharge_sms_tel);
					sendsms($met_shop_admin_recharge_sms_tel,$met_shop_admin_recharge_sms_content,6);
				}
			}
		}
		
    }
	echo "success";
}
else {
    echo "fail";
}

?>