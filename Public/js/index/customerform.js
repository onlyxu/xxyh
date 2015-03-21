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
	       hrefFormer : cpath+'/index.php/customerform',
	       //链接尾部
	       hrefLatter : '',
	       getLink : function(n){
	    	   return this.hrefFormer + this.hrefLatter + "?pno="+n;
	       	}
	      });
});

function addFormMoney()
{
	var cpath = $("#cpath").val();
	art.dialog.prompt('请输入报账金额', function (val) {
	   // art.dialog.tips(val);
		if(!isNaN(val))
		{
			if(val % 1600 ==0)
			{

				var dialog = art.dialog({id: 'N3690',title: "正在提交"});
				$.getJSON(cpath+"/index.php/addcustomerform?ttid="+Math.random,{money:val},function(data){

					var msg = data.msg;
					var errorcode = data.errorcode;
					 dialog.content(msg);
					if(errorcode==-1)
					{
						window.location.reload();
					}
				});

			}else{
				art.dialog.tips("报账金额不是1600的倍数！");
			}

		}else{
			 art.dialog.tips("报账金额必须为数字！");
		}
	}, '报账金额为1600的倍数');
}