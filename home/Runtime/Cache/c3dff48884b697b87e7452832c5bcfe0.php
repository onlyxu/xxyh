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
		<form action="__ROOT__/index.php/addmenu" method="post">
		<input type="hidden" name="id" value="<?php echo ($menu["id"]); ?>" />
			<ul class="forminfo">
				<li><label>菜单名称:</label><input name="name"  type="text"
					class="dfinput" value="<?php echo ($menu["name"]); ?>"  /><i></i></li>
				<li><label>上级菜单:</label> <select name="pid" class="dfinput">
					<?php if($menu["pid"] == 0): ?><option selected="selected" value="0">无</option><?php endif; ?>
					<?php if(is_array($menuList)): $i = 0; $__LIST__ = $menuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pmenu): $mod = ($i % 2 );++$i; if($menu['pid'] == $pmenu['id']): ?><option selected="selected" value="<?php echo ($pmenu["id"]); ?>"><?php echo ($pmenu["name"]); ?></option>
							<?php else: ?>
							<option value="<?php echo ($pmenu["id"]); ?>"><?php echo ($pmenu["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</select> <i></i></li>
				<li><label>菜单链接:</label><input name="urls" type="text"
					class="dfinput" value="<?php echo ($menu["urls"]); ?>"  /><i></i></li>
				<li><label>菜单样式:</label><input name="cls" type="text"
					class="dfinput" value="<?php echo ($menu["cls"]); ?>"  /><i></i></li>
				<li><label>菜单排序:</label><input name="orders" type="text"
					class="dfinput" value="<?php echo ($menu["orders"]); ?>"  /><i></i></li>
				<li><label>启用状态:</label>
				<?php if($menu["enabled"] == 1): ?>启用<input type="radio" checked="checked" name="enabled" value="1" />&nbsp;
					禁用<input type="radio" name="enabled" value="2" />&nbsp;
					<?php else: ?>
					启用<input type="radio" name="enabled" value="1" />&nbsp;
					禁用<input type="radio" checked="checked" name="enabled" value="2" />&nbsp;<?php endif; ?>
				<i></i></li>
				<li><label>&nbsp;</label><input type="submit"
					class="btn btn-success" value="确认保存" /></li>
			</ul>
		</form>
		<!-- 内容end -->
	</div>

</body>
</html>