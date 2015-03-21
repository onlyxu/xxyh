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
		<!-- 主要内容start -->
		<table class="tablelist" border="1">
			<thead>
				<tr>
					<th width="80">序号</th>
					<th width="120">提现金额</th>
					<th width="140">提现时间</th>
					<th width="100">提现人</th>
					<th width="100">提现人业绩</th>
					<th width="80">提现状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($items)): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($i); ?></td>
					<td><?php echo ($vo["money"]); ?></td>
					<td><?php echo ($vo["dtime"]); ?></td>
					<td><?php echo ($vo["name"]); ?></td>
					<td><?php echo ($vo["yeji"]); ?></td>
					<?php if($vo["status"] == 0): ?><td>未审核</td>
					<td><input type="button" onclick="acceptStatus(<?php echo ($vo["id"]); ?>,1)"
						style="width: 60px; height: 30px;" class="btn btn-success"
						value="通过" /> <input type="button"
						onclick="acceptStatus(<?php echo ($vo["id"]); ?>,2)"
						style="width: 60px; height: 30px;" class="btn btn-info"
						value="未通过" /></td>
					<?php else: ?> <?php if($vo["status"] == 1): ?><td>提现成功</td>
					<td>&nbsp;</td>
					<?php else: ?>
					<td>提现失败</td>
					<td><input type="button" style="width: 60px; height: 30px;"
						onclick="acceptStatus(<?php echo ($vo["id"]); ?>,1)" class="btn btn-success"
						value="通过" /></td><?php endif; endif; ?>

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
	<script type="text/javascript" src="__PUBLIC__/js/index/alltixian.js"></script>
	<!-- 底部end -->
</body>
</html>