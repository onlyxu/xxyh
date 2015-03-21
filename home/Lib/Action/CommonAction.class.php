<?php
class CommonAction extends Action{
	public function __construct(){
		parent::__construct();
		Log::$format = '[ Y-m-d H:i:s ]';
		header("Content-Type:text/html; charset=utf-8");

		if(!empty($_SESSION['user'])){

			$u = M("User");
			$user =$u->where("id=%d",$_SESSION["user"]["id"])->find();
			$menu = M("Menu");
			$sql ="select a.id,a.name,a.urls,a.cls,a.pid from tp_menu a left join tp_usermenu b on a.id = b.menuid where 1=1 and a.enabled=1 and a.pid=0 and b.userid=".$user['id'];
			$sql=$sql." order by a.pid asc, a.orders asc ";

			$sql2 ="select a.id,a.name,a.urls,a.cls,a.pid from tp_menu a left join tp_usermenu b on a.id = b.menuid where 1=1 and a.enabled=1 and a.pid !=0 and b.userid=".$user['id'];
			$sql2=$sql2." order by a.pid asc, a.orders asc ";
			$menuList = $menu->query($sql);
			$childmenuList = $menu->query($sql2);

			$form = M("Customerform");
			$sql3 = "select sum(a.sum) as balance from tp_customerform a where 1=1 and a.status =0 and a.userid=".$user["id"];
			$balance = $form->query($sql3);

			$dt = M("Data");
			$bankid = $user["bankid"];
			$bank = $dt->where("id=%d",$bankid)->find();

			$this->assign("balance",doubleval($balance[0]['balance']));
			$this->assign("user",$user);
			$this->assign("bank",$bank);
			$this->assign("menuList",$menuList);
			$this->assign("childmenuList",$childmenuList);
		}else{

		}
	}
}