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
	       hrefFormer : cpath+'/index.php/rolemanager',
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
	$.getJSON(cpath+"/index.php/deleteuser",{ids:ids},function(data){

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

function addUser(){

	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在加载",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.post(cpath+"/index.php/goadduser",{},function(data){
		dialog.title("添加用户");
		dialog.content(data);
	});
}

function checkAccept(id,enabled)
{
	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在提交",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.getJSON(cpath+"/index.php/changeuser",{enabled:enabled,id:id},function(data){

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


function checkpower(roleid)
{
	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在提交",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.post(cpath+"/index.php/menutree",{roleid:roleid},function(data){
		dialog.title("用户权限");
		dialog.content(data);
		initPower(roleid)
		//$('#htmltree').jstree();
		//$("#browser").treeview({});
	});

}

function initPower(roleid)
{
	var cpath = $("#cpath").val();
	$.getJSON(cpath+"/index.php/rolemenu",{roleid:roleid},function(data){

		var items = data.rolemenuList;
		$.each(items,function(index,item){
				var menuid = item.menuid;
				$("input[name='menuid[]']").each(function(){
						if($(this).val()==menuid)
							{
								$(this).attr("checked","checked");
							}
				});
		});
	});
}

function selectAllMenu()
{
	$("input[name='menuid[]']").each(function(){
		var chk = $(this).attr("checked");
		if(chk && chk=="checked")
		{
			$(this).removeAttr("checked");
		}else{
			$(this).attr("checked","checked");
		}

	});
}


