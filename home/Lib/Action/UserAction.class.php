<?php


class UserAction extends CommonAction{

	public function goUserUpdatePass()
	{

		$index = new IndexAction();
		$index->addOperLog("User/goUserUpdatePass", "修改密码页面");
		$this->display("updatepass");
	}

	public function updateUserPass()
	{
		$user = session("user");
		$utils = new UtilAction();
		$u = M("User");
		$pass = $_GET["pass"];
		$newpass = $_GET["newpass"];

		$keys = $user["loginkey"];
		$loginpass = $user["loginpass"];

		$pa = $utils->encrypt($pass, $keys);
		if($loginpass != $pa)
		{

			$msg = "原密码错误！";
			$errorcode =1;
		}else{


			$newkey = $utils->randstr(6);
			$newp = $utils->encrypt($newpass, $newkey);

			$data["loginpass"]=$newp;
			$data["loginkey"]=$newkey;
			$u->where("id=%d",$user['id'])->save($data);

			session_destroy();
			$msg = "修改成功，请重新登录！";
			$errorcode =-1;
		}

		$index = new IndexAction();
		$index->addOperLog("User/updateUserPass", "修改密码");

		$da["msg"]=$msg;
		$da["errorcode"]=$errorcode;

		$this->ajaxReturn($da);

	}

	public function goGetMyChild()
	{

		$index = new IndexAction();
		$index->addOperLog("User/goGetMyChild", "我的下级页面");
		$this->display("mychild");
	}

	public function getAllByChild()
	{
		$user = session("user");
		$u = M("User");
		$arr = $u->select();

		$child = $this->getMyChild($arr,$user['id']);

		$data["child"]=$child;

		$index = new IndexAction();
		$index->addOperLog("User/getAllByChild", "我的下级");

		$this->ajaxReturn($data);

	}

	public function goUserPayInfo()
	{
		$index = new IndexAction();
		$index->addOperLog("User/goUserPayInfo", "我的充值记录页面");
		$this->display("addpayinfo");
	}

	/**
	 * 用户充值
	 */
	public function addUserPayInfo()
	{

		$money = $_POST["money"];
		$useinfo = $_POST["useinfo"];
		$needs = $_POST["needs"];
		$prono = $_POST["prono"];
		$dtime = date('Y-m-d H:i');
		$user = session("user");

		$pay = M("Payinfo");

		$data["money"]=$money;
		$data["dtime"]=$dtime;
		$data["useinfo"]=$useinfo;
		$data["needs"]=$needs;
		$data["prono"]=$prono;
		$data["userid"]=$user['id'];
		$data["status"]=0;
		$pay->startTrans();

		try {

			$pay->add($data);

			$index = new IndexAction();
			$index->addOperLog("User/addUserPayInfo", "用户充值");

			$pay->commit();
		} catch (Exception $e) {
			$pay->rollback();
		}

		self::getMyPayInfo();
	}

	public function  getMyPayInfo()
	{

		$pay = M("Payinfo");
		$user = session("user");
		$count = $pay->where("userid=%d",$user["id"])->count();// 查询满足要求的总记录数

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql ="select a.id,a.money,a.useinfo,a.needs,a.prono,a.status,a.dtime from tp_payinfo a  where 1=1 and a.userid=".$user["id"];
		$list = $pay->query($sql);
		//dump($list);
		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/getMyPayInfo", "用户充值记录");

		$this->display("mypayinfo");

	}

	public function  getAllPayInfo()
	{

		$pay = M("Payinfo");
		$user = session("user");
		$count = $pay->where("")->count();// 查询满足要求的总记录数

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql ="select a.id,a.money,a.useinfo,a.needs,a.prono,a.status,a.dtime,b.name from tp_payinfo a left join tp_user b on a.userid = b.id  where 1=1 ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";
		$list = $pay->query($sql);
		//dump($list);
		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/getAllPayInfo", "全部充值记录");

		$this->display("allpayinfo");

	}


	public function getUserInfo()
	{
		$index = new IndexAction();
		$index->addOperLog("User/getUserInfo", "用户信息页面");
		$this->display("userinfo");
	}

	public function checkGetMoney()
	{

		$user = $_SESSION["user"];
		$u = M("User");

		try {

			$sum = $u->where("pid=%d",$user['id'])->count("id");
			$sum = intval($sum);
			if($sum>=5)
			{
				$msg="可以提现";
				$errorcode = -1;
			}else{
				$msg="直接发展用户不足五人，无权提现";
				$errorcode = -1;
			}

		} catch (Exception $e) {
			$msg="系统异常，请稍后重试";
			$errorcode = 1;
		}

		$index = new IndexAction();
		$index->addOperLog("User/checkGetMoney", "检查用户提现权限");

		$data["msg"]=$msg;
		$data["errorcode"]=$errorcode;
		$this->ajaxReturn($data);
	}

	public function getBalanceMoney()
	{

		$us = session("user");
		$u = M("User");
		$user = $u->where("id=%d",$us["id"])->find();
		$money = $_GET["money"];
		$balance = $user["ticheng"];
		$dtime = date('Y-m-d H:i');
		$tx = M("Tixian");
		$tx->startTrans();

		try {

			if(doubleval($balance)>=doubleval($money))
			{
				$data["dtime"]=$dtime;
				$data["userid"]=$user["id"];
				$data["money"]=$money;
				$data["status"]=0;
				/* $data["xiaofei"] = doubleval($user["xiaofei"]+$money);
				$data["ticheng"] =doubleval($user["ticheng"]-$money);
				$u->where("id=%d",$user["id"])->save($data); */
				$tx->add($data);
				$errorcode = -1;
				$msg = "申请成功！";
			}else{

				$errorcode = 2;
				$msg = "余额不足！";
			}

			$tx->commit();


		} catch (Exception $e) {
			$u->rollback();
			$errorcode = 1;
			$msg = "提现失败！";
		}

		$index = new IndexAction();
		$index->addOperLog("User/getBalanceMoney", "用户提现");

		$da["errorcode"]=$errorcode;
		$da["msg"]=$msg;

		$this->ajaxReturn($da);

	}

	public function getMyTiXian()
	{

		$tx = M("Tixian");
		$user = session("user");
		$count = $tx->where("userid=%d",$user["id"])->count();// 查询满足要求的总记录数

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql ="select a.id,a.money,a.dtime,a.status from tp_tixian a where 1=1 and a.userid =".$user["id"];
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";
		$list = $tx->query($sql);
		//dump($list);
		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/getMyTiXian", "我的提现记录");

		$this->display("mytixian");

	}

	public function getAllTiXian()
	{

		$tx = M("Tixian");

		$count = $tx->where("")->count();// 查询满足要求的总记录数

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql ="select a.id,a.money,a.dtime,a.status,b.name,b.yeji from tp_tixian a left join tp_user b on a.userid = b.id  where 1=1 ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";
		$list = $tx->query($sql);
		//dump($list);
		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/getAllTiXian", "全部提现记录");

		$this->display("alltixian");

	}

	public function UpdateTiXian()
	{

		$id = $_GET["id"];
		$status = $_GET["status"];

		$u = M("User");
		$dtime = date('Y-m-d H:i');
		$tx = M("Tixian");

		$tx->startTrans();

		try {

			$tixian = $tx->where("id=%d",$id)->find();
			//更新提现状态
			$data["status"]=$status;
			$tx->where("id=%d",$id)->save($data);
			//更新用户账户余额
			$us = session("user");
			$user = $u->where("id=%d",$us["id"])->find();
			$da["xiaofei"] = doubleval($user["xiaofei"]+$tixian['money']);
			$da["ticheng"] =doubleval($user["ticheng"]-$tixian['money']);
			$u->where("id=%d",$user["id"])->save($da);
			$tx->commit();

			$msg="成功！";
			$errorcode=-1;
		} catch (Exception $e) {

			$tx->rollback();
			$msg="失败！";
			$errorcode=1;
		}

		$index = new IndexAction();
		$index->addOperLog("User/UpdateTiXian", "审核用户提现");

		$da["msg"]=$msg;
		$da["errorcode"]=$errorcode;

		$this->ajaxReturn($da);
	}



	public function getUserInfoEdit()
	{

		$user = session("user");
		$user["loginpass"]="";
		$this->assign("userinfo",$user);

		$index = new IndexAction();
		$index->addOperLog("User/getUserInfoEdit", "编辑用户信息");
		$da = M("Data");
		$sql = "select a.id,a.value from tp_data a left join tp_datatype b on a.typeid = b.id  where 1=1 and a.enabled =1 and b.keyword='bank' order by a.orders asc";
		$bankList = $da->query($sql);
		$this->assign("bankList",$bankList);
		$this->display("useredit");
	}

	public function  saveUserInfo()
	{
		$id = $_POST["id"];
		$loginname = $_POST["loginname"];
		$name = $_POST["name"];
		$tele = $_POST["tele"];
		$email = $_POST["email"];
		$cardid = $_POST["cardid"];
		$bankcard = $_POST["bankcard"];
		$receiveaddr = $_POST["receiveaddr"];
		$bankid = $_POST["bankid"];

		$user = M("User");
		$user->startTrans();
		$data["loginname"]=$loginname;
		$data["name"]=$name;
		$data["tele"]=$tele ;
		$data["email"]=$email;
		$data["cardid"]=$cardid;
		$data["receiveaddr"]=$receiveaddr;
		$data["bankcard"]=$bankcard;
		$data["bankid"]=$bankid;
		if($id)
		{
			$s = $user->where("id=%d",$id)->save($data);

		}else{
			$s = $user->add($data);
		}

		if($s)
		{
			$user->commit();
		}else{
			$user->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("User/saveUserInfo", "增加用户信息");

		self::getUserInfo();
	}

	public function  userManager()
	{

		$user = M("User");

		$count = $user->where("")->count();// 查询满足要求的总记录数

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql ="select a.id,a.name,a.loginname,a.dtime,a.enabled,a.orders,a.xiaofei,a.ticheng,a.yeji,b.name as rolename,b.id as roleid from tp_user a left join tp_role b on b.id = a.roleid  where 1=1  ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";
		$list = $user->query($sql);
		//dump($list);
		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/userManager", "用户信息管理");

		$this->display("userManager");

	}

	public function roleManager()
	{
		$role = M("Role");

		$count = $role->where("")->count();// 查询满足要求的总记录数

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$list = $role->where("")->select();
		//dump($list);
		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/roleManager", "角色信息管理");

		$this->display("roleManager");
	}

	public function menuManager()
	{
		$menu = M("Menu");

		$count = $menu->where("")->count();// 查询满足要求的总记录数

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$list = $menu->where("")->select();
		//dump($list);
		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/menuManager", "导航信息管理");

		$this->display("menuManager");
	}

	public function getContactList()
	{

		$contact = M("Contact");
		$user = session("user");
		$userid = $user["id"];
		$count = $contact->where("userid=%d",$userid)->count();// 查询满足要求的总记录数
		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql = "select a.id,a.dtime,a.name,a.nickname,a.keys,a.addr,a.tele,a.email  from tp_contact a where 1=1 and a.userid=".$userid;
		$sql = $sql." order by a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $contact->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/getContactList", "获取联系人");

		$this->display("contactList");
	}

	public function  deleteContact()
	{

		$ids =$_GET["ids"];
		$contact = M("Contact");
		$id = explode(",",$ids);

		$contact->startTrans();

		try {

			foreach ($id as $i)
			{
				$contact->where("id=%d",$i)->delete();
				$index = new IndexAction();
				$index->addOperLog("User/deleteContact", "删除联系人");
			}
			$contact->commit();
			$msg = "删除成功！";
			$errorcode =-1;
		} catch (Exception $e) {
			$contact->rollback();
			$msg = "删除失败！";
			$errorcode =1;
		}

		$da["msg"]= $msg;
		$da["errorcode"]=$errorcode;
		$this->ajaxReturn($da);
	}

	public function goAddContact()
	{
		$index = new IndexAction();
		$index->addOperLog("User/goAddContact", "增加联系人页面");
		$id = $_POST["id"];
		$contact = M("Contact");
		$con = $contact->where("id=%d",$id)->find();
		$this->assign("contact",$con);
		$this->display("addcontact");
	}

	public function addContact()
	{
		$dtime = date('Y-m-d H:i');
		$user = session("user");

		$name = $_POST["name"];
		$nickname = $_POST["nickname"];
		$tele = $_POST["tele"];
		$addr = $_POST["addr"];
		$phones = $_POST["phones"];
		$email = $_POST["email"];
		$id = $_POST["id"];

		$contact = M("Contact");
		$data["id"]=$name;
		$data["name"]=$name;
		$data["nickname"]=$nickname;
		$data["tele"]=$tele;
		$data["addr"]=$addr;
		$data["phones"]=$phones;
		$data["email"]=$email;
		$data["userid"]=$user["id"];

		$contact->startTrans();

		try {

			if($id)
			{
				$contact->where("id=%d",$id)->save($data);
			}else{
				$contact->add($data);
			}

			$contact->commit();
		} catch (Exception $e) {
			$contact->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("User/addContact", "增加联系人");
		self::getContactList();
	}

	public  function  deleteAllUser()
	{

		$ids = $_GET["ids"];
		$user = M("User");

		if($ids)
		{
			$id = explode(",",$ids);
		}

		$user->startTrans();
		try {

			foreach ($id as $key => $value)
			{
				$value = intval($value);
				$user->where("id=%d",$value)->delete();

				$index = new IndexAction();
				$index->addOperLog("User/deleteAllUser", "删除联系人");
			}

			$user->commit();
			$data["msg"]="ok";
			$data["errorcode"]=-1;

		} catch (Exception $e) {
			$user->rollback();
			$data["msg"]="删除失败";
			$data["errorcode"]=1;
		}

		$this->ajaxReturn($data);
	}

	public function  goAddUser()
	{

		$r = M("Role");
		$rolelist =$r->select();
		$this->assign("rolelist",$rolelist);

		$index = new IndexAction();
		$index->addOperLog("User/goAddUser", "添加用户页面");

		$id = $_POST["id"];
		$u = M("User");
		$da = M("Data");
		$sql = "select a.id,a.value from tp_data a left join tp_datatype b on a.typeid = b.id  where 1=1 and a.enabled =1 and b.keyword='bank' order by a.orders asc";
		$bankList = $da->query($sql);
		$this->assign("bankList",$bankList);
		$user = $u->where("id=%d",$id)->find();
		$this->assign("user",$user);
		$this->display("adminadduser");

	}

	public function addUserInfo()
	{

		$u = M("User");
		$ur = M("Userrole");

		$dtime = date('Y-m-d H:i');
		$id = $_POST["id"];
		$loginname= $_POST["loginname"];
		$name = $_POST["name"];
		$tele = $_POST["tele"];
		$balance = $_POST["balance"];
		$roleid = $_POST["roleid"];
		$email = $_POST["email"];
		$bankcard = $_POST["bankcard"];
		$receiveaddr= $_POST["receiveaddr"];
		$refuser = $_POST["refuser"];
		$cardid = $_POST["cardid"];
		$sex = $_POST["sex"];
		$bankid = $_POST["bankid"];

		$data["bankid"]=$bankid;
		$data["sex"]=$sex;
		$data["loginname"]=$loginname;
		$data["name"]=$name;
		$data["tel"]=$tele;
		$data["email"]=$email;
		$data["benci"]=$balance;
		$data["xiaofei"]=doubleval($data["xiaofei"]+$balance);
		$data["bankcard"]=$bankcard;
		$data["refuser"]=$refuser;
		$data["receiveaddr"]=$receiveaddr;
		$data["cardid"]=$cardid;
		//获取推荐人信息
		$puser = $u->where("name='$refuser' or loginname ='$refuser' ")->find();
		if($puser)
		{
			$data["pid"]=$puser["id"];
		}

		$utils = new UtilAction();
		$keys = $utils->randstr(6);
		$data["loginkey"]=$keys;
		$pass = $utils->encrypt("000000", $keys);
		$data["loginpass"] = $pass;
		$data["dtime"] = $dtime;
		$data["roleid"] = $roleid;
		$u->startTrans();

		try {

			if($id)
			{
				$u->where("id=%d",$id)->save($data);
			}else{
				$u->add($data);
			}

			$u->commit();

		} catch (Exception $e) {

			$u->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("User/addUserInfo", "添加用户信息");
		self::userManager();
	}

	public function changeUserInfo()
	{

		$enabled = $_GET["enabled"];
		$id = $_GET["id"];
		$dtime = date('Y-m-d H:i');
		$u = M("User");
		$u->startTrans();


		try {
			$data["enabled"]=$enabled;
			$u->where("id=%d",$id)->save($data);
			$user = $u->where("id=%d",$id)->find();
			if($enabled==1)
			{
				if($user['benci']>0)
				{
					//审核通过、增加充值记录、增加其上级提成
					$pay = M("Payinfo");
					$da["money"]=$user["benci"];
					$da["dtime"]=$dtime;
					$da["useinfo"]="入会充值";
					$da["needs"]="";
					$da["prono"]="";
					$da["userid"]=$user['id'];
					$da["status"]=1;
					$pay->add($da);
					//更新上级提成
					self::calcPayMoney($user["id"],$user["pid"],1, $user["benci"]);
					//更细用户本次充值
					$d["benci"]=0;
					$u->where("id=%d",$id)->save($d);
				}

			}
			$u->commit();
			$msg = "审核成功！";
			$errorcode =-1;

		} catch (Exception $e) {

			$u->rollback();
			$msg = "审核失败！";
			$errorcode =1;
		}

		$index = new IndexAction();
		$index->addOperLog("User/changeUserInfo", "审核用户信息");

		$da["msg"]= $msg;
		$da["errorcode"]=$errorcode;
		$this->ajaxReturn($da);

	}


	public function getAllMenuList()
	{
		$m = M("Menu");

		$count = $m->where("")->count();// 查询满足要求的总记录数
		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql = "select a.id,a.dtime,a.name,a.pid,a.urls,a.enabled,a.orders,a.cls from tp_menu a where 1=1   ";
		$sql = $sql." order by a.pid asc, a.orders asc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $m->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("User/getAllMenuList", "全部导航信息");

		$this->display("menuManager");

	}

	public function getMenuTree()
	{

		$index = new IndexAction();
		$index->addOperLog("User/getMenuTree", "导航菜单树");

		$m = M("Menu");
		$userid= $_POST["userid"];
		$menuList = $m->where("")->select();

		$this->assign("menuList",$menuList);
		$this->assign("userid",$userid);

		$this->display("menutree");
	}

	public function changeUserPower()
	{

		$userid = $_POST["userid"];
		$menuids = $_POST["menuid"];

		$rm = M("Usermenu");

		$rm->startTrans();

		try {

			$rm->where("userid=%d",$userid)->delete();

			foreach ($menuids as $menuid)
			{
				$data["userid"]=$userid;
				$data["menuid"]=$menuid;
				$rm->add($data);
			}

			$rm->commit();
		} catch (Exception $e) {
			$rm->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("User/changeUserPower", "更改用户导航权限");
		self::userManager();
	}

	public function getRoleMenu()
	{

		$roleid = $_GET["roleid"];
		$rm = M("Rolemenu");
		$rolemenuList = $rm->where("roleid=%d",$roleid)->select();

		$data["rolemenuList"]=$rolemenuList;
		$index = new IndexAction();
		$index->addOperLog("User/getRoleMenu", "获取角色导航权限");

		$this->ajaxReturn($data);
	}

	public function getUserMenu()
	{

		$userid = $_GET["userid"];

		$um = M("Usermenu");
		$sql = "select a.id,a.userid,a.menuid from tp_usermenu a where 1=1 and a.userid=".$userid;
		$rolemenuList = $um->query($sql);
		$data["rolemenuList"]=$rolemenuList;

		$index = new IndexAction();
		$index->addOperLog("User/getUserMenu", "获取用户导航权限");

		$this->ajaxReturn($data);
	}

	public function updatePayInfoStatus()
	{

		$id = $_GET["id"];
		$status = $_GET["status"];

		$u = M("User");
		$dtime = date('Y-m-d H:i');
		$pay = M("Payinfo");

		$pay->startTrans();

		try {
			//更新充值状态
			$data["status"]=$status;
			$pay->where("id=%d",$id)->save($data);
			//获取充值记录
			$payinfo = $pay->where("id=%d",$id)->find();
			//获取充值人
			$user = $u->where("id=%d",$payinfo["userid"])->find();
			//更新用户消费余额
			$d["xiaofei"]=doubleval($user["xiaofei"]+$payinfo["money"]);
			$u->where("id=%d",$user['id'])->save($d);
			session("user",$user);
			//更新推荐人提成
			self::calcPayMoney($payinfo["userid"], $user['pid'], 1, $payinfo["money"]);

			$pay->commit();

			$msg="成功！";
			$errorcode=-1;
		} catch (Exception $e) {

			$pay->rollback();
			$msg="失败！";
			$errorcode=1;
		}

		$index = new IndexAction();
		$index->addOperLog("User/updatePayInfoStatus", "审核用户充值");

		$da["msg"]=$msg;
		$da["errorcode"]=$errorcode;

		$this->ajaxReturn($da);

	}

	public function goAddMyUser()
	{
		$index = new IndexAction();
		$index->addOperLog("User/goAddMyUser", "增加我的下级页面");
		$da = M("Data");
		$sql = "select a.id,a.value from tp_data a left join tp_datatype b on a.typeid = b.id  where 1=1 and a.enabled =1 and b.keyword='bank' order by a.orders asc";
		$bankList = $da->query($sql);
		$this->assign("bankList",$bankList);
		$this->display("addmyuser");
	}

	public function addMyUser()
	{
		$user = $_SESSION["user"];

		$myroleid = $user["roleid"];
		$roleid = 0;
		if($myroleid==3)
		{
			//当前人是一级用户
			$roleid=4;
		}elseif ($myroleid==4)
		{
			//当前人是二级用户
			$roleid=5;
		}else {
			//当前人是二级用户
			$roleid=7;
		}

		$u = M("User");

		$dtime = date('Y-m-d H:i');
		$id = $_POST["id"];
		$loginname = $_POST["loginname"];
		$name = $_POST["name"];
		$tele = $_POST["tele"];
		$balance = $_POST["balance"];
		$email = $_POST["email"];
		$bankcard = $_POST["bankcard"];
		$receiveaddr= $_POST["receiveaddr"];
		$refuser = $_POST["refuser"];
		$cardid = $_POST["cardid"];
		$refuserid = $_POST["refuserid"];
		$sex = $_POST["sex"];
		$bankid = $_POST["bankid"];

		$data["bankid"]=$bankid;
		$data["sex"]=$sex;
		$data["benci"]=$balance;
		$data["loginname"]=$loginname;
		$data["pid"]=$refuserid;
		$data["name"]=$name;
		$data["tel"]=$tele;
		$data["email"]=$email;
		$data["xiaofei"]=doubleval($data["xiaofei"]+$balance);
		$data["bankcard"]=$bankcard;
		$data["refuser"]=$refuser;
		$data["receiveaddr"]=$receiveaddr;
		$data["cardid"]=$cardid;
		$data["roleid"]=$roleid;

		$utils = new UtilAction();
		$keys = $utils->randstr(6);
		$data["loginkey"]=$keys;
		$pass = $utils->encrypt("000000", $keys);
		$data["loginpass"] = $pass;
		$data["dtime"] = $dtime;
		$u->startTrans();

		try {

			if($id)
			{
				$u->where("id=%d",$id)->save($data);
			}else{
				$u->add($data);
			}

			$u->commit();

		} catch (Exception $e) {

			Log::record($e);
			$u->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("User/addMyUser", "增加我的下级信息");

		 $this->redirect('Index/main', null, 0, '页面跳转中...');

	}

	public function goAddUserRole()
	{

		$userid = $_POST["userid"];
		$r = M("Role");
		$rolelist =$r->select();
		$this->assign("rolelist",$rolelist);
		$this->assign("userid",$userid);

		$index = new IndexAction();
		$index->addOperLog("User/goAddUserRole", "增加用户角色页面");

		$this->display("adduserrole");
	}

	public function adduserrole()
	{
		$userid = $_POST["userid"];
		$roleid = $_POST["roleid"];

		$user = M("User");
		$user->startTrans();

		$data["roleid"]=$roleid;
		$user->where("id=%d",$userid)->save($data);

		$user->commit();

		$index = new IndexAction();
		$index->addOperLog("User/adduserrole", "增加用户角色信息");

		self::userManager();
	}


	/**
	 *
	 *查询用户的所有下级
	 *1.查询用户直接下级
	 *2.递归查询下级用户的下级
	 */

	function getMyChild($arrCat, $parent_id = 0, $level = 0)
	{

		static $arrTree =array();//使用static代替global
		if(empty($arrCat))
		{
			return null;
		}

		$level++;
		foreach($arrCat as $key => $value)
		{
			if($value['pid'] == $parent_id)
			{
				$value['level'] = $level;
				$arrTree[] = $value;
				unset($arrCat[$key]);//注销当前节点数据，减少已无用的遍历
				self::getMyChild($arrCat, $value['id'], $level);
			}
		}

		$index = new IndexAction();
		$index->addOperLog("User/getMyChild", "查询用户下级");

		return $arrTree;

	}

	/**
	 *
	 * @param unknown $userid 充值人ID
	 * @param unknown $level
	 */
	function calcPayMoney($id,$pid,$level=0,$money)
	{
		$dtime = date('Y-m-d H:i');
		if($level<=5)
		{
			$u = M("User");
			//上级
			$user = $u->where("id=%d",$pid)->find();

			if($user)
			{
				if($level==1)
				{
					$mn = ($money/160)*30;
				}elseif ($level==2)
				{
					$mn =  ($money/160)*20;
				}elseif ($level==3 || $level==4 || $level==5)
				{
					$mn = ($money/160)*10;
				}
				//更新用户提成
				$data["yeji"] =doubleval($user["yeji"]+$money);
				$data["ticheng"]=doubleval($user["ticheng"]+$mn);
				$u->where("id=%d",$pid)->save($data);
				session("user",$user);
				//存储用户提成记录
				$paylog = M("Paylog");
				$d["money"]=$money;
				$d["userid"]=$id;
				$d["tichenguserid"]=$pid;
				$d["dtime"]=$dtime;
				$d["useinfo"]="会员充值提成";
				$d["sum"]=$mn;
				$paylog->add($d);
				//继续查找可以提成用户
				$level++;

				$index = new IndexAction();
				$index->addOperLog("User/calcPayMoney", "计算推荐人提成");

				self::calcPayMoney($id,$user['pid'],$level,$money);
			}

		}

	}


	public function  getCompanyInfo()
	{

		$company = M("Company");
		$com = $company->find();
		//dump($list);
		$this->assign("company",$com);

		$index = new IndexAction();
		$index->addOperLog("User/getCompanyInfo", "获取公司信息");

		$this->display("companyinfo");

	}

	public function  getCompanyManager()
	{

		$company = M("Company");
		$com = $company->find();
		//dump($list);
		$this->assign("company",$com);

		$index = new IndexAction();
		$index->addOperLog("User/getCompanyManager", "管理公司信息");

		$this->display("companyManager");

	}

	public function deleteCompanyInfo()
	{
		$id = $_GET["id"];
		$company = M("Company");
		$company->where("id=%d",$id)->delete();

		$index = new IndexAction();
		$index->addOperLog("User/deleteCompanyInfo", "删除公司信息");

		self::getCompanyManager();
	}

	public function goAddCompanyInfo()
	{
		$id = $_GET["id"];
		$company = M("Company");
		$com = $company->where("id=%d",$id)->find();
		$this->assign("company",$com);

		$index = new IndexAction();
		$index->addOperLog("User/goAddCompanyInfo", "增加公司信息页面");

		$this->display("addcompany");
	}

	public function addCompanyInfo()
	{
		$dtime = date('Y-m-d H:i');

		$name = $_POST["name"];
		$content = $_POST["content"];
		$id = $_POST["id"];
		$company = M("Company");
		$company->startTrans();

		try {
			$data["name"]=$name;
			$data["desc"]=$content;
			$data["pid"]=0;
			$data["enabled"]=1;
			$data["dtime"]=$dtime;

			if($id)
			{
				$company->where("id=%d",$id)->save($data);
			}else{
				$company->add($data);
			}

			$company->commit();
		} catch (Exception $e) {
			$company->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("User/addCompanyInfo", "增加公司信息");

		self::getCompanyManager();

	}

	public function addFormApp()
	{

		$user = session("user");

		$app = M("Formapp");
		$u = M("User");
		$dtime = date('Y-m-d H:i');

		try {

			$data["userid"]=$user["id"];
			$data["dtime"]=$dtime;
			$data["status"]=0;
			$data["name"]=$user["name"]."申请报单中心权限";
			$app->add($data);

			$da["formapp"]=1;
			$u->where("id=%d",$user["id"])->save($da);
			$msg="提交成功";
			$errorcode =-1;
		} catch (Exception $e) {
			$msg="提交失败";
			$errorcode =1;
		}

		$index = new IndexAction();
		$index->addOperLog("User/addFormApp", "申请报单中心");

		$d["msg"]=$msg;
		$d["errorcode"]=$errorcode;

		$this->ajaxReturn($d);

	}

	public function changeMenuEnabled()
	{

		$id = $_GET["id"];
		$enabled = $_GET["enabled"];

		$menu = M("Menu");
		$data["enabled"]=$enabled;

		$menu->startTrans();
		try {

			$menu->where("id=%d",$id)->save($data);
			$menu->commit();

			$msg="提交成功";
			$errorcode =-1;

		} catch (Exception $e) {
			$menu->rollback();
			$msg="提交失败";
			$errorcode =1;
		}

		$d["msg"]=$msg;
		$d["errorcode"]=$errorcode;

		$this->ajaxReturn($d);
	}

	public function deleteMenu()
	{

		$ids =$_GET["ids"];
		$menu = M("Menu");
		$id = explode(",",$ids);

		$menu->startTrans();

		try {

			foreach ($id as $i)
			{
				$menu->where("id=%d",$i)->delete();
				$index = new IndexAction();
				$index->addOperLog("User/deleteContact", "删除导航菜单");
			}
			$menu->commit();
			$msg = "删除成功！";
			$errorcode =-1;
		} catch (Exception $e) {
			$menu->rollback();
			$msg = "删除失败！";
			$errorcode =1;
		}

		$da["msg"]= $msg;
		$da["errorcode"]=$errorcode;
		$this->ajaxReturn($da);
	}

	public function goAddMenu()
	{

		$id = $_POST["id"];

		$mu = M("Menu");
		$menu = $mu->where("id=%d",$id)->find();

		$menuList = $mu->where("pid=0")->select();

		$this->assign("menu",$menu);
		$this->assign("menuList",$menuList);
		$this->display("addmenu");
	}

	public function addMenu()
	{
		$id = $_POST["id"];
		$name = $_POST["name"];
		$pid = $_POST["pid"];
		$urls = $_POST["urls"];
		$cls = $_POST["cls"];
		$orders = $_POST["orders"];
		$enabled = $_POST["enabled"];

		$mu = M("Menu");

		$data['name']=$name;
		$data['pid']=$pid;
		$data['urls']=$urls;
		$data['cls']=$cls;
		$data['orders']=$orders;
		$data['enabled']=$enabled;

		$mu->startTrans();
		try {

			if($id)
			{
				$mu->where("id=%d",$id)->save($data);
			}else{
				$mu->add($data);
			}
			$mu->commit();
		} catch (Exception $e) {
			$mu->rollback();
		}

		self::getAllMenuList();

	}

	function checkLoginName()
	{

		$user = M("User");

		$loginname = $_GET["loginname"];
		$id = $_GET["id"];
		if($id)
		{
			$userlist = $user->where("loginname='$loginname' and id <> ".$id)->select();
		}else{
			$userlist = $user->where("loginname='$loginname'")->select();
		}


		$count = intval($userlist|count);
		if($count==0)
		{
			$msg = "";
			$errorcode =-1;
		}else{
			$msg = "登录名已存在！";
			$errorcode =1;
		}

		$da["msg"]= $msg;
		$da["errorcode"]=$errorcode;
		$this->ajaxReturn($da);
	}

	function checkName()
	{

		$user = M("User");

		$name = $_GET["name"];

		$userlist = $user->where("name='$name'")->select();

		$count = intval($userlist|count);
		if($count==0)
		{
			$msg = "";
			$errorcode =-1;
		}else{
			$msg = "用户姓名已存在！";
			$errorcode =1;
		}

		$da["msg"]= $msg;
		$da["errorcode"]=$errorcode;
		$this->ajaxReturn($da);
	}

	public function addDatatype()
	{

		$type = M("Datatype");

		$name = $_POST["name"];
		$keyword = $_POST["keyword"];
		$orders = $_POST["orders"];
		$id = $_POST["id"];

		try {

			$type->startTrans();
			$data["name"]=$name;
			$data["keyword"]=$keyword;
			if(!$orders)
			{
				$orders = $type->where("")->count()+1;
			}

			$data["orders"]=$orders;
			if($id)
			{
				$type->where("id=%d",$id)->save($data);
			}else{
				$type->add($data);
			}
			$type->commit();

		} catch (Exception $e) {
			$type->rollback();
		}

		self::dataManager();

	}

	public function addDatavalue()
	{

		$va = M("Data");

		$value = $_POST["value"];
		$orders = $_POST["orders"];
		$enabled = $_POST["enabled"];
		$typeid = $_POST["typeid"];
		$id = $_POST["id"];

		try {
			$va->startTrans();
			$data["value"]=$value;
			$data["orders"]=$orders;
			$data["enabled"]=$enabled;
			$data["typeid"]=$typeid;

			if($id)
			{
				$va->where("id=%d",$id)->save($data);
			}else{
				$va->add($data);
			}
			$va->commit();

		} catch (Exception $e) {
			$va->rollback();
		}

		self::dataManager();
	}

	public function deleteDatatype()
	{

		$id = $_POST['id'];
		$type = M("datatype");
		$da = M("Data");
		try {
			$type->startTrans();
			if($id)
			{
				$type->where("id=%d",$id)->delete();
				$da->where("typeid=%d",$id)->delete();
			}
			$type->commit();

		} catch (Exception $e) {
			$type->rollback();
			$da->rollback();
		}
		self::dataManager();
	}

	public function deletData()
	{
		$da = M("Data");
		$ids = $_GET["ids"];
		$id = explode(",",$ids);
		try {
			$da->startTrans();
			foreach ($id as $i)
			{
				$da->where("id=%d",$id)->delete();
				$index = new IndexAction();
				$index->addOperLog("User/deletData", "删除字典值");
			}

			$da->commit();
			$msg = "删除成功！";
			$errorcode =-1;
		} catch (Exception $e) {
			$da->rollback();
			$msg = "删除失败！";
			$errorcode =1;
		}

		$data["msg"]=$msg;
		$data["errorcode"]=$errorcode;
		$this->ajaxReturn($data);
	}

	public function dataManager()
	{

		$m = M("Data");
		$typeid = $_GET["typeid"];
		if($typeid)
		{
			$count = $m->where("typeid=%d",$typeid)->count();// 查询满足要求的总记录数
		}else{
			$count = $m->where("")->count();// 查询满足要求的总记录数
		}

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:9;//每页显示条数、默认为10
		$pageCount = $count % $pageSize ==0 ? ($count / $pageSize):(($count / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql = "select a.id,a.value as vals,a.typeid,a.orders,a.enabled,b.name,b.keyword  from tp_data a left join tp_datatype b on a.typeid = b.id  where 1=1   ";
		if($typeid)
		{
			$sql = $sql." and a.typeid=".$typeid;
		}
		$sql = $sql." order by b.orders asc ,a.orders asc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $m->query($sql);

		$index = new IndexAction();
		$index->addOperLog("User/getDatatypeList", "字典详细值");

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$this->display("dataManager");

	}

	public function goAddDataType()
	{

		$type = M("Datatype");
		$orders = $type->where("")->count()+1;
		$this->assign("orders",$orders);
		$this->display("addDataType");
	}

	public function goAddData()
	{

		$da = M("Data");
		$type = M("Datatype");
		$id = $_POST["id"];
		if($id)
		{
			$data = $da->where("id=%d",$id)->find();
			$orders = $data["orders"];
			$this->assign("data",$data);
		}else{
			$orders = $da->where("")->count()+1;
		}
		$typeList = $type->select();
		$this->assign("orders",$orders);
		$this->assign("typeList",$typeList);
		$this->display("addData");
	}

	public function changeData()
	{

		$id = $_GET["id"];
		$enabled = $_GET["enabled"];

		$da = M("Data");
		try {
			$da->startTrans();
			$data["enabled"]=$enabled;
			$da->where("id=%d",$id)->save($data);
			$da->commit();

			$msg = "更新成功！";
			$errorcode =-1;
		} catch (Exception $e) {
			$da->rollback();
			$msg = "更新失败！";
			$errorcode =1;
		}

		$d["msg"]=$msg;
		$d["errorcode"]=$errorcode;
		$this->ajaxReturn($d);
	}

}

?>