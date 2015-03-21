<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css" />
</head>
<body>

	<div class="rightinfo">
		<!-- 主要内容start -->
		<form action="__ROOT__/index.php/adddatatype" id="form1" method="post">
			<input type="hidden" name="refuserid"
				value="<?php echo ($_SESSION['user']['id']); ?>" />
			<ul class="forminfo">
				<li><label>字典名称:</label><input name="name" onblur="checkLoginName()" required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label>关键字:</label><input name="keyword" required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label>序号:</label><input name="orders"  required="required" type="text"
					class="dfinput" value="<?php echo ($orders); ?>" /><i></i></li>
				<li><label>&nbsp;</label><input type="submit"
					class="btn btn-success" value="确认保存" /></li>
			</ul>
		</form>
		<!-- 内容end -->


		<!-- 内容end -->
			<input type="hidden" id="pagecount" value="<?php echo ($pagecount); ?>" /> <input
			type="hidden" id="itemscount" value="<?php echo ($itemscount); ?>" /> <input
			type="hidden" id="pageno" value="<?php echo ($pageno); ?>" /> <input type="hidden"
			id="size" value="12" />
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
		<!-- <script type="text/javascript" src="__PUBLIC__/js/index/addmyuser.js"></script> -->
		<!--     <script src="__PUBLIC__/js/jquery.validate.min.js" type="text/javascript" ></script>
   <script type="text/javascript" src="__PUBLIC__/js/pass_validata.js"></script> -->
		<!-- 底部end -->
</body>
</html>