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
	       hrefFormer : cpath+'/index.php/tixian',
	       //链接尾部
	       hrefLatter : '',
	       getLink : function(n){
	    	   return this.hrefFormer + this.hrefLatter + "?pno="+n;
	       	}
	      });
});

function acceptStatus(id,status)
{
	var cpath = $("#cpath").val();
	var dialog = art.dialog({id: 'N3690',title:"提现审核",esc:true,lock:true,drag:false,resize:false,fixed:true});
	$.getJSON(cpath+"/index.php/updatetixian",{id:id,status:status},function(data){
		art.dialog.tips(data.msg,2);
		if(data.errorcode==-1)
			{
				window.location=cpath+"/index.php/alltixian";
			}
	});
}