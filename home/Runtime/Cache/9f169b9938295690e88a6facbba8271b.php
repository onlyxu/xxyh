<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css" />
<link rel="stylesheet" href="__PUBLIC__/css/add.css" type="text/css"
	media="screen" />
<link rel="stylesheet"
	href="__PUBLIC__/kindeditor-4.1.10/themes/default/default.css" />
<link rel="stylesheet"
	href="__PUBLIC__/kindeditor-4.1.10/plugins/code/prettify.css" />

</head>
<body>

	<!-- 主要内容start -->
	<div class="div_from_aoto">
		<form action="__ROOT__/index.php/newcompany" method="post">
			<input type="hidden" name="id" value="<?php echo ($company["id"]); ?>" />
			<DIV class="control-group">
				<label class="laber_from">公司名称:</label>
				<DIV class="controls">
					<INPUT class="input_from" style="width: 400px;" type="text"
						name="name" value="<?php echo ($company["name"]); ?>" placeholder="请输入公司名称">
					<P class=help-block></P>
				</DIV>
			</DIV>
			<DIV class="control-group">
				<label class="laber_from">公司详情:</label>
				<DIV class="controls">
					<textarea name="content"
						style="width: 800px; height: 400px; visibility: hidden;" id=""
						cols="30" rows="10" class="textarea"><?php echo ($company["desc"]); ?></textarea>
					<P class=help-block></P>
				</DIV>
			</DIV>
			<DIV class="control-group">
				<LABEL class="laber_from"></LABEL>
				<DIV class="controls">
					<button type="submit" class="btn btn-success" style="width: 200px;">确认</button>
				</DIV>
			</DIV>
		</form>
	</div>
	<!-- 主要内容分页end -->
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
	<script charset="utf-8"
		src="__PUBLIC__/kindeditor-4.1.10/kindeditor-min.js"></script>
	<script charset="utf-8"
		src="__PUBLIC__/kindeditor-4.1.10/lang/zh_CN.js"></script>
	<script charset="utf-8"
		src="__PUBLIC__/kindeditor-4.1.10/plugins/code/prettify.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/index/addproduct.js"></script>
	<!-- 底部end -->
</body>
</html>