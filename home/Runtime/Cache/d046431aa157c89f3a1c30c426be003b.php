<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<!--head内容-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>满满商贸销售管理平台</title>
<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
	<!--head内容END-->
</head>
<body style=" background:#0f4c82">
<div class="content">
	<!--LOGO图片-->
	<div class="head">
    <ul class="headRight">
    <?php if(!empty($_SESSION['user'])): ?><li>已消费：<?php echo ($user['xiaofei']); ?></li>
        <li><a href="__ROOT__/index.php/userinfo"  target="mainframe">账户:<?php echo ($user['name']); ?></a></li>
        <li><a href="__ROOT__/index.php/goupdatepass" target="mainframe">修改密码</a></li>
        <li><a href="__ROOT__/index.php/exit"  target="_top">退出</a></li>
        <?php else: ?>
        	<li>&nbsp;</li>
        	<li>游客</li>
        	<li>&nbsp;</li>
        	<li>&nbsp;</li><?php endif; ?>
    </ul>
	<!-- <p style=" text-align:right; padding-right:10px; padding-top:60px">
	<?php if(!empty($_SESSION['user'])): ?><a href="__ROOT__/index.php/goupdatepass" target="mainframe"><img src="__PUBLIC__/images/modifyPwd.png" width="72" height="23" /></a>&nbsp;&nbsp;&nbsp;
    <a href="__ROOT__/index.php/exit"><img src="__PUBLIC__/images/exit.png" width="51" height="23" /></a><?php endif; ?>
    </p> -->
</div>
	<!--LOGO图片END-->
	<!--内容 -->
	<div class="clear pt10">
		<!--菜单-->
		<div class="fl w185">
		<?php if(!empty($_SESSION['user'])): if(is_array($menuList)): $i = 0; $__LIST__ = $menuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><div class="clear pt10">
					<?php if($menu["urls"] == '#'): ?><h2 class="titleBg" onclick="changemenu(this)"><a href="<?php echo ($menu["urls"]); ?>"><?php echo ($menu["name"]); ?></a></h2>
						<?php else: ?>
						<h2 class="titleBg" onclick="changemenu(this)"><a href="<?php echo ($menu["urls"]); ?>" target="mainframe"><?php echo ($menu["name"]); ?></a></h2><?php endif; ?>
					<ul class="functionList" style="display: none">
						 <?php if(is_array($childmenuList)): $j = 0; $__LIST__ = $childmenuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($j % 2 );++$j; if($child['pid'] == $menu['id']): if($child['urls'] == '#'): ?><li>
										<p class="title" onclick="setthismenu(this)">
											<span class="down"><img src="__PUBLIC__/images/down.png" width="5"
												height="3"></span><span><a href="<?php echo ($child['urls']); ?>"><?php echo ($child["name"]); ?></a></span>
										</p><img src="__PUBLIC__/images/line.png" width="185" height="2" class="fl">
									</li>
									<?php else: ?>
										<li>
											<p class="title" onclick="setthismenu(this)">
												<span class="down"><img src="__PUBLIC__/images/down.png" width="5"
													height="3"></span><span><a href="<?php echo ($child['urls']); ?>" target="mainframe"><?php echo ($child["name"]); ?></a></span>
											</p><img src="__PUBLIC__/images/line.png" width="185" height="2" class="fl">
										</li><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
						 </ul>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
 			<!-- 	<?php if(($user['yeji'] > 0) OR ($user['yeji'] == 0) ): ?><div class="clear pt10">
					<h2 class="titleBg" onclick="changemenu(this)"><a href="__ROOT__/index.php/goaddmyuser" target="mainframe" >添加用户</a></h2>
					</div><?php endif; ?> -->
			<?php else: ?>
				<div class="clear pt10">
				<h2 class="titleBg"><a href="__ROOT__/index.php/gologin">登录系统</a></h2>
				</div>
				<div class="clear pt10">
					<h2 class="titleBg"><a href="__ROOT__/index.php/indexproduct" target="mainframe">产品信息</a></h2>
				</div>
				<div class="clear pt10">
					<h2 class="titleBg"><a href="__ROOT__/index.php/indexnews" target="mainframe">内部新闻</a></h2>
				</div>
				<div class="clear pt10">
					<h2 class="titleBg"><a href="__ROOT__/index.php/companyinfo" target="mainframe">公司信息</a></h2>
				</div><?php endif; ?>
</div>
		<!--菜单END-->
		<!--主内容-->
	    <div class="rightCont">
	    	<div class="contBg">
				<iframe width="100%" height="100%" name="mainframe" id="mainframe"   src="__ROOT__/index.php/main" ></iframe>
	    	</div>
	    </div>
	    <!--主内容END-->
	</div>
	<!--内容END -->
</div>
<!--公用JS-->
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
<!--公用JS END-->
</body>
</html>