<?php
$depth='../';
require_once $depth.'../login/login_check.php';
if($action=='modify'){
	foreach($_POST['pay'] as $k=>$v){
		$up_sql="";
		foreach($v as $k2=>$v2)
			{
			 $v2 = addslashes($v2);
	 		$up_sql.="$k2='$v2',";
			}
	 	$up_sql=substr($up_sql,0,-1);
	 	$query="update met_bank set ".$up_sql." where bankid='$k'";
	 	$db->query($query);
	}
	/*
	$query="update $met_config set value='$met_shop_partner' where name='met_shop_partner' and lang='metinfo'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_key' where name='met_shop_key' and lang='metinfo'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_seller_email' where name='met_shop_seller_email' and lang='metinfo'";
	$db->query($query);
	*/
	metsave('../app/shop/alipayset.php?lang='.$lang.'&anyid='.$anyid.'&cs=4','操作成功',$depth);
}
$query="select * from met_bank";
$result =$db->query($query);
while($list= $db->fetch_array($result)){
	if($list[id]==1){
	 $row['tenpay']=$list;
	}elseif($list[id]==2){
	 $row['alipay']=$list;
	}elseif($list[id]==3){
	 $row['chinabank']=$list;
	}
}

$cs=isset($cs)?$cs:1;
$listclass[$cs]='class="now"';
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template_app('shop/alipayset',$EXT="html");
footer();
?>