<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/kkpager.css" />
</head>
<body>

	<div class="rightinfo">
		<button class="btn btn-success" onclick="addMenu()"
			style="width: 80px; height: 30px; margin-bottom: 10px;">新增</button>
		<button class="btn btn-info" onclick="deleteall()"
			style="width: 80px; height: 30px; margin-bottom: 10px;">删除</button>
		<!-- 主要内容start -->
		<table class="tablelist" border="1">
			<thead>
				<tr>
					<th width="50">序号</th>
					<th width="120">导航名称</th>
					<th width="150">导航路径</th>
					<th width="50">导航排序</th>
					<th width="140">发布时间</th>
					<th width="80">启用状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($items)): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($i); ?></td>
					<td><a href="javascript:editMenu(<?php echo ($vo["id"]); ?>)"><?php echo ($vo["name"]); ?></a></td>
					<td><?php echo ($vo["urls"]); ?></td>
					<td><?php echo ($vo["orders"]); ?></td>
					<td><?php echo ($vo["dtime"]); ?></td>
					<?php if($vo["enabled"] == 1): ?><td>已启用</td>
						<td><button class="btn btn-info" onclick="changemenustate(<?php echo ($vo["id"]); ?>,2)"
			style="width: 80px; height: 30px; margin-bottom: 10px;">禁用</button></td>
						<?php else: ?>
						<td>已禁用</td>
						<td><button class="btn btn-success" onclick="changemenustate(<?php echo ($vo["id"]); ?>,1)"
			style="width: 80px; height: 30px; margin-bottom: 10px;">启用</button></td><?php endif; ?>
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
	<script type="text/javascript" src="__PUBLIC__/js/index/menumanager.js"></script>
	<!-- 底部end -->
</body>
</html>