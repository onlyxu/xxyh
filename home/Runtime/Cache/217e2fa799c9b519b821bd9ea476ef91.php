<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css" />
</head>
<body>

	<!-- 主要内容start -->
	<div class="add_right">
		<div class="add_bo">

			<div class="add_bo">
				<div class="add_content">
					<center>
						<h2><?php echo ($news["title"]); ?></h2>
					</center>
					<br />
					<p><?php echo ($news["info"]); ?></p>
				</div>
			</div>

		</div>
	</div>
	<!-- 主要内容end -->

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
	<script type="text/javascript"
		src="__PUBLIC__/js/index/indexproduct.js"></script>
	<!-- 底部end -->
</body>
</html>