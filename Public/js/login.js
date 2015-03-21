function fleshVerify(){
    //重载验证码
    var time = new Date().getTime();
    var cpath = $("#cpath").val();
    $("#verifyImg").attr("src",cpath+"/index.php/code/"+time);
 }

function formlogin()
{
	var cpath = $("#cpath").val();
	var loginname = $("input[name='loginname']").val();
	var loginpass = $("input[name='loginpass']").val();
	var ccode = $("input[name='ccode']").val();

	if(loginname==null || loginname=="")
	{
		art.dialog.tips("请输入登录名",2);
		$("input[name='loginname']").focus();
		return ;
	}

	if(loginpass==null || loginpass=="")
	{
		art.dialog.tips("请输入登录密码",2);
		$("input[name='loginpass']").focus();
		return ;
	}

//	if(ccode==null || ccode=="")
//	{
//		art.dialog.tips("请输入验证码",2);
//		$("input[name='ccode']").focus();
//		return ;
//	}
	var dialog = art.dialog({id: 'N3690',title:"用户登录",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.ajax({
		type:"POST",
		url:cpath+"/index.php/login",
		dataType:"JSON",
		data:$("#loginform").serialize(),
		success:function(da)
		{
			art.dialog.tips(da.msg,2);
			dialog.close();
			if(da.errorcode==-1)
			{
				window.location=cpath+"/index.php/index";
			}
		}

	});
}

function formreset()
{
	$("#loginform").reset();
}