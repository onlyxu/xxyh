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
	       hrefFormer : cpath+'/index.php/productlist',
	       //链接尾部
	       hrefLatter : '',
	       getLink : function(n){
	    	   return this.hrefFormer + this.hrefLatter + "?pno="+n;
	       	}
	      });
});

function gohide(id,param)
{
	var cpath = $("#cpath").val();
	window.location=cpath+"/index.php/changeproenabled?id="+id+"&param="+param;
}

function addProduct()
{
	var cpath = $("#cpath").val();
	window.location=cpath+"/index.php/goaddpro"
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

function deleteall()
{
	var ids = "";
	$("input[name='itemid']:checked").each(function(){
		ids+=$(this).val()+",";
	});
	if(ids=="")
	{
		art.dialog.tips("请先选择相应的序号！",2);
		return;
	}

	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在提交",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.getJSON(cpath+"/index.php/deleteproduct",{ids:ids},function(data){

		var errorcode = data.errorcode;
		art.dialog.tips(data.msg, 2);
		if(errorcode==-1)
		{
			window.location=cpath+"/index.php/productlist";
		}else{
			dialog.close();
		}

	});
}

function proinfo(id)
{
	var cpath= $("#cpath").val();
	window.location=cpath+"/index.php/productinfo?id="+id;
}

function editinfo(id)
{
	var cpath = $("#cpath").val();
	window.location=cpath+"/index.php/goaddpro?id="+id
}
