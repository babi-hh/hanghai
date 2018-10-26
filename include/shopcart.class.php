<?php
class shop{
	//var Goods_arry=array();
	var $ordernumber;
	var $uid;
	public function shop($userid,$ordernumber){//
		global $db,$met_shop_orders,$met_shop_shopcart,$met_admin_table,$lang;
		if($ordernumber){
				$this->ordernumber=$ordernumber;
				$this->uid=$userid;
		}
		else{
			$query="select * from $met_shop_orders where userid='$userid' and status=1";
			$orders=$db->get_one($query);
			if($orders){
				$this->ordernumber=$orders[ordernumber];
				$this->uid=$userid;
			}
			else{
				$query="select * from $met_admin_table where id='$userid'";
				$user=$db->get_one($query);
				$time=time();
				$ordernumber=date('His').mt_rand(100000,999999);
				while($db->get_one("select * from $met_shop_orders where ordernumber='$ordernumber'")){
					$ordernumber=date('His').mt_rand(100000,999999);
				}
				if(!$userid){$user[admin_id]="uid_".$ordernumber;} //xiaochao
				$query="insert into $met_shop_orders set userid='$userid',username='$user[admin_id]',ordernumber='$ordernumber',status='1',time='$time',lang='$lang'";
				$orders=$db->query($query);
				$this->ordernumber=$ordernumber;
				$this->uid=$userid;
			}	
		}
	}
	public function insertgoods($shopid,$shopnum,$shopdescription){
		global $db,$met_shop_orders,$met_shop_shopcart,$met_product,$met_shop_price,$met_plist;
		$query="select * from $met_product where id='$shopid'";
		$good=$db->get_one($query);
		$query="select * from $met_plist where listid='$shopid' and paraid='$met_shop_price'";
		$para=$db->get_one($query);
		preg_match('/([0-9\.]+)/',$para[info],$out);
		$para[info]=$out[0];
		$query="select * from $met_shop_shopcart where shopid='$shopid' and shopdescription='$shopdescription' and ordernumber='$this->ordernumber'";
		if($db->get_one($query)){
		//单价不一样应该返回错误
			$query="update $met_shop_shopcart set shopnum=shopnum+'$shopnum',unitprice='$para[info]' where shopid='$shopid' and ordernumber='$this->ordernumber'";
		}
		else{
			$query="insert into $met_shop_shopcart set shopid='$good[id]',shopname='$good[title]',shopdescription='$shopdescription',unitprice='$para[info]',shopnum='$shopnum',ordernumber='$this->ordernumber'";
		}
		return $db->query($query);
	}
	public function getgoods(){
		global $db,$met_shop_orders,$met_shop_shopcart;
		$query="select * from $met_shop_shopcart where ordernumber='$this->ordernumber'";
		$goods=$db->get_all($query);
		if(count($goods)==0){
			$query="delete from $met_shop_orders where userid='$this->uid' and ordernumber='$this->ordernumber'";
			$db->query($query);
		}
		return $goods;
	}
	public function delgoods($shopid){
		global $db,$met_shop_orders,$met_shop_shopcart;
		$query="delete from $met_shop_shopcart where id='$shopid' and ordernumber='$this->ordernumber'";
		return $db->query($query);
	}
	public function getorders(){
		global $db,$met_shop_orders,$met_shop_shopcart;
		$query="select * from $met_shop_orders where userid='$this->uid' and ordernumber='$this->ordernumber'";
		return $db->get_one($query);
	}
	public function changeorders($consignee,$address,$tel,$email,$postal,$payment,$method,$freight,$invoice,$invoicetype,$invoicescontent,$total,$status){
		global $db,$met_shop_orders,$met_shop_shopcart;
		$time=time();
		$query="update $met_shop_orders set consignee='$consignee',address='$address',tel='$tel',email='$email',postal='$postal',payment='$payment',method='$method',freight=$freight,invoice='$invoice',invoicetype='$invoicetype',invoicescontent='$invoicescontent',total='$total',status='$status',time='$time' where userid='$this->uid' and ordernumber='$this->ordernumber'";
		return $db->get_one($query);
	}
	public function setamount($shopid,$shopamount,$amountype){
		global $db,$met_shop_orders,$met_shop_shopcart;
		$str=$amountype=='set'?($shopamount<1?"'1'":"'".$shopamount."'"):($amountype=='add'?'shopnum+'."'".$shopamount."'":'shopnum-'."'".$shopamount."'");
		if($amountype=='reduce')$sql=" and shopnum!=1";
		$query="update $met_shop_shopcart set shopnum=$str where shopid='$shopid' and ordernumber='$this->ordernumber' $sql";
		return $db->query($query);
	}
	public function gettotal(){
		global $db,$met_shop_orders,$met_shop_shopcart;
		$goods=$this->getgoods();
		$total=0;
		foreach($goods as $key=>$val){
			$total+=$val['shopnum']*$val['unitprice'];
		}
		return $total;
	}
}
?>