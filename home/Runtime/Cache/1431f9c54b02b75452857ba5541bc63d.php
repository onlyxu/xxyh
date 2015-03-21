<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/kkpager.css" />
<style type="text/css">
a { color:#04D; text-decoration:none;}
a:hover { color:#F50; text-decoration:underline;}
.SubCategoryBox {width:700px; margin:0 auto; text-align:center;margin-top:10px;}
.SubCategoryBox ul { list-style:none;}
.SubCategoryBox ul li { display:block;  width:150px; line-height:20px;float: left;}
.showmore { clear:both; text-align:center;padding-top:10px;}
.showmore a { display:block; width:33%;  line-height:24px; }
.showmore a span { padding-left:15px; background:url(__PUBLIC__/images/down.gif) no-repeat 0 0;}
.promoted a { color:#F50;}
</style>
</head>
<body>

	<div class="rightinfo">
	  <div class="nowpro">
					<h4>新闻分类：</h4>
					<div class="SubCategoryBox">
						<ul>
							<li id="0"><a href="__ROOT__/index.php/indexnews">全部</a><i></i></li>
							<?php if(is_array($typeList)): $i = 0; $__LIST__ = $typeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><li  id="<?php echo ($type["id"]); ?>"><a href="__ROOT__/index.php/indexnews?typeid=<?php echo ($type["id"]); ?>"><?php echo ($type["name"]); ?></a><i>(<?php echo ($type["count"]); ?>) </i></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<div class="showmore" style="display: none">
							<a href="#"><span>更多分类</span></a>
						</div>
					</div>
			</div>
			<div style="float: none;"></div>
		<!-- 主要内容start -->
		<table class="tablelist" border="1">
			<thead>
				<tr>
					<th>标题</th>
					<th width="100">新闻分类</th>
					<th width="120">发布人</th>
					<th width="150">发布时间</th>
					<th width="80">浏览次数</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($items)): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><a href="__ROOT__/index.php/newsinfo?id=<?php echo ($vo["id"]); ?>"><?php echo (truncate_cn($vo["title"],50,'',0)); ?></a></td>
					<td><?php echo ($vo["typename"]); ?></td>
					<td><?php echo ($vo["writer"]); ?></td>
					<td><?php echo ($vo["dtime"]); ?></td>
					<td><?php echo ($vo["counts"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<div class="pagin" id="kkpager"></div>
		<!-- 内容end -->
	</div>

	<!-- 内容end -->
	<input type="hidden" id="pagecount" value="<?php echo ($pagecount); ?>" />
	<input type="hidden" id="itemscount" value="<?php echo ($itemscount); ?>" />
	<input type="hidden" id="pageno" value="<?php echo ($pageno); ?>" />
	<input type="hidden" id="size" value="12" />
	<input type="hidden" id="typeid" value="<?php echo ($typeid); ?>" />
	<!-- 底部start -->
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.js"></script>
<script type="text/javascript"
	src="__PUBLIC__/artDialog/artDialog.js?skin=twitter">

</script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<input type="hidden" id="cpath" value="__ROOT__" />
<script type="text/javascript">
	function changemenu(obj) {
		$(".titleBg").parent().find(".functionList").hide();
		$(obj).parent().find(".functionList").show();
	}

	function setthismenu(obj) {
		$(obj).css("color", "#5cb85c");
	}
	$(document).ready(function() {
		$(".titleBg").parent().find(".functionList").hide();
	});

	function setIframeHeight() {
		var iframe = document.getElementById('mainframe')
		if (iframe) {
			var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
			if (iframeWin.document.body) {
				iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
			}
		}
	};
</script>
	<script type="text/javascript" src="__PUBLIC__/js/kkpager.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/index/indexnews.js"></script>
	<!-- 底部end -->
</body>
</html>