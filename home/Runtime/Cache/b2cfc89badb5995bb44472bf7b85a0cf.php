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
		<form action="__ROOT__/index.php/adddata" id="form1" method="post">
			<input type="hidden" name="refuserid"
				value="<?php echo ($_SESSION['user']['id']); ?>" />
			<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
			<input type="hidden" name="type" id="type" value="<?php echo ($data["typeid"]); ?>" />
			<ul class="forminfo">
				<li><label>字典值:</label><input name="value" value="<?php echo ($data["value"]); ?>"  required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label>字典分类:</label>
				<select name="typeid" id="typeid" class="dfinput">
					<?php if(is_array($typeList)): $i = 0; $__LIST__ = $typeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i; if($data['typeid'] == $type['id']): ?><option value="<?php echo ($type["id"]); ?>" selected="selected"><?php echo ($type["name"]); ?></option>
							<?php else: ?>
							<option value="<?php echo ($type["id"]); ?>" ><?php echo ($type["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<i></i></li>
				<li><label>启用状态:</label>
				启用<input type="radio" checked="checked" name="enabled" value="1" />&nbsp;
				禁用<input type="radio" name="enabled" value="2" />&nbsp;
				<i></i></li>
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