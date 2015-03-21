<?php

class NewsAction extends CommonAction{

	public function getIndexNews()
	{

		$news = M("News");
		$type = M("Newstype");
		$typeid= $_GET["typeid"];
		if($typeid)
		{
			$count = $news->where("enabled =1 and typeid=$typeid ")->count();// 查询满足要求的总记录数
		}else{
			$count = $news->where("enabled =1 ")->count();// 查询满足要求的总记录数
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

		if($typeid)
		{
			$sql = "select a.id,a.title,a.dtime,a.counts,a.orders,b.name as typename,c.name as writer from tp_news a left join tp_newstype b on a.typeid = b.id left join tp_user c on a.userid = c.id where 1=1 and a.enabled=1 and a.typeid=$typeid ";
		}else{
			$sql = "select a.id,a.title,a.dtime,a.counts,a.orders,b.name as typename,c.name as writer from tp_news a left join tp_newstype b on a.typeid = b.id left join tp_user c on a.userid = c.id where 1=1 and a.enabled=1 ";
		}

		$sql = $sql." order by a.orders desc ,a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $news->query($sql);

		$typesql = "SELECT a.id as id, a.name as name ,COUNT(b.id) as count from tp_newstype a LEFT JOIN tp_news b on a.id = b.typeid GROUP BY a.id";
		$typeList = $type->query($typesql);

		$this->assign("typeid",$typeid);
		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);
		$this->assign("typeList",$typeList);

		$index = new IndexAction();
		$index->addOperLog("News/getIndexNews", "获取前台展示新闻");

		$this->display("indexNewsList");

	}

	public function getNewTypeList()
	{

		$type = M("Newstype");
		$count = $type->where("")->count();// 查询满足要求的总记录数

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

		$sql = "select a.id,a.name,a.dtime,a.orders,b.name as pname from tp_newstype a left join tp_newstype b on a.pid = b.id where 1=1  ";
		$sql = $sql." order by a.orders desc ,a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $type->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("News/getNewTypeList", "获取新闻类型");

		$this->display("newsTypeList");

	}

	public function getNewsList()
	{

		$news = M("News");
		$count = $news->where("")->count();// 查询满足要求的总记录数

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

		$sql = "select a.id,a.title,a.dtime,a.counts,a.orders,a.enabled,b.name as typename,c.name as writer from tp_news a left join tp_newstype b on a.typeid = b.id left join tp_user c on a.userid = c.id where 1=1 ";
		$sql = $sql." order by a.orders desc ,a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $news->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("News/getNewsList", "获取全部新闻");

		$this->display("newsList");

	}

	public function  deleteAllNewsType()
	{

		$ids = $_GET["ids"];
		$type = M("Newstype");

		if($ids)
		{
			$id = explode(",",$ids);
		}

		$type->startTrans();
		try {

			foreach ($id as $key => $value)
			{
				$value = intval($value);
				$type->where("id=%d",$value)->delete();
				$index = new IndexAction();
				$index->addOperLog("News/deleteAllNewsType", "删除新闻分类");
			}

			$type->commit();
			$data["msg"]="ok";
			$data["errorcode"]=-1;

		} catch (Exception $e) {
			$type->rollback();
			$data["msg"]="删除失败";
			$data["errorcode"]=1;
		}


		$this->ajaxReturn($data);
	}

	public function  deleteAllNews()
	{

		$ids = $_GET["ids"];
		$news = M("News");

		if($ids)
		{
			$id = explode(",",$ids);
		}

		$news->startTrans();
		try {

			foreach ($id as $key => $value)
			{
				$value = intval($value);
				$news->where("id=%d",$value)->delete();

				$index = new IndexAction();
				$index->addOperLog("News/deleteAllNews", "删除新闻");
			}

			$news->commit();
			$data["msg"]="ok";
			$data["errorcode"]=-1;

		} catch (Exception $e) {
			$news->rollback();
			$data["msg"]="删除失败";
			$data["errorcode"]=1;
		}

		$this->ajaxReturn($data);
	}

	public function addNewType()
	{

		$type = M("Newstype");

		$name = $_GET["name"];
		$id = $_GET["id"];

		$data["name"]=$name;
		$type->startTrans();
		try {
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

		$index = new IndexAction();
		$index->addOperLog("News/addNewType", "增加新闻分类");

		self::getNewTypeList();

	}

	public function goAddNews()
	{

		$type=M("Newstype");
		$typelist = $type->where("")->select();
		$this->assign("typelist",$typelist);

		$index = new IndexAction();
		$index->addOperLog("News/goAddNews", "获取增加新闻页面");

		$news = M("News");
		$id = $_GET["id"];
		$n= $news->where("id=%d",$id)->find();
		$this->assign("news",$n);
		$this->display("addNews");
	}

	public function addNews()
	{

		$news = M("News");
		$user = session("user");

		$dtime = date('Y-m-d H:i');
		$name = $_POST["name"];
		$typeid = $_POST["typeid"];
		$enabled = $_POST["enabled"];
		if(!$enabled)
		{
			$enabled=0;
		}
		$content = $_POST["content"];
		$id = $_POST["id"];

		$data["title"]=$name;
		$data["typeid"]=$typeid;
		$data["enabled"]=$enabled;
		$data["info"]=$content;
		$data["dtime"]=$dtime;
		$data["userid"]=$user[id];

		$news->startTrans();

		try {

			if($id)
			{
				$news->where("id=%d",$id)->save($data);
			}else{
				$news->add($data);
			}

			$news->commit();

		} catch (Exception $e) {
			$news->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("News/addNews", "增加新闻");
		self::getNewsList();
	}

	public function changeNewsEnabled()
	{

		$enabled = $_GET["enabled"];
		$id = $_GET["id"];

		$news = M("News");
		$news->startTrans();

		$data["enabled"]=$enabled;
		try {

			$news->where("id=%d",$id)->save($data);

			$news->commit();
			$msg = "审核成功！";
			$errorcode =-1;

		} catch (Exception $e) {

			$news->rollback();
			$msg = "审核失败！";
			$errorcode =1;
		}

		$index = new IndexAction();
		$index->addOperLog("News/changeNewsEnabled", "改变新闻展示状态");

		$da["msg"]= $msg;
		$da["errorcode"]=$errorcode;
		$this->ajaxReturn($da);

	}

	public function  getNewsInfo()
	{
		$id = $_GET["id"];
		$n = M("News");

		$news = $n->where("id=%d",$id)->find();
		$this->assign("news",$news);

		$index = new IndexAction();
		$index->addOperLog("News/getNewsInfo", "获取新闻详情信息");

		$this->display("newsInfo");

	}
}

?>