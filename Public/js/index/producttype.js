$(document).ready(function(){

	var page = $("#pageno").val();
	var pagecount = $("#pagecount").val();
	var itemscount = $("#itemscount").val();
	var cpath = $("#cpath").val();
	  kkpager.generPageHtml({
	       //当前页（默认为1）
	       pno : page,
	       //总页码
	       total : pagecount,
	       //总数据条数
	       totalRecords : itemscount,
	       //链接前部
	       hrefFormer : cpath+'/index.php/producttype',
	       //链接尾部
	       hrefLatter : '',
	       getLink : function(n){
	    	   return this.hrefFormer + this.hrefLatter + "?pno="+n;
	       	}
	      });
});

function addtype()
{
	var cpath = $("#cpath").val();
	art.dialog.prompt('请输入产品分类', function (val) {
		if(val !="")
		{
			window.location=cpath+"/index.php/addprotype?name="+val
		}
	}, '分类1');
}

function deleteall()
{
	var ids = "";
	$("input[name='itemid']:checked").each(function(){
		ids+=$(this).val()+",";
	});
	if(ids=="")
	{
		art.dialog.tips("请先选择相应的序号！",2);
		return ;
	}
	var cpath = $("#cpath").val();
	window.location=cpath+"/index.php/deleteprotype?ids="+ids;
}

function selectAll()
{

		$("input[name='itemid']").each(function(){
			var chk = $(this).attr("checked");
			if(chk && chk=="checked")
			{
				$(this).removeAttr("checked");
			}else{
				$(this).attr("checked","checked");
			}

		});


}

function edittype(id,val)
{
	var cpath = $("#cpath").val();

	art.dialog.prompt('请输入产品分类', function (val) {
		if(val !="")
		{
			window.location=cpath+"/index.php/addprotype?name="+val+"&id="+id
		}
	}, val);
}