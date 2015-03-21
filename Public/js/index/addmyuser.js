function checkLoginName()
{
	var loginname = $("input[name='loginname']").val();
	var cpath = $("#cpath").val();


	$.getJSON(cpath+"/index.php/checkloginname",{loginname:loginname},function(data){

		var msg = data.msg;
		var errorcode = data.errorcode ;
		if(errorcode !=-1)
		{
			art.dialog.tips(msg,2);
			$("input[type='submit']").attr("disabled","disabled");
		}else{
			$("input[type='submit']").removeAttr("disabled");
		}

	});
}

function checkName()
{
	var name = $("input[name='name']").val();
	var cpath = $("#cpath").val();


	$.getJSON(cpath+"/index.php/checkname",{name:name},function(data){

		var msg = data.msg;
		var errorcode = data.errorcode ;
		if(errorcode !=-1)
		{
			art.dialog.tips(msg,2);
			$("input[type='submit']").attr("disabled","disabled");
		}else{
			$("input[type='submit']").removeAttr("disabled");
		}

	});
}