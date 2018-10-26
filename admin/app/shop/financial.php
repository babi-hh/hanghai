<?php
$depth='../';
require_once $depth.'../login/login_check.php';
if($action=="delete"){
	$query = "select * from $met_shop_journal where id='$id'";
	$journal=$db->get_one($query);
	$balance=$journal[state]==1?"balance+'$journal[cost]'":"balance-'$journal[cost]'";
	$query="update $met_shop_balance set balance=$balance where userid='$journal[user_id]'";
	$db->query($query);
	$query = "delete from $met_shop_journal where id='$id'";
	$db->query($query);
	metsave('../app/shop/financial.php?lang='.$lang.'&anyid='.$anyid.'&cs=6','操作成功',$depth);
}
if($action=="del"){
	$allidlist=explode(',',$allid);
	foreach($allidlist as $key=>$val){
		$query = "select * from $met_shop_journal where id='$val'";
		$journal=$db->get_one($query);
		$balance=$journal[state]==1?"balance+'$journal[cost]'":"balance-'$journal[cost]'";
		$query="update $met_shop_balance set balance=$balance where userid='$journal[user_id]'";
		$db->query($query);
		$query = "delete from $met_shop_journal where id='$val'";
		$db->query($query);
	}
	metsave('../app/shop/financial.php?lang='.$lang.'&anyid='.$anyid.'&cs=6','操作成功',$depth);
}
//$serch_sql=" where lang='$lang' ";
if($search == "detail_search") {  
$oreder_timefrom=$oreder_timefrom?strtotime("$oreder_timefrom 00:00:00"):0;
$oreder_timeto=$oreder_timeto?strtotime("$oreder_timeto 23:59:59"):0;
$serch_sql=" where 1=1 ";
if($status) { $serch_sql .= " and state='$status' "; }   
if($username) { $serch_sql .= " and user_name like '%$username%' "; }
if($oreder_timefrom) { $serch_sql .= " and time>='$oreder_timefrom' "; } 
if($oreder_timeto) { $serch_sql .= " and time<='$oreder_timeto'"; } 
	$total_count = $db->counter($met_shop_journal, "$serch_sql", "*");
} else {
	$total_count = $db->counter($met_shop_journal, "", "*");
}
require_once 'include/pager.class.php';
$page = (int)$page;
if($page_input){$page=$page_input;}
$list_num = 16;
$rowset = new Pager($total_count,$list_num,$page);
$from_record = $rowset->_offset();
$query = "SELECT * FROM $met_shop_journal $serch_sql ORDER BY ID DESC LIMIT $from_record, $list_num";
$finnacial = $db->get_all($query);
foreach($finnacial as $key=>$val){
	if($val['state']==1){
		$finnacial[$key]['state']='扣款';
		$finnacial[$key]['cost']='-'.$val['cost'];
	}
	else{
		$finnacial[$key]['state']='入款';
		$finnacial[$key]['cost']='+'.$val['cost'];
	}
	$finnacial[$key]['time']=date('Y-m-d H:i:s',$val['time']);
	$finnacial[$key]['remark']=$val['operate']?$val['remark'].'(操作：'.$val['operate'].')':$val['remark'];
}
$page_list = $rowset->link("financial.php?search=$search&lang={$lang}&anyid={$anyid}&user_name={$username}&oreder_timefrom={$oreder_timefrom}&oreder_timeto={$oreder_timeto}&status={$status}&cs={$cs}&page=");
$searchtext=$username?$username:'用户名称';
$cs=isset($cs)?$cs:1;
$listclass[$cs]='class="now"';
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template_app('shop/financial',$EXT="html");
footer();
?>