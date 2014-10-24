<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>教会活动管理系统</title>

	<!-- The styles -->
	
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link  href={{asset('css').'/bootstrap-cerulean.css'}}  rel="stylesheet">
	<link href={{asset('css').'/bootstrap-responsive.css'}} rel="stylesheet">
	<link href={{asset('css').'/charisma-app.css'}} rel="stylesheet">
	<link href={{asset('css').'/jquery-ui-1.8.21.custom.css'}} rel="stylesheet">
	<link href={{asset('css').'/fullcalendar.css'}} rel='stylesheet'>
	<link href={{asset('css').'/fullcalendar.print.css'}} rel='stylesheet'  media='print'>
	<link href={{asset('css').'/chosen.css'}} rel='stylesheet'>
	<link href={{asset('css').'/uniform.default.css'}} rel='stylesheet'>
	<link href={{asset('css').'/colorbox.css'}} rel='stylesheet'>
	<link href={{asset('css').'/jquery.cleditor.css'}} rel='stylesheet'>
	<link href={{asset('css').'/jquery.noty.css'}} rel='stylesheet'>
	<link href={{asset('css').'/noty_theme_default.css'}} rel='stylesheet'>
	<link href={{asset('css').'/elfinder.min.css'}} rel='stylesheet'>
	<link href={{asset('css').'/elfinder.theme.css'}} rel='stylesheet'>
	<link href={{asset('css').'/jquery.iphone.toggle.css'}} rel='stylesheet'>
	<link href={{asset('css').'/opa-icons.css'}} rel='stylesheet'>
	<link href={{asset('css').'/uploadify.css'}} rel='stylesheet'>
	
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href={{asset('img').'/favicon.ico'}}>
		
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"> <img alt="Charisma Logo" src={{asset('img').'/logo20.png'}} /> <span>活动管理系统</span></a>
				
				
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> {{Auth::user()->Name}}</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="changePassword">修改密码</a></li>
						<li class="divider"></li>
						<li><a href={{asset('logout')}}>注销</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="{{asset('index')}}"><i class="icon-home"></i><span class="hidden-tablet">主页</span></a></li>
						<?php
							$roles=Auth::user()->roles;
							foreach ($roles as $role) {
								//echo $role->RoleName;
								$powers=$role->powers;
								foreach ($powers as $power) {
									//echo $power->name;
									switch ($power->name) {
										case 'center':
											echo "<li><a class='ajax-link' href='".asset($power->name)."/list'><i class='icon-eye-open'></i><span class='hidden-tablet'>培训中心</span></a></li>";
											break;
										case 'company':	
											echo "<li><a class='ajax-link' href='".asset($power->name)."/list'><i class='icon-eye-open'></i><span class='hidden-tablet'>公司</span></a></li>";
											break;
										case 'user':
											echo "<li><a class='ajax-link' href='".asset($power->name)."/list'><i class='icon-eye-open'></i><span class='hidden-tablet'>用户</span></a></li>";
											break;
										case 'activity':
											echo "<li><a class='ajax-link' href='".asset($power->name)."/arrange'><i class='icon-eye-open'></i><span class='hidden-tablet'>活动</span></a></li>";
											break;
										case 'content':
											echo "<li><a class='ajax-link' href='".asset($power->name)."/arrange'><i class='icon-eye-open'></i><span class='hidden-tablet'>证道内容</span></a></li>";
											break;
										case 'share':
											echo "<li><a class='ajax-link' href='".asset($power->name)."/arrange'><i class='icon-eye-open'></i><span class='hidden-tablet'>家事分享</span></a></li>";
											break;
										case 'host':
											echo "<li><a class='ajax-link' href='".asset($power->name)."/arrange'><i class='icon-eye-open'></i><span class='hidden-tablet'>主持人</span></a></li>";
											break;
										case 'song':
											echo "<li><a class='ajax-link' href='".asset($power->name)."/arrange'><i class='icon-eye-open'></i><span class='hidden-tablet'>诗歌</span></a></li>";
											break;
										default:
											break;
									}
								}
							}
						?>
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			
			@yield('content')

			<!-- content ends -->
			</div><!--/#content.span10-->
		<?php } ?>
		</div><!--/fluid-row-->
		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
		
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://usman.it" target="_blank">Muhammad Usman</a> <?php echo date('Y') ?></p>
			<p class="pull-right">Powered by: <a href="http://usman.it/free-responsive-admin-template">Charisma</a></p>
		</footer>
		<?php } ?>

	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src={{asset('js').'/jquery-1.7.2.min.js'}}></script>
	<!-- jQuery UI -->
	<script src={{asset('js').'/jquery-ui-1.8.21.custom.min.js'}}></script>
	<!-- transition / effect library -->
	<script src={{asset('js').'/bootstrap-transition.js'}}></script>
	<!-- alert enhancer library -->
	<script src={{asset('js').'/bootstrap-alert.js'}}></script>
	<!-- modal / dialog library -->
	<script src={{asset('js').'/bootstrap-modal.js'}}></script>
	<!-- custom dropdown library -->
	<script src={{asset('js').'/bootstrap-dropdown.js'}}></script>
	<!-- scrolspy library -->
	<script src={{asset('js').'/bootstrap-scrollspy.js'}}></script>
	<!-- library for creating tabs -->
	<script src={{asset('js').'/bootstrap-tab.js'}}></script>
	<!-- library for advanced tooltip -->
	<script src={{asset('js').'/bootstrap-tooltip.js'}}></script>
	<!-- popover effect library -->
	<script src={{asset('js').'/bootstrap-popover.js'}}></script>
	<!-- button enhancer library -->
	<script src={{asset('js').'/bootstrap-button.js'}}></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src={{asset('js').'/bootstrap-collapse.js'}}></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src={{asset('js').'/bootstrap-carousel.js'}}></script>
	<!-- autocomplete library -->
	<script src={{asset('js').'/bootstrap-typeahead.js'}}></script>
	<!-- tour library -->
	<script src={{asset('js').'/bootstrap-tour.js'}}></script>
	<!-- library for cookie management -->
	<script src={{asset('js').'/jquery.cookie.js'}}></script>
	<!-- calander plugin -->
	<script src={{asset('js').'/fullcalendar.min.js'}}></script>
	<!-- data table plugin -->
	<script src={{asset('js').'/jquery.dataTables.min.js'}}></script>

	<!-- chart libraries start -->
	<script src={{asset('js').'/excanvas.js'}}></script>
	<script src={{asset('js').'/jquery.flot.min.js'}}></script>
	<script src={{asset('js').'/jquery.flot.pie.min.js'}}></script>
	<script src={{asset('js').'/jquery.flot.stack.js'}}></script>
	<script src={{asset('js').'/jquery.flot.resize.min.js'}}></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src={{asset('js').'/jquery.chosen.min.js'}}></script>
	<!-- checkbox, radio, and file input styler -->
	<script src={{asset('js').'/jquery.uniform.min.js'}}></script>
	<!-- plugin for gallery image view -->
	<script src={{asset('js').'/jquery.colorbox.min.js'}}></script>
	<!-- rich text editor library -->
	<script src={{asset('js').'/jquery.cleditor.min.js'}}></script>
	<!-- notification plugin -->
	<script src={{asset('js').'/jquery.noty.js'}}></script>
	<!-- file manager library -->
	<script src={{asset('js').'/jquery.elfinder.min.js'}}></script>
	<!-- star rating plugin -->
	<script src={{asset('js').'/jquery.raty.min.js'}}></script>
	<!-- for iOS style toggle switch -->
	<script src={{asset('js').'/jquery.iphone.toggle.js'}}></script>
	<!-- autogrowing textarea plugin -->
	<script src={{asset('js').'/jquery.autogrow-textarea.js'}}></script>
	<!-- multiple file upload plugin -->
	<script src={{asset('js').'/jquery.uploadify-3.1.min.js'}}></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src={{asset('js').'/jquery.history.js'}}></script>
	<!-- application script for Charisma demo -->
	<script src={{asset('js').'/charisma.js'}}></script>
	
	
	
</body>
</html>
