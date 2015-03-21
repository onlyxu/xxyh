<?php


class ProductAction extends CommonAction{

	public function productTypeList()
	{

		$type = M("Producttype");
		$itemscount =$type->where("")->count();//全部记录数

		$nowPage = isset($_GET['page'])?$_GET['page']:1;//页码、默认为1
		$pageSize = isset($_GET['pagenum'])?$_GET['pagenum']:10;//每页显示条数、默认为10
		$pageCount = $itemscount % $pageSize ==0 ? ($itemscount / $pageSize):(($itemscount / $pageSize)+1);//总页数
		$pageCount = intval($pageCount);

		if($nowPage<=1)
		{
			$nowPage=1 ;
		}
		if($nowPage>=$pageCount)
		{
			$nowPage= $pageCount ;
		}

		$sql = "select a.id,a.name,a.dtime,a.enabled,a.orders from tp_producttype a where 1=1 ";
		$sql = $sql." order by a.orders desc,a.dtime desc";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";
		//$list = $type->order('orders desc,dtime desc')->page($nowPage,$pageSize)->select();
		$list = $type->query($sql);

		$this->assign("items",$list);
		$this->assign("itemscount",$itemscount);
		$this->assign("pagecount",$pageCount);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Product/productTypeList", "获取产品分类");

		$this->display("producttypeList");
	}

	public function addProductType()
	{

		$type = M("Producttype");
		$name = $_GET["name"];
		$dtime = $_GET["dtime"];
		$enabled = $_GET["enabled"];
		$orders = $_GET["orders"];
		$pid = $_GET["pid"];
		$id = $_GET["id"];

		if(!$enabled)
		{
			$enabled=0;
		}

		if(!$orders)
		{
			$orders=0;
		}

		if(!$pid)
		{
			$pid=0;
		}

		if(!$dtime)
		{
			$dtime = date('Y-m-d H:i');
		}

		$data["name"]=$name;
		$data["dtime"]=$dtime;
		$data["enabled"]=$enabled;
		$data["orders"]=$orders;
		$data["pid"]=$pid;

		$type->startTrans();

		if($id)
		{
			$data["id"]=$id;
			$s = $type->save($data);

		}else{
			$s = $type->add($data);
		}

		if(s)
		{
			$type->commit();
			$data["msg"]="ok";
			$data["errorcode"]=-1;
		}else{
			$type->rollback();
			$data["msg"]="增加失败";
			$data["errorcode"]=1;
		}

		$index = new IndexAction();
		$index->addOperLog("Product/addProductType", "增加产品分类");

		$this->productTypeList();
	}

	public function  deleteProductType()
	{

		$type = M("Producttype");
		$ids = $_GET["ids"];

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
				$index->addOperLog("Product/deleteProductType", "删除产品分类");
			}

			$type->commit();
			$data["msg"]="ok";
			$data["errorcode"]=-1;

		} catch (Exception $e) {
			$type->rollback();
			$data["msg"]="删除失败";
			$data["errorcode"]=1;
		}

		$this->productTypeList();

	}

	/**
	 * enabled=1前台展示、2不展示、3VIP展示
	 *
	 */
	public function getIndexProduct()
	{

		$product = M("Product");
		$type = M("Producttype");

		$typeid = $_GET["typeid"];
		if($typeid)
		{
			$count = $product->where("enabled=1 and typeid=$typeid")->count();// 查询满足要求的总记录数
		}else{
			$count = $product->where("enabled=1")->count();// 查询满足要求的总记录数
		}

		$nowPage = isset($_GET['pno'])?$_GET['pno']:1;//页码、默认为1
		$pageSize = isset($_GET['ps'])?$_GET['ps']:12;//每页显示条数、默认为10
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
			$sql = "select a.id,a.name as pname,a.dtime,a.imgpath,a.prono,a.counts,a.price,a.price_vip,a.price_pifa,b.name as typename from tp_product a left join tp_producttype b on a.typeid = b.id where 1=1 and a.enabled=1 and a.typeid=$typeid ";
		}else{
			$sql = "select a.id,a.name as pname,a.dtime,a.imgpath,a.prono,a.counts,a.price,a.price_vip,a.price_pifa,b.name as typename from tp_product a left join tp_producttype b on a.typeid = b.id where 1=1 and a.enabled=1 ";
		}

		$sql = $sql." order by a.orders desc ,a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $product->query($sql);

		$typesql = "SELECT a.id as id, a.name as name ,COUNT(b.id) as count from tp_producttype a LEFT JOIN tp_product b on a.id = b.typeid GROUP BY a.id";
		$typeList = $type->query($typesql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);
		$this->assign("typeList",$typeList);
		if($typeid)
		{
			$this->assign("typeid",$typeid);
		}
		$index = new IndexAction();
		$index->addOperLog("Product/getIndexProduct", "获取首页展示产品");

		$this->display("indexProductList");

	}

	public function getProductList()
	{
		$product = M("Product");
		$count = $product->where("")->count();// 查询满足要求的总记录数

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

		$sql = "select a.id,a.name as pname,a.dtime,a.prono,a.imgpath,a.counts,a.price,a.price_vip,a.price_pifa,b.name as typename,a.enabled from tp_product a left join tp_producttype b on a.typeid = b.id where 1=1 ";
		$sql = $sql." order by a.orders desc ,a.dtime desc ";
		$sql= $sql." limit ".($nowPage-1)*$pageSize.",".$pageSize."";

		$list = $product->query($sql);

		$this->assign("items",$list);
		$this->assign("pagecount",$pageCount);
		$this->assign("itemscount",$count);
		$this->assign("pageno",$nowPage);

		$index = new IndexAction();
		$index->addOperLog("Product/getProductList", "获取全部产品");

		$this->display("productList");

	}

	public function  changeProductEnabled()
	{

		$enabled = $_GET["param"];
		$id = $_GET["id"];

		$product = M("Product");
		$product->startTrans();

		try {
			$data["enabled"]=$enabled;
			$product->where("id=%d",$id)->save($data);
			$product->commit();
		} catch (Exception $e) {
			$product->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("Product/changeProductEnabled", "改变产品展示状态");

		self::getProductList();

	}

	public function goAddProduct()
	{

		$type = M("Producttype");
		$list = $type->where("")->select();
		$this->assign("typelist",$list);

		$index = new IndexAction();
		$index->addOperLog("Product/goAddProduct", "增加产品页面");

		$id = $_GET["id"];

		$pro = M("Product");
		$product = $pro->where("id=%d",$id)->find();
		$this->assign("product",$product);
		$this->display("addProduct");
	}

	public function addNewProduct()
	{

		$pro = M("Product");
		$dtime = date('Y-m-d H:i');
		$name = $_POST["name"];
		$typeid = $_POST["typeid"];
		$price = $_POST["price"];//市场价
		$price_vip = $_POST["price_vip"];//会员价
		$price_pifa = $_POST["price_pifa"];//批发价
		$prono = $_POST["prono"];
		$enabled = $_POST["enabled"];
		$uploads = $_POST["uploads"];
		$content = $_POST["content"];
		$counts = $_POST["counts"];
		$id = $_POST["id"];

		if($content)
		{
			$content= str_replace("\\", "", $content);
		}

		//$util = new UtilAction();
		//$prono = $util->uuid();

		$data["name"]=$name;
		$data["typeid"]=$typeid;
		$data["price"]=$price;
		$data["price_vip"]=$price_vip;
		$data["price_pifa"]=$price_pifa;
		$data["enabled"]=$enabled;
		$data["imgpath"]=$uploads;
		$data["info"]=$content;
		$data["dtime"]=$dtime;
		$data["prono"]=$prono;
		if($counts)
		{
			$data["counts"]=$counts;
		}
		//$data["prono"]=str_replace("-", "",substr($prono, 0,10));
		$pro->startTrans();
		try {

			if($id)
			{
				$pro->where("id=%d",$id)->save($data);
			}else{

				$pro->add($data);
			}

			$pro->commit();

		} catch (Exception $e) {
			$pro->rollback();
		}

		$index = new IndexAction();
		$index->addOperLog("Product/addNewProduct", "增加产品信息");

		self::getProductList();
	}

	public function  deleteAllProduct()
	{

		$ids = $_GET["ids"];
		$pro = M("Product");

		if($ids)
		{
			$id = explode(",",$ids);
		}

		$pro->startTrans();
		try {

			foreach ($id as $key => $value)
			{
				$value = intval($value);
				$pro->where("id=%d",$value)->delete();

				$index = new IndexAction();
				$index->addOperLog("Product/deleteAllProduct", "删除产品信息");
			}

			$pro->commit();
			$data["msg"]="ok";
			$data["errorcode"]=-1;

		} catch (Exception $e) {
			$pro->rollback();
			$data["msg"]="删除失败";
			$data["errorcode"]=1;
		}

		$this->ajaxReturn($data);

	}

	public function getProductInfo()
	{
		$id = $_GET["id"];
		$pro = M("Product");

		$product = $pro->where("id=%d",$id)->find();
		$cou = $product["counts"];
		$data["counts"] =$cou+1;
		$pro->where("id=%d",$id)->save($data);
		$product = $pro->where("id=%d",$id)->find();

		$this->assign("product",$product);

		$index = new IndexAction();
		$index->addOperLog("Product/getProductInfo", "产品详细信息");

		$this->display("productInfo");
	}

}


?>