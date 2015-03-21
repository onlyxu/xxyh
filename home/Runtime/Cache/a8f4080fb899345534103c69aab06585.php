<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/css.css" />

</head>
<body>
	<div style="height: 450px; width: 300px; overflow: auto;">
		<form action="__ROOT__/index.php/changepower" method="post">
			<input type="hidden" name="userid" value="<?php echo ($userid); ?>" />
			<ul id="browser" class="filetree treeview-famfamfam">
				<li><label><input type="checkbox"
						onclick="selectAllMenu()" />全选</label> <input type="submit"
					class="btn btn-primary" style="width: 50px; height: 25px;"
					value="确认" /></li>
				<?php if(is_array($menuList)): $i = 0; $__LIST__ = $menuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li><label><input type="checkbox" name="menuid[]"
						value="<?php echo ($menu["id"]); ?>" /><?php echo ($menu["name"]); ?></label></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>

		</form>
	</div>


</body>
</html>