<?php
$no_visible_elements=true;
include('header.php'); ?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>欢迎来到教会日程安排系统</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						<?php
							if($error!=null){
								echo $error;
							}else{
								echo "请输入你的用户名和密码";
							}
						?>
					</div>
					<form class="form-horizontal" action="login" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text"  />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password"  />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">登录</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>
