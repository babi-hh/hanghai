<?php
$depth='../';
require_once $depth.'../login/login_check.php';
if($action=="delete"){
	$query = "select * from $met_shop_orders where id='$id'";
	$order=$db->get_one($query);
	
	$query = "delete from $met_shop_goods where ordernum='$order[ordernumber]'";
	$db->query($query);
	$query = "delete from $met_shop_shopcart where ordernumber='$order[ordernumber]'";
	$db->query($query);
	$query = "delete from $met_shop_orders where id='$id'";
	$db->query($query);
	if($order['status']>2){
		$time=time();
		$query = "select * from  $met_shop_balance where userid='$order[userid]'";
		$balance=$db->get_one($query);
		$query = "update $met_shop_balance set balance=balance+'$order[total]' where userid='$order[userid]'";
		$db->query($query);
		$balance=$balance['balance']+$order['total'];
		$query = "insert into $met_shop_journal set ordernumber='$order[ordernumber]',user_id='$order[userid]',user_name='$order[username]',time='$time',state='2',cost='$order[total]',balance='$balance',remark='订单:$order[ordernumber]退款',operate='$metinfo_admin_name',lang='$lang'";
		$db->query($query);
	}
	metsave('../app/shop/index.php?lang='.$lang.'&anyid='.$anyid.'&cs=1','操作成功',$depth);
}
if($action=="del"){
	$allidlist=explode(',',$allid);
	foreach($allidlist as $key=>$val){
		$query = "select * from $met_shop_orders where id='$val'";
		$order=$db->get_one($query);
		$query = "delete from $met_shop_goods where ordernum='$order[ordernumber]'";
		$db->query($query);
		$query = "delete from $met_shop_shopcart where ordernumber='$order[ordernumber]'";
		$db->query($query);
		$query = "delete from $met_shop_orders where id='$val'";
		$db->query($query);
		if($order['status']>2){
			$time=time();
			$query = "select * from  $met_shop_balance where userid='$order[userid]'";
			$balance=$db->get_one($query);
			$query = "update $met_shop_balance set balance=balance+'$order[total]' where userid='$order[userid]'";
			$db->query($query);
			$balance=$balance['balance']+$order['total'];
			$query = "insert into $met_shop_journal set ordernumber='$order[ordernumber]',user_id='$order[userid]',user_name='$order[username]',time='$time',state='2',cost='$order[total]',balance='$balance',remark='订单:$order[ordernumber]退款',operate='$metinfo_admin_name',lang='$lang'";
			$db->query($query);
		}
	}
	metsave('../app/shop/index.php?lang='.$lang.'&anyid='.$anyid.'&cs=1','操作成功',$depth);
}
$serch_sql=" where lang='$lang' ";
if($status) { $serch_sql .= " and status='$status' "; }
if($search == "detail_search") {        
	if($ordernumber) { $serch_sql .= " and ordernumber like '%$ordernumber%' "; }
	$total_count = $db->counter($met_shop_orders, "$serch_sql", "*");
} else {
	$total_count = $db->counter($met_shop_orders, "$serch_sql", "*");
}
require_once 'include/pager.class.php';
$page = (int)$page;
if($page_input){$page=$page_input;}
$list_num = 16;
$rowset = new Pager($total_count,$list_num,$page);
$from_record = $rowset->_offset();
$query = "SELECT * FROM $met_shop_orders $serch_sql ORDER BY time DESC LIMIT $from_record, $list_num";
$orders = $db->get_all($query);
foreach($orders as $key=>$val){
	if($orders[$key]['status']==1){
		$query="select * from $met_shop_shopcart where ordernumber='$val[ordernumber]'";
		if(!$db->get_one($query)){
			unset($orders[$key]);
			continue;
		}
	}
	$orders[$key]['time']=date('Y-m-d H:i:s',$val['time']);
	switch($orders[$key]['status']){
	case 1:
		$orders[$key]['status']='订购中';
	break;
	case 2:
		$orders[$key]['status']='已下单';
	break;
	case 3:
		$orders[$key]['status']='已付款';
	break;
	case 4:
		$orders[$key]['status']='已发货';
	break;
	case 5:
		$orders[$key]['status']='交易完成';
	break;
	}
	
}
$page_list = $rowset->link("index.php?search=$search&lang=$lang&anyid={$anyid}&ordernumber=$ordernumber&status=$status&page=");
$cs=isset($cs)?$cs:1;
$listclass[$cs]='class="now"';
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template_app('shop/index',$EXT="html");
footer();
?>