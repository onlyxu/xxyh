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
		<button class="btn btn-success" onclick="addUser()"
			style="width: 80px; height: 30px; margin-bottom: 10px;">新增</button>
		<button class="btn btn-info" onclick="deleteall()"
			style="width: 80px; height: 30px; margin-bottom: 10px;">删除</button>
		<!-- 主要内容start -->
		<table class="tablelist" border="1">
			<thead>
				<tr>
					<th width="80"><input type="checkbox" onclick="selectAll()" />序号</th>
					<th width="150">姓名</th>
					<th width="150">登录名</th>
					<th width="150">注册时间</th>
					<th width="100">用户消费</th>
					<th width="100">用户状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($items)): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="checkbox" name="itemid" value="<?php echo ($vo["id"]); ?>" /><?php echo ($i); ?></td>
					<td><a href="javascript:editinfo(<?php echo ($vo["id"]); ?>)"><?php echo ($vo["name"]); ?></a></td>
					<td><?php echo ($vo["loginname"]); ?></td>
					<td><?php echo ($vo["dtime"]); ?></td>
					<td><?php echo ($vo["xiaofei"]); ?></td>

					<?php if($vo["enabled"] == 0): ?><td>未审核</td>
					<td><input type="button" onclick="checkAccept(<?php echo ($vo["id"]); ?>,1)"
						class="btn btn-primary" style="width: 50px; height: 30px;"
						value="通过" /> <input type="button"
						onclick="checkAccept(<?php echo ($vo["id"]); ?>,2)" class="btn btn-warning"
						style="width: 50px; height: 30px;" value="禁用" /> <input
						type="button" onclick="checkpower(<?php echo ($vo["id"]); ?>)"
						class="btn btn-danger" style="width: 80px; height: 30px;"
						value="权限管理" /></td>
					<?php else: ?> <?php if($vo["enabled"] == 1): ?><td>已启用</td>
					<td><input type="button" onclick="checkAccept(<?php echo ($vo["id"]); ?>,2)"
						class="btn btn-warning" style="width: 50px; height: 30px;"
						value="禁用" /> <input type="button" onclick="checkpower(<?php echo ($vo["id"]); ?>)"
						class="btn btn-danger" style="width: 80px; height: 30px;"
						value="权限管理" /></td>
					<?php else: ?>
					<td>已禁用</td>
					<td><input type="button" onclick="checkAccept(<?php echo ($vo["id"]); ?>,1)"
						class="btn btn-primary" style="width: 50px; height: 30px;"
						value="通过" /> <input type="button" onclick="checkpower(<?php echo ($vo["id"]); ?>)"
						class="btn btn-danger" style="width: 80px; height: 30px;"
						value="权限管理" /></td><?php endif; endif; ?>

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
	<script type="text/javascript" src="__PUBLIC__/js/index/usermanager.js"></script>
	<!-- 底部end -->
</body>
</html>