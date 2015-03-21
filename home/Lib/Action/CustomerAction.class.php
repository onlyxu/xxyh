<?php

class CustomerAction extends CommonAction{

	public function getPayLogList()
	{

		$pay = M("Paylog");
		$user = session("user");
		$userid = $user["id"];
		$count = $pay->where("userid=%d",$userid)->count();// 查询满足要求的总记录数
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

		$sql = "select a.id,a.dtime,a.money,a.useinfo,a.sum,c.name as sumname from tp_paylog a left join tp_user c on c.id = a.userid  where 1=1 and a.userid=".$userid;
		$sql = $sql." order by a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $pay->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Customer/getPayLogList", "获取个人充值记录");

		$this->display("customerPayLogList");

	}

	public function getAllPayLogList()
	{

		$pay = M("Paylog");
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

		$sql = "select a.id,a.dtime,a.money,a.useinfo,a.sum,c.name as sumname,d.name as tichengname from tp_paylog a left join tp_user c on c.id = a.userid left join tp_user d on d.id = a.tichenguserid where 1=1 ";
		$sql = $sql." order by a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $pay->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Customer/getAllPayLogList", "全部充值记录");

		$this->display("allPayLogList");

	}


	public function getRecordList()
	{

		$form = M("Customerform");
		$user = session("user");
		$userid = $user["id"];
		$count = $form->where("userid=%d",$userid)->count();// 查询满足要求的总记录数
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

		$sql = "select a.id,a.dtime,a.money,a.status,a.sum,c.name as sumname from tp_customerform a left join tp_user c on c.id = a.userid  where 1=1 and a.userid=".$userid;
		$sql = $sql." order by a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $form->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Customer/getRecordList", "个人报单记录");

		$this->display("customerFormList");

	}

	public function getAllRecordList()
	{

		$form = M("Customerform");
		$count = $form->where("")->count();// 查询满足要求的总记录数
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

		$sql = "select a.id,a.dtime,a.money,a.status,a.sum,c.name as sumname  from tp_customerform a left join tp_user c on c.id = a.userid where 1=1 ";
		$sql = $sql." order by a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $form->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Customer/getAllRecordList", "全部报单记录");

		$this->display("checkCustomerFormList");

	}

	public function getAllFormAPPList()
	{

		$form = M("Formapp");
		$count = $form->where("")->count();// 查询满足要求的总记录数
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

		$sql = "select a.id,a.dtime,a.status,a.name,c.name as sumname from tp_formapp a left join tp_user c on c.id = a.userid  where 1=1 ";
		$sql = $sql." order by a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $form->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Customer/getAllFormAPPList", "全部申请记录");

		$this->display("checkFormAppList");

	}

	public function changeFormAppStatus()
	{

		$app = M("Formapp");
		$u = M("User");
		$menu = M("Menu");
		$um = M("Usermenu");

		$appid = $_GET["id"];
		$status = $_GET["status"];
		$app->startTrans();
		try {

			$da["status"]=$status;
			$app->where("id=%d",$appid)->save($da);

			if($status==1)
			{
				$formapp = $app->where("id=%d",$appid)->find();
				$appuserid = $formapp["userid"];
				$appuser = $u->where("id=%d",$appuserid)->find();

				$m1 = $menu->where("name='报单中心'")->find();
				$m1id = $m1["id"];
				$m2 = $menu->where("name='报单记录'")->find();
				$m2id = $m2["id"];

				$um->where("userid=$appuserid and menuid=$m1id ")->delete();
				$data["userid"]=$appuserid;
				$data["menuid"]=$m1id;
				$um->add($data);

				$um->where("userid=$appuserid and menuid=$m2id ")->delete();
				$data2["userid"]=$appuserid;
				$data2["menuid"]=$m2id;
				$um->add($data2);

			}

			$app->commit();
			$msg="提交成功";
			$errorcode=-1;
		} catch (Exception $e) {
			$app->rollback();
			$msg="提交失败";
			$errorcode=1;
		}

		$d["msg"]=$msg;
		$d["errorcode"]=$errorcode;

		$index = new IndexAction();
		$index->addOperLog("Customer/changeFormAppStatus", "审核报单申请");

		$this->ajaxReturn($d);
	}


	public function saveCustomerForm()
	{

		$user = session("user");
		$form = M("Customerform");

		$money = $_GET["money"];
		$dtime = date('Y-m-d H:i');
		$id = $_GET["id"];
		$status = $_GET["status"];
		if(!status || $status==null)
		{
			$status = 0;
		}

		$form->startTrans();

		$data["money"]= $money;
		$c = $money / 1600;
		$data["sum"] = $c * 20;

		$data["userid"] = $user["id"];
		$data["dtime"]=$dtime;
		$data["status"]=$status;
		if($id)
		{
			$s = $form->where("id=%d",$id)->save($data);
		}else{
			$s = $form->add($data);
		}

		if($s)
		{
			$form->commit();
			$msg = "报单提交成功！";
			$errorcode =-1;
		}else{
			$form->rollback();
			$msg = "报单提交失败！";
			$errorcode =1;
		}

		$da["msg"]= $msg;
		$da["errorcode"]=$errorcode;

		$index = new IndexAction();
		$index->addOperLog("Customer/saveCustomerForm", "提交报单");

		$this->ajaxReturn($da);

	}

	public function  changeCustomerForm()
	{
		$form = M("Customerform");
		$status = $_GET["status"];
		$id = $_GET["id"];
		$user = M("User");

		$form->startTrans();
		try {

			$data["status"]=$status;
			$customerform = $form->where("id=%d",$id)->find();
			$sum = $customerform["sum"];
			$userid = $customerform["userid"];
			$u = $user->where("id=%d",$userid)->find();
			$ticheng = $u["ticheng"];

			$s = $form->where("id=%d",$id)->save($data);
			if($status==1)
			{
				//更新用户提成
				$dat["ticheng"]=$sum+$ticheng;
				$user->where("id=%d",$userid)->save($dat);
			}

			$form->commit();
			$msg = "审核成功！";
			$errorcode =-1;

		} catch (Exception $e) {

			$form->rollback();
			$msg = "审核失败！";
			$errorcode =1;
		}

		$da["msg"]= $msg;
		$da["errorcode"]=$errorcode;

		$index = new IndexAction();
		$index->addOperLog("Customer/changeCustomerForm", "审核报单");

		$this->ajaxReturn($da);

	}
}

?>