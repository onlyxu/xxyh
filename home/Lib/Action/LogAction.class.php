<?php
class LogAction extends CommonAction {

	public function getLoginLog()
	{
		$log  = M("Loginlog");
		$user = session("user");
		$userid = $user["id"];
		$roleid=$user["roleid"];
		if($roleid==1)
		{
			//管理员查询全部登录日志
			$count = $log->where("")->count();// 查询满足要求的总记录数
		}else{
			$count = $log->where("userid=%d",$userid)->count();// 查询满足要求的总记录数
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

		if($roleid==1)
		{
			$sql = "select a.id,a.logintime,a.loginip,a.loginerrar,a.userid,c.name as loginname from tp_loginlog a left join tp_user c on c.id = a.userid  where 1=1 ";
		}else{
			$sql = "select a.id,a.logintime,a.loginip,a.loginerrar,a.userid,c.name as loginname from tp_loginlog a left join tp_user c on c.id = a.userid  where 1=1 and a.userid=".$userid;
		}

		$sql = $sql." order by a.logintime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $log->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Log/getLoginLog", "获取登录日志");

		$this->display("loginLogList");

	}

	public function getOperLog()
	{
		$log  = M("Operlog");
		$user = session("user");
		$userid = $user["id"];
		$roleid=$user["roleid"];
		if($roleid==1)
		{
			//管理员查询全部登录日志
			$count = $log->where("")->count();// 查询满足要求的总记录数
		}else{
			$count = $log->where("userid=%d",$userid)->count();// 查询满足要求的总记录数
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

		if($roleid==1)
		{
			$sql = "select a.id,a.dtime,a.operip,a.opermethod,a.operarea,a.opernote,a.userid,c.name as loginname from tp_operlog a left join tp_user c on c.id = a.userid  where 1=1 ";
		}else{
			$sql = "select a.id,a.dtime,a.operip,a.opermethod,a.operarea,a.opernote,a.userid,c.name as loginname from tp_operlog a left join tp_user c on c.id = a.userid  where 1=1 and a.userid=".$userid;
		}

		$sql = $sql." order by a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $log->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Log/getOperLog", "获取操作日志");

		$this->display("operLogList");

	}

}

?>