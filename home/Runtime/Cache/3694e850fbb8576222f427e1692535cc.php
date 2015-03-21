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
		<form action="__ROOT__/index.php/addmyuser" id="form1" method="post">
			<input type="hidden" name="refuserid"
				value="<?php echo ($_SESSION['user']['id']); ?>" />
			<ul class="forminfo">
				<li><label>登录账户:</label><input name="loginname" onblur="checkLoginName()" required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label>用户姓名:</label><input name="name" onblur="checkName()" required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label>用户性别:</label>男<input name="sex" checked="checked"  type="radio"  value="男" />&nbsp;&nbsp;
				女<input name="sex"  type="radio"  value="女" /><i></i></li>
				<li><label>充值金额:</label><input name="balance" required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label>电话号码:</label><input name="tele" required="required" type="text"
					class="dfinput" value="xxx-xxxx-xxxx" /><i></i></li>
				<li><label>邮&nbsp;&nbsp;箱:</label><input required="required" name="email"
					type="text" class="dfinput" value="xxx@xxx.com" /><i></i></li>
				<li><label>身份证号:</label><input name="cardid" required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label>银行卡号:</label><input name="bankcard" required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label>开户银行:</label>
				<select name="bankid" class="dfinput">
				<?php if(is_array($bankList)): $i = 0; $__LIST__ = $bankList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bank): $mod = ($i % 2 );++$i; if($user['bankid'] == $bank['id']): ?><option selected="selected" value="<?php echo ($bank["id"]); ?>"><?php echo ($bank["value"]); ?></option>
							<?php else: ?>
							<option  value="<?php echo ($bank["id"]); ?>"><?php echo ($bank["value"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<i></i></li>
				<li><label>推荐人:</label><input name="refuser" required="required" type="text"
					readonly="readonly" class="dfinput"
					value="<?php echo ($_SESSION['user']['name']); ?>" /><i></i></li>
				<li><label>收货地址:</label><input name="receiveaddr" required="required" type="text"
					class="dfinput" value="" /><i></i></li>
				<li><label></label><?php echo ($msg); ?><i></i></li>
				<li><label></label>密码默认为六个0<i></i></li>
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
		<script type="text/javascript" src="__PUBLIC__/js/index/addmyuser.js"></script>
		<!--     <script src="__PUBLIC__/js/jquery.validate.min.js" type="text/javascript" ></script>
   <script type="text/javascript" src="__PUBLIC__/js/pass_validata.js"></script> -->
		<!-- 底部end -->
</body>
</html>