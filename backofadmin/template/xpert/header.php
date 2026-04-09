
		<?php
			@$loginname = $_SESSION['accountName'];
		?>
		<header class="main-header">
        <!-- Logo -->
			<a href="" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>S-P</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>The SharePage</b></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								
								<?php
								if(isset($_SESSION['userImg']) && $_SESSION['userImg'] != ''){ ?>
									<img src="<?php echo WEB_ROOT;?>/upload/user/<?php echo $_SESSION['userImg'];?>" class="img-circle" style="width: 25px;height: 25px;" alt="User Image" /><?php
								}else{ ?>
									<img src="<?php echo WEB_ROOT_TEMPLATE;?>/assets/admin/img/no_image.webp" class="img-circle" alt="User Image" style="width:25px;height: 25px;" /> <?php
								}
								?>
								<span class="hidden-xs"><?php echo strtoupper($loginname);  ?> </span> 
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<?php
									if(isset($_SESSION['userImg']) && $_SESSION['userImg'] != ''){ ?>
										<img src="<?php echo WEB_ROOT;?>/upload/user/<?php echo $_SESSION['userImg'];?>" class="img-circle" style="width: 100px;height: 100px;" alt="User Image" /><?php
									}else{ ?>
										<img src="<?php echo WEB_ROOT_TEMPLATE;?>/assets/admin/img/no_image.webp" class="img-circle" alt="User Image" style="width: 100px;height: 100px;" /> <?php
									}
									?>
									<p><?php echo strtoupper($loginname);  ?><small></small></p>
								</li>
                  
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo WEB_ROOT_ADMIN . "myprofile" ?>" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<?php 
										if(isset($_SESSION['userId']) && isset($_SESSION['userlevel'])){ ?>
											<!-- <a href="<?php echo WEB_ROOT_ADMIN;?>?logout" class="btn btn-default btn-flat" id="signout" >Sign Out</a> -->
											<a href="javascript:void(0)" class="btn btn-default btn-flat"  id="signout" >Sign Out</a>
											<?php	
										}
										else{?>
											<a href="../../login.php" class="btn btn-default btn-flat">Log-In</a><?php 	
										} ?>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
						
					</ul>
				</div>
			</nav>
		</header>

	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
 

		<script type="text/javascript">
			$(document).on("click", "#signout", function() {

swal({
  title: "Are you sure?",
  /*text: "You Want to Logout!",*/
  type: "warning",
  confirmButtonClass: "sweet_ok",
  confirmButtonText: "Yes, Sign Out!",
  cancelButtonClass: "sweet_cancel",
  cancelButtonText: "Cancel",
  showCancelButton: true,
},
function(isConfirm) {
  if (isConfirm) {
   window.location='<?php echo WEB_ROOT_ADMIN;?>?logout';
  } else {
   // swal("Cancelled", "You canceled)", "error");
  }
});

});
		</script>