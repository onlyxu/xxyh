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
		<form action="__ROOT__/index.php/saveuser" method="post">
			<input type="hidden" name="id" value="<?php echo ($user['id']); ?>" />
			<ul class="forminfo">
				<li><label>登录账户:</label><span><?php echo ($user['loginname']); ?></span><i></i></li>
				<li><label>用户姓名:</label><span><?php echo ($user['name']); ?></span><i></i></li>
				<li><label>用户性别:</label><span><?php echo ($user['sex']); ?></span><i></i></li>
				<li><label>电话号码:</label><span><?php echo ($user['tele']); ?></span><i></i></li>
				<li><label>邮&nbsp;&nbsp;箱:</label><span><?php echo ($user['email']); ?></span><i></i></li>
				<li><label>身份证号:</label><span><?php echo ($user['cardid']); ?></span><i></i></li>
				<li><label>银行卡号:</label><span><?php echo ($user['bankcard']); ?></span><i></i></li>
				<li><label>开户银行:</label><span><?php echo ($bank['value']); ?></span><i></i></li>
				<li><label>推荐人:</label><span><?php echo ($user['refuser']); ?></span><i></i></li>
				<li><label>收货地址:</label><span><?php echo ($user['receiveaddr']); ?></span><i></i></li>
				<li><input type="button" onclick="addpay()"
					class="btn btn-info" value="充值" />&nbsp;&nbsp;<input type="button"
					onclick="editInfo()" class="btn btn-success" value="编辑" /></li>
			</ul>
		</form>
		<!-- 内容end -->
	</div>
	<div class="route_bg">
		<a href="#">账户信息</a><i class="glyph-icon icon-chevron-right"></i>
	</div>
	<div class="rightinfo">
		<!-- 主要内容start -->
		<form action="__ROOT__/index.php/saveuser" method="post">
			<input type="hidden" name="id" value="<?php echo ($user['id']); ?>" />
			<ul class="forminfo">
				<li><label>您的业绩:</label><label><?php echo ($user['yeji']); ?></label> <?php if(($user['formapp'] == 1)): ?><i><a
						href="javascript:getFormApp()">正在申请报单中心</a></i><?php endif; ?> <?php if(($user['formapp'] == 2)): ?><i><a href="#">已申请报单中心</a></i><?php endif; ?> <?php if(($user['formapp'] == 0) AND ($user['yeji'] > 5000)): ?><i><a href="javascript:getFormApp()">报单申请</a></i><?php endif; ?></li>
				<li><label>已结提成:</label><label><?php echo ($user['ticheng']); ?></label> <?php if(($user['ticheng'] == 100) OR ($user['ticheng'] > 100)): ?><i> <a href="javascript:getMoney()">提现</a></i><?php endif; ?></li>
				<li><label>可结算提成:</label><label><?php echo ($balance); ?></label><i></i></li>
				<li><label>已消费:</label><label><?php echo ($user['xiaofei']); ?></label><i></i></li>
			</ul>
		</form>
		<!-- 内容end -->
	</div>

	<!-- 内容end -->
	 <input type="hidden" id="ticheng" value="<?php echo ($user['ticheng']); ?>"/>
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
	<script type="text/javascript" src="__PUBLIC__/js/index/userinfo.js"></script>
	<!-- 底部end -->
</body>
</html>