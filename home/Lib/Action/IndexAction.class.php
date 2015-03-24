<?php

class IndexAction extends CommonAction {

	public function test()
	{
		$this->display("test");
	}

    public function index(){
    	$user = session("user");
    	if($user)
    	{
    		self::addOperLog("Index/index", "访问首页");
    		$this->display("index");
    	}else{
    		self::addOperLog("Index/index", "访问首页/登录");
    		$this->display("login");
    	}

    }

    public function main(){

    	$user = session("user");
    	$ip = get_client_ip();
    	$utils = new UtilAction();
    	$loca=$utils->GetIpLookup($ip);
    	if(!$loca['province'])
    	{
    		$loca['province'] = "本地";
    	}

    	$this->assign("ip",$ip);
    	$this->assign("country",$loca['country']);
    	$this->assign("province",$loca['province']);
    	$this->assign("city",$loca['city']);
    	log("登录用户");
    	self::addOperLog("Index/main", "访问主页");
    	$this->display("main");

    }

	public function goRegist()
	{

		self::addOperLog("Index/goRegist", "访问注册页面");
		$this->display("regist");

	}

	public function goLogin()
	{

		self::addOperLog("Index/goLogin", "访问登录页面");
		$this->display("login");

	}

	public function  login()
	{

		$logintime = date('Y-m-d H:i');
		$utils = new UtilAction();

		$loginname = $_POST["loginname"];
		$loginpass = $_POST["loginpass"];
		$ccode = $_POST["ccode"];
		$scode = session("scode");
		//dump("ccode：".md5($ccode));
		//dump("scode:".$scode);
		$user = M("User");

		if($scode==$scode)
		//if(md5($ccode) == $scode)
		{

			$res = $user->where("loginname ='%s'",$loginname)->find();
			if($res)
			{

				$loginkey = $res['loginkey'];
				$pass = $utils->decrypt($res['loginpass'], $loginkey);
				if($pass == $loginpass)
				{

					if($res['enabled']==1)
					{
						if($res['roleid'])
						{
							$data["msg"]="验证通过！";
							$data["errorcode"]=-1;

							session("user",$res);
						}else{
							$data["msg"]="暂无权限登录！";
							$data["errorcode"]=4;
						}

					}else{
						$data["msg"]="该用户已被禁用！";
						$data["errorcode"]=4;
					}

				}else{
					$data["msg"]="登录密码错误！";
					$data["errorcode"]=3;
				}

			}else{
				$data["msg"]="该用户不存在！";
				$data["errorcode"]=2;
			}
		}else{
			$data["msg"]="验证码错误！";
			$data["errorcode"]=1;
		}

		self::addLoginLog();
		self::addOperLog("Index/login", "用户登录");
		$this->ajaxReturn($data,'JSON');

	}

	public function  goexit()
	{
		session_destroy();
		self::goLogin();
		self::addOperLog("Index/goexit", "退出登录");
	}

	public function getCode() {

		import('ORG.Util.Image');
		Image::buildImageVerify(4,1,'png',42,28,'scode');
		self::addOperLog("Index/getCode", "产生验证码");
	}

//登录日志
	function addLoginLog()
	{
		$dtime = date('Y-m-d H:i');
		$ip = get_client_ip();
		$utils = new UtilAction();
		$loca=$utils->GetIpLookup($ip);
		if(!$loca['province'])
		{
			$loca['province'] = "本地访问";
		}

		$log = M("Loginlog");

		$log->startTrans();
		try {

			$data["logintime"]=$dtime;
			$data["loginip"]=$ip;
			$data["loginerrar"]=$loca['country']."-".$loca['province']."-".$loca['city'];
			if(!empty($_SESSION['user']))
			{
				$user = session("user");
				$data["userid"]=$user["id"];
			}else{
				$data["userid"]=0;
			}

			$log->add($data);
			$log->commit();
		} catch (Exception $e) {
			$log->rollback();
		}
	}
//操作日志
	function addOperLog($method,$note)
	{
		$dtime = date('Y-m-d H:i');
		$ip = get_client_ip();
		$utils = new UtilAction();
		$loca=$utils->GetIpLookup($ip);
		if(!$loca['province'])
		{
			$loca['province'] = "本地";
		}

		$log = M("Operlog");
		$log->startTrans();

		try {

			$data["dtime"]=$dtime;
			$data["operip"]=$ip;
			$data["operarea"]=$loca['country']."-".$loca['province']."-".$loca['city'];
			$data["opermethod"]=$method;
			$data["opernote"]=$note;
			if(!empty($_SESSION['user']))
			{
				$user = session("user");
				$data["userid"]=$user["id"];
			}else{
				$data["userid"]=0;
			}

			$log->add($data);
			$log->commit();
		} catch (Exception $e) {
			$log->rollback();
		}


	}

}