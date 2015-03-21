$(document).ready(function(){

});

function getFormApp()
{
	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在加载",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.getJSON(cpath+"/index.php/addformapp",{},function(data){
		var errorcode = data.errorcode;
		art.dialog.tips(data.msg, 3);
		dialog.close();
		window.location.reload();
	});
}

function editInfo()
{
	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"正在加载",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.post(cpath+"/index.php/userinfoedit",{},function(data){
		dialog.title("修改个人信息");
		dialog.content(data);
	});
}

function getMoney()
{
	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3691',title:"正在验证提现权限",esc:false});
	$.getJSON(cpath+"/index.php/getmoney",{},function(data){

		var errorcode = data.errorcode;
		if(errorcode ==-1)
		{
			getBalanceMoney();
		}else{
			art.dialog.tips(data.msg, 2);
		}

		//dialog.close();

	});

}

function getBalanceMoney()
{
	var cpath = $("#cpath").val();
	var ticheng = $("#ticheng").val();

	var dialog = art.dialog({id: 'N3691',title:"正在提现",esc:false});
	art.dialog.prompt('请输入提成的金额(100的倍数)', function (val) {
		if(val !=null && val !="")
		{
			if(!isNaN(val))
			{
				if(val % 100 ==0)
				{
					if(eval(val) <= eval(ticheng))
					{

						sendMoney(val);
					}else{
						art.dialog.tips("提成金额不能大于可用金额！",2);
					}

				}else{
					art.dialog.tips("提成金额必须是100倍数！",2);
					return ;
				}
			}else{
				art.dialog.tips("提成金额必须为数字！",2);
				return ;
			}
		}else{
			art.dialog.tips("提成金额不能为空！",2);
			return ;
		}

	}, '100');

	dialog.close();
}

function sendMoney(money)
{

	var cpath = $("#cpath").val();
	$.getJSON(cpath+"/index.php/getbalancemoney",{money:money},function(data){


		var errorcode = data.errorcode ;
		var msg = data.msg;
		art.dialog.tips(msg,3);
		if(errorcode ==-1)
		{
			window.location=cpath+"/index.php/userinfo";
		}

	});
}
function addpay()
{

	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3691',title:"准备充值",esc:false});
	$.post(cpath+"/index.php/goaddpayinfo",{},function(data){
		dialog.content(data);
	});
}

function checkLoginName()
{
	var loginname = $("input[name='loginname']").val();
	var cpath = $("#cpath").val();
	var id = $("input[name='id']").val();

	$.getJSON(cpath+"/index.php/checkloginname",{loginname:loginname,id:id},function(data){

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