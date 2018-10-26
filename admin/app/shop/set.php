<?php
$depth='../';
require_once $depth.'../login/login_check.php';
if($action=='newmethod'){
	$method_return=$method;
	$method=$met_shop_method.'|'.$method;
	$method=trim($method,'|');
	$query="update $met_config set value='$method' where name='met_shop_method' and lang='$lang'";
	$db->query($query);
	$query="select * from $met_config where name='met_shop_method' and lang='$lang'";
	$met_shop_method=$db->get_one($query);
	$met_shop_method=$met_shop_method['value'];
	echo $method_return;
	die;
}
if($action=='del'){
	$met_methods=explode('|',$met_shop_method);
	unset($met_methods[$num-1]);
	$met_shop_method=implode('|',$met_methods);
	$query="update $met_config set value='$met_shop_method' where name='met_shop_method' and lang='$lang'";
	$db->query($query);
	$query="select * from $met_config where name='met_shop_method' and lang='$lang'";
	$met_shop_method=$db->get_one($query);
	$met_shop_method=$met_shop_method['value'];
	metsave('../app/shop/set.php?lang='.$lang.'&anyid='.$anyid.'&cs=2','操作成功',$depth);
}
if($action=='modify'){
	$method=trim($method,'|');
	$query="update $met_config set value='$method' where name='met_shop_method' and lang='$lang'";
	$db->query($query);
	$query="select * from $met_config where name='met_shop_method' and lang='$lang'";
	$met_shop_method=$db->get_one($query);
	$met_shop_method=$met_shop_method['value'];
	$query="update $met_config set value='$met_shop_shopok' where name='met_shop_shopok' and lang='$lang'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_cash' where name='met_shop_cash' and lang='$lang'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_invoice' where name='met_shop_invoice' and lang='$lang'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_price' where name='met_shop_price' and lang='$lang'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_invoicetype' where name='met_shop_invoicetype' and lang='$lang'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_invoicescontent' where name='met_shop_invoicescontent' and lang='$lang'";
	$db->query($query);
	metsave('../app/shop/set.php?lang='.$lang.'&anyid='.$anyid.'&cs=2','操作成功',$depth);
}
$query="select * from $met_parameter where module='3' and class1='0' and lang='$lang'";
$para=$db->get_all($query);
$met_shop_price1[$met_shop_price]="selected='selected'";
$methodnum=0;
if($met_shop_method){
	$met_methods=explode('|',$met_shop_method);
	$methodnum=count($met_methods);
	foreach($met_methods as $key=>$val){
		$met_method1[]=explode(',',$val);
	}
}
$cs=isset($cs)?$cs:1;
$listclass[$cs]='class="now"';
$met_shop_cash1[$met_shop_cash]="checked='checked'";
$met_shop_invoice1[$met_shop_invoice]="checked='checked'";
$met_shop_shopok1[$met_shop_shopok]="checked='checked'";
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template_app('shop/set',$EXT="html");
footer();
?>