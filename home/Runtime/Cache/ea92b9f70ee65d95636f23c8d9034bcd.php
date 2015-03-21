<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
</head>

<body>
<div class="loginBg">
	<div class="loginCent">
		<form id="loginform" method="post" action="__ROOT__/index.php/login">
    	<p><input type="text" name="loginname"  class="textUser" /></p>
        <p><input type="password" name="loginpass" class="textPwd" /></p>
        <p>&nbsp;</p>
        <p class="loginBtn">
        	<a href="javascript:formlogin()"><img src="__PUBLIC__/images/login.png" width="87" height="29" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
        	<a href="javascript:formreset()"><img src="__PUBLIC__/images/reset.png" width="87" height="29" /></a>
        </p>
       </form>
    </div>
</div>
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
<script type="text/javascript" src="__PUBLIC__/js/login.js"></script>
</body>
</html>