<?php

class TestAction extends CommonAction{

	function __construct() {

		parent::__construct();
		ini_set('date.timezone','PRC');
		Log::$format = '[ Y-m-d H:i:s ]';
		header("Content-Type:text/html; charset=utf-8");
	}

	public function initRole()
	{

		$logintime = date('Y-m-d H:i');
		$utils = new UtilAction();
		$role = M("Role");
		$role->startTrans();

		$data["dtime"] = $logintime;
		$data["name"]="VIP5 用户";
		$data["enabled"]=1;

		$s= $role->add($data);
		if($s)
		{
			$role->commit();
			$this->show("成功");
		}else{
			$role->rollback();
			$this->show("失败");
		}

	}

	public function initUser()
	{
		$logintime = date('Y-m-d H:i');
		$utils = new UtilAction();

		$user = M("User");
		$user->startTrans();

		$data["loginname"]="sunba";
		$loginkey = $utils->randstr(6);
		$data["loginkey"]=$loginkey;
		$data["loginpass"]=$utils->encrypt("000000", $loginkey);
		$data["dtime"]=$logintime;
		$data["enabled"]=1;
		$data["name"]="孙八";
		$data["cardid"]="411123123208082012";
		$data["tele"]="12325336664";
		$data["email"]="277156235@qq.com";
		$data["pid"]=5;

		if($user->add($data))
		{
			$user->commit();
			$this->show("增加用户成功");
		}else{

			$user->rollback();
			$this->show("增加用户失败");
		}

	}

	public function  testDecode()
	{
		$utils = new UtilAction();
		$data = "lpVlZWJq";
		$key = "bunsp1";
		$decrypt = $utils->decrypt($data, $key);
		dump($decrypt);

	}
}

?>