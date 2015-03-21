<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/kkpager.css" />
</head>
<body style="margin-top: 15px;">

	<div class="rightinfo">
		<button class="btn btn-success" onclick="addFormMoney()"
			style="width: 80px; height: 30px; margin-bottom: 10px;">我要报单</button>
		<!-- 主要内容start -->
		<table class="tablelist" border="1">
			<thead>
				<tr>
					<th width="150">报单金额</th>
					<th width="150">报单时间</th>
					<th width="150">报单人</th>
					<th width="150">报单提成(元)</th>
					<th width="150">审核状态</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($items)): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["money"]); ?></td>
					<td><?php echo ($vo["dtime"]); ?></td>
					<td><?php echo ($vo["sumname"]); ?></td>
					<td><?php echo ($vo["sum"]); ?></td>
					<?php if($vo["status"] == 0 ): ?><td>未审核</td>
					<?php else: ?> <?php if($vo["status"] == 1 ): ?><td>审核通过</td>
					<?php else: ?>
					<td>审核未通过</td><?php endif; endif; ?>
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
	<script type="text/javascript"
		src="__PUBLIC__/js/index/customerform.js"></script>
	<!-- 底部end -->
</body>
</html>