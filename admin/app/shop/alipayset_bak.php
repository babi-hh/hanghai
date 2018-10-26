<?php
$depth='../';
require_once $depth.'../login/login_check.php';
if($action=='modify'){
	$query="update $met_config set value='$met_shop_partner' where name='met_shop_partner' and lang='metinfo'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_key' where name='met_shop_key' and lang='metinfo'";
	$db->query($query);
	$query="update $met_config set value='$met_shop_seller_email' where name='met_shop_seller_email' and lang='metinfo'";
	$db->query($query);
	metsave('../app/shop/alipayset.php?lang='.$lang.'&anyid='.$anyid.'&cs=4','操作成功',$depth);
}
$cs=isset($cs)?$cs:1;
$listclass[$cs]='class="now"';
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template_app('shop/alipayset',$EXT="html");
footer();
?>