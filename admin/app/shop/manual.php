<?php
$depth='../';
require_once $depth.'../login/login_check.php';
if($action=='add'){
	$time=time();
	$query="select * from $met_admin_table where admin_id='$username'";
	$user=$db->get_one($query);
	if(!$user){metsave('../app/shop/manual.php?lang='.$lang.'&anyid='.$anyid.'&cs=6'."&username=$username&state=$state&cost=$cost&remark=$remark",'用户名不存在',$depth);die();}
	$query="select * from $met_shop_balance where userid='$user[id]'";
	$balance=$db->get_one($query);
	if(!$balance){
		$query="insert into $met_shop_balance set userid='$user[id]',balance=$cost";
		$db->query($query);
	}
	$balance=$balance['balance'];
	$balance=$status==1?$balance-$cost:$cost+$balance;
	$query="update $met_shop_balance set balance='$balance' where userid='$user[id]'";
	$db->query($query);
	$query="insert into $met_shop_journal set user_id='$user[id]',user_name='$username',time='$time',state='$status',cost='$cost',balance='$balance',remark='$remark',operate='$metinfo_admin_name',lang='$lang'";
	$db->query($query);
	metsave('../app/shop/financial.php?lang='.$lang.'&anyid='.$anyid.'&cs=6','操作成功',$depth);
}
$state1[$state]="selected=\"selected\"";
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template_app('shop/manual',$EXT="html");
footer();
?>