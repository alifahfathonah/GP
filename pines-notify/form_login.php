<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>Login Form :: Aplikasi Planning Production and Inventory Control</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
	
    <?php $base_url = base_url();?>

    <link href="<?php echo $base_url;?>assets/fonts/font-roboto/css/font-roboto.min.css" type="text/css" rel="stylesheet">
	<link href="<?php echo $base_url;?>assets/fonts/materialicons/css/materialicons.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $base_url;?>assets/plugins/progress-skylo/skylo.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $base_url;?>assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $base_url;?>assets/css/styles.css" type="text/css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
        <link href="<?php echo $base_url;?>assets/css/ie8.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <link href="<?php echo $base_url;?>assets/plugins/pines-notify/pnotify.css" type="text/css" rel="stylesheet">
    
    
    </head>

    <body class="focused-form animated-content" style="background-color:#00a1ef;color:white!important;">
    
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

		<script src="<?php echo $base_url;?>assets/js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo $base_url;?>assets/js/jqueryui-1.10.3.min.js"></script>
		<script src="<?php echo $base_url;?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo $base_url;?>assets/js/enquire.min.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/velocityjs/velocity.min.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/velocityjs/velocity.ui.min.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/progress-skylo/skylo.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/wijets/wijets.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/sparklines/jquery.sparklines.min.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/codeprettifier/prettify.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/dropdown.js/jquery.dropdown.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/bootstrap-material-design/js/material.min.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/bootstrap-material-design/js/ripples.min.js"></script>

		<script src="<?php echo $base_url;?>assets/js/application.js"></script>
		<script src="<?php echo $base_url;?>assets/demo/demo.js"></script>
		<script src="<?php echo $base_url;?>assets/demo/demo-switcher.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/form-parsley/parsley.js"></script>
		<script src="<?php echo $base_url;?>assets/plugins/pines-notify/pnotify.min.js"></script>

		<div class="container" id="login-form" >
			<a href="#" class="login-logo"><h1 style="color:white">Aplikasi Planning Production and Inventory Control (PPIC)</h1></a>
			<div class="row" >
				<div class="col-md-4 col-md-offset-4" >
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2>Login Form</h2>
						</div>
						<form action="<?php echo $base_url.$this->page.'login_submit';?>" method="POST" class="form-horizontal" id="validate-form" data-parsley-validate>
							
							<div class="panel-body">
								<div class="form-group mb-md">
									<div class="col-xs-12">
										<div class="input-group">							
											<span class="input-group-addon">
												<i class="ti ti-user"></i>
											</span>
											<input name="username" type="text" class="form-control" placeholder="Username" data-parsley-minlength="3" placeholder="At least 3 characters" required>
										</div>
									</div>
								</div>
								<div class="form-group mb-md">
									<div class="col-xs-12">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="ti ti-key"></i>
											</span>
											<input name="password[]" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
										</div>
									</div>
								</div>
								<input name="password[]" type="password" style="display:none"/>
							</div>
							<div class="panel-footer">
								<div class="clearfix">
									<button name="submit" data-loading-text="Loading..." id="action" class="loading-action-btn btn btn-primary btn-raised pull-right">Login</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<center class="text-muted">&nbsp;</center>
		
		<style>
			.parsley-errors-list{
				list-style: none;
				color: #e51c23;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$("form").submit(function(form){
					if ( $(this).parsley().isValid() ) {
						$('#action').button('loading');
						$.ajax({
							type:'post',
							url:$(this).attr('action'),
							data:$(this).serialize(),
							dataType:'json',
							success:function(data){
								if(data.status == 1)
								{
									new PNotify({
										title: 'Berhasil Login!',
										text: '',
										type: 'success',
										icon: 'ti ti-check',
										styling: 'fontawesome'
									});
									setTimeout(function(){
										document.location.href = "<?php echo base_url().$this->page;?>";
									}, 500);
								}
								else if(data.status == 0)
								{
									new PNotify({
										title: 'Gagal Log In',
										text: 'Username atau password belum terdaftar/ akun tidak aktif.',
										type: 'error',
										icon: 'ti ti-close',
										styling: 'fontawesome'
									});
								}
								$('#action').button('reset');
								$('.login-alert').fadeIn('fast');
							}
						});
						return false;
					}
				});
			});
		</script>
    </body>
</html>