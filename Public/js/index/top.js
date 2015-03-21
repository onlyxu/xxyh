$(document).ready(function(){


});

function gologin()
{
	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在加载",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.post(cpath+"/index.php/gologin",{},function(data){
		dialog.title("用户登录");
		dialog.content(data);
	});
}

function goregist()
{
	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在加载",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.post(cpath+"/index.php/goregist",{},function(data){
		dialog.title("用户注册");
		dialog.content(data);
	});
}

function login()
{
	var cpath = $("#cpath").val();
	var loginname = $("input[name='loginname']").val();
	var loginpass = $("input[name='loginpass']").val();
	var ccode = $("input[name='ccode']").val();

	if(loginname==null || loginname=="")
	{
		$("#msg").html("请输入登录名");
		$("input[name='loginname']").focus();
		return ;
	}

	if(loginpass==null || loginpass=="")
	{
		$("#msg").html("请输入登录密码");
		$("input[name='loginpass']").focus();
		return ;
	}

	if(ccode==null || ccode=="")
	{
		$("#msg").html("请输入验证码");
		$("input[name='ccode']").focus();
		return ;
	}
	var dialog = art.dialog({id: 'N3691',title:"正在登陆",esc:false});
	$.getJSON(cpath+"/index.php/login",{loginname:loginname,loginpass:loginpass,ccode:ccode},function(data){

		var errorcode = data.errorcode;
		art.dialog.tips(data.msg, 2);
		if(errorcode==-1)
		{
			window.location=cpath+"/index.php/index";
		}else{
			dialog.close();
		}

	});
}
