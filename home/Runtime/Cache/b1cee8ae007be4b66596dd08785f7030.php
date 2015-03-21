<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="__PUBLIC__/css/main.css"  type="text/css" />
</head>
<body>
	<?php if(!empty($_SESSION['user'])): ?><span
		style="font-size: 20px;">您好，用户<?php echo ($user['name']); ?><br />您的总业绩为<b><?php echo ($user['yeji']); ?></b><br />
		已结算为<b><?php echo ($user['ticheng']); ?></b><br />可结算为<b><?php echo ($balance); ?></b><br />已消费为<b><?php echo ($user['xiaofei']); ?></b></span>
	<br />
	<div id="canvasDiv" style="margin-top: 15px;"></div>
	<?php else: ?> <span style="font-size: 20px;">欢迎您、来自<?php echo ($province); echo ($city); ?>的朋友。您的访问IP为<?php echo ($ip); ?><br /></span><?php endif; ?>
  	<!-- 内容end -->
    <input type="hidden" id="zongticheng" value="<?php echo ($user['yeji']); ?>"/>
    <input type="hidden" id="ticheng" value="<?php echo ($user['ticheng']); ?>"/>
    <input type="hidden" id="kejiesuan" value="<?php echo ($balance); ?>"/>
    <input type="hidden" id="kexiaofei" value="<?php echo ($user['xiaofei']); ?>"/>
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
     <script type="text/javascript" src="__PUBLIC__/js/ichart.1.2.js"></script>
     <script type="text/javascript" src="__PUBLIC__/js/index.js"></script>
</body>
</html>