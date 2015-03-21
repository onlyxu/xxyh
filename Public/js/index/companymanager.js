
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

function goaddCompany(){

	var cpath = $("#cpath").val();
	window.location=cpath+"/index.php/goaddcompany";
}

function goeditcompany(id){

	var cpath = $("#cpath").val();
	window.location=cpath+"/index.php/goaddcompany?id="+id;
}

function deleteall(id)
{
	var cpath = $("#cpath").val();
	window.location=cpath+"/index.php/deletecompany?id="+id;
}


