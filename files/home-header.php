	<div class="container">
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="top_logo">
					<a class="" href="<?php echo $BaseUrl;?>">
						<img src="<?php echo $BaseUrl;?>/img/sp.png" alt="logo" class="img-responsive" />
						<span class="">The SharePage </span>
						<sup><small style="color:white">(beta)</small></sup>
					</a>
					
				</div>
			</div>
			<div class="col-md-6 col-xs-12">
				<h3 class="masthead-brand">
			
					<!--<ul class="nav nav-pills pull-right">
						<li role="presentation"><a href="/admin/buy/ class="mrl" style="font-size:20px;">Master Management</a></li>
						
						<li role="presentation"><a id="liRegi" class="regi mrl" style="cursor:pointer;font-size:20px;">Register</a></li>
						
						<li role="presentation"><a id="liLog" class="logi mrl" style="cursor:pointer;font-size:20px;">Login</a></li> 
					</ul>--> 
					
					<span class="pull-right" style="margin-right:10px;">
						
						<span class="dropdown">
							<!--<a role="button" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Master Management</a>-->
							<div class="dropdown-menu loginfrm" aria-labelledby="dropdownMenu1">
							<!--Login form-->
							<form style="margin:10px;" method="post" action="/authentication/adminlogin.php">
								<div class="form-group">
									
									<input type="text" class="form-control" id="usrname" placeholder="User name" name="spUserName" required>
								</div>
								
								<div class="form-group">
									
									<input type="password" class="form-control" id="usrpassword" placeholder="Password" name="spUserPassword" required>
								</div>
								
								<button type="button" id="adminlogin" class="btn btn-primary btn-lg btn-block">Login</button>
							</form>
							<!--Code Complete-->
							</div>
						</span>
						<?php
						if(isset($_SESSION['uid'])){ ?>
							<a id="liLog" role="button" class="btn butn-transparent" href="<?php echo $BaseUrl;?>/details/" ><i class="fa fa-dashboard"></i> My Dashboard</a> 
							<a id="liLog" role="button" class="btn butn-transparent" href="<?php echo $BaseUrl;?>/authentication/logout.php" >Logout</a> 
							<?php	
						}else{ ?>
							<a id="liLog" role="button" class="btn butn-transparent logi" href="#" ><i class="fa fa-user"></i> My Account</a> <?php
						}
						?>
						
						
						<?php 
						if(!isset($_SESSION['uid'])){ ?>
							<a id="liLog" role="button" class="btn butn-logo logi" href="#">Submit an Add</a><?php
						}else{ ?>
							<a href="post-ad/sell/" class="btn butn-logo top_btn_right">Submit an Add</a><?php
						}
						?>

						
						<!--<a id="liRegi" class="btn btn-default regi" href="#" role="button">Register</a>
						<a id="liLog"  class="btn btn-default logi" href="#" role="button">Login</a>-->
					</span>
				</h3>  
			</div>
		</div>
		
	</div>
	<!--Lock Coding-->