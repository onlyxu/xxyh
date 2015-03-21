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
		<form action="__ROOT__/index.php/adduser" method="post">
		<input type="hidden" name="id" id="id" value="<?php echo ($user["id"]); ?>" />
			<ul class="forminfo">
				<li><label>登录名:</label><input name="loginname" onblur="checkLoginName()" required="required"  type="text"
					class="dfinput" value="<?php echo ($user["loginname"]); ?>"  /><i></i></li>
				<li><label>用户角色:</label> <select name="roleid" class="dfinput">
					<?php if(is_array($rolelist)): $i = 0; $__LIST__ = $rolelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i; if($user['roleid'] == $role['id']): ?><option selected="selected" value="<?php echo ($role["id"]); ?>"><?php echo ($role["name"]); ?></option>
							<?php else: ?>
							<option value="<?php echo ($role["id"]); ?>"><?php echo ($role["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</select> <i></i></li>
				<li><label>用户姓名:</label><input name="name" onblur="checkName()" required="required" type="text"
					class="dfinput" value="<?php echo ($user["name"]); ?>"  /><i></i></li>
				<li><label>用户性别:</label>
				<?php if($user["sex"] == '男'): ?>男<input name="sex" checked="checked"  type="radio"  value="男"  />&nbsp;&nbsp;
					女<input name="sex"  type="radio"  value="女"  />
					<?php else: ?>
					男<input name="sex"   type="radio"  value="男"  />&nbsp;&nbsp;
					女<input name="sex" checked="checked" type="radio"  value="女"  /><?php endif; ?>
				<i></i></li>
				<li><label>电话号码:</label><input name="tele" required="required" type="text"
					class="dfinput" value="<?php echo ($user["tele"]); ?>"  /><i></i></li>
				<li><label>充值金额:</label><input name="balance" required="required" type="text"
					class="dfinput" value="<?php echo ($user["balance"]); ?>"  /><i></i></li>
				<li><label>身份证号:</label><input name="cardid" required="required" type="text"
					class="dfinput" value="<?php echo ($user["cardid"]); ?>"  /><i></i></li>
				<li><label>银行卡号:</label><input name="bankcard" required="required" type="text"
					class="dfinput" value="<?php echo ($user["bankcard"]); ?>" /><i></i></li>
				<li><label>开户银行:</label>
				<select name="bankid" class="dfinput">
				<?php if(is_array($bankList)): $i = 0; $__LIST__ = $bankList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bank): $mod = ($i % 2 );++$i; if($user['bankid'] == $bank['id']): ?><option selected="selected" value="<?php echo ($bank["id"]); ?>"><?php echo ($bank["value"]); ?></option>
							<?php else: ?>
							<option  value="<?php echo ($bank["id"]); ?>"><?php echo ($bank["value"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<i></i></li>
				<li><label>推荐人:</label><input name="refuser" required="required" type="text"
					class="dfinput" value="<?php echo ($user["refuser"]); ?>"  /><i></i></li>
				<li><label>收货地址:</label><input name="receiveaddr" required="required" type="text"
					class="dfinput" value="<?php echo ($user["receiveaddr"]); ?>"  /><i></i></li>
				<li><label>邮箱:</label><input name="email" required="required" type="text"
					class="dfinput" value="<?php echo ($user["email"]); ?>"  /><i></i></li>
				<li><label>&nbsp;</label><input type="submit"
					class="btn btn-success" value="确认保存" /></li>
			</ul>
		</form>
		<!-- 内容end -->
	</div>

</body>
</html>