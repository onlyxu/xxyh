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
	       hrefFormer : cpath+'/index.php/menumanager',
	       //链接尾部
	       hrefLatter : '',
	       getLink : function(n){
	    	   return this.hrefFormer + this.hrefLatter + "?pno="+n;
	       	}
	      });
});

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
	$.getJSON(cpath+"/index.php/deletemenus",{ids:ids},function(data){

		var errorcode = data.errorcode;
		art.dialog.tips(data.msg, 2);
		if(errorcode==-1)
		{
			window.location=cpath+"/index.php/usermanager";
		}else{
			dialog.close();
		}

	});
}

function addMenu(){


	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在加载",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.post(cpath+"/index.php/goaddmenu",{},function(data){
		dialog.title("添加菜单");
		dialog.content(data);
	});
}

function editMenu(id){


	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在加载",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.post(cpath+"/index.php/goaddmenu",{id:id},function(data){
		dialog.title("添加菜单");
		dialog.content(data);
	});
}


function changemenustate(id,enabled)
{
	var cpath = $("#cpath").val();

	var dialog = art.dialog({id: 'N3690',title:"正在提交",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.getJSON(cpath+"/index.php/changemenu",{enabled:enabled,id:id},function(data){

		var errorcode = data.errorcode;
		art.dialog.tips(data.msg, 2);
		if(errorcode==-1)
		{
			window.location=cpath+"/index.php/menumanager";
		}else{
			dialog.close();
		}

	});
}
