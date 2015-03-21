$(document).ready(function(){

	var page = $("#pageno").val();
	var pagecount = $("#pagecount").val();
	var itemscount = $("#itemscount").val();
	  kkpager.generPageHtml({
	       //当前页（默认为1）
	       pno : page,
	       //总页码
	       total : pagecount,
	       //总数据条数
	       totalRecords : itemscount,
	       //链接前部
	       hrefFormer : cpath+'/index.php/indexproduct',
	       //链接尾部
	       hrefLatter : '',
	       getLink : function(n){
	    	   return this.hrefFormer + this.hrefLatter + "?pno="+n;
	       	}
	      });
});

$(function(){ //  等待DOM加载完毕.

	var typeid = $("#typeid").val();
	if(typeid)
	{
		$('ul li[id="'+typeid+'"]').addClass("promoted");// 高亮样式
	}else{
		$('ul li[id="0"]').addClass("promoted");// 高亮样式
	}
	var len = $(".SubCategoryBox ul  li").length;
	if(len<=5)
	{
		$('div.showmore').hide();
	}else{
		$('div.showmore').show();
	}
	var $category = $('.SubCategoryBox ul li:gt(5):not(:last)'); //  获得索引值大于5的品牌集合对象(除最后一条)
	$category.hide();//  隐藏上面获取到的jQuery对象。
	var $toggleBtn = $('div.showmore > a'); //  获取“显示全部品牌”按钮
	$toggleBtn.click(function(){
		  if($category.is(":visible")){
				$category.hide();//  隐藏$category
				$(this).find('span').text("更多分类");//改变背景图片和文本
				$('ul li').removeClass("promoted");// 去掉高亮样式
		  }else{
				$category.show(); //  显示$category
				$(this).find('span').text("隐藏更多");//改变背景图片和文本
		  }
		return false;//超链接不跳转
	});
});