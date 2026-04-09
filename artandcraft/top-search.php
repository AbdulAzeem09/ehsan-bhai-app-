
	<style>
		.container form input.btn.btn_searchArt {
			border-radius: 0px 10px 10px 0px;
		}
		form .leftArt.pro_detail_box label {
    		font-weight: 500;
		}

		.innerArtBanner{
              background-image: unset !important;
              background-color: #cbcbcb !important;
            }

		.myclass1 {
		color: white;
		font-size: 15px;
		line-height: 41px;
		font-family: "Proxima Nova";		
		margin-top: 15px;

	   }
	  .myclass1 a:hover{
		background-color: #99068a;
		color:white;
	  }

	</style>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<form action="search.php">
				<input type="hidden" name="txtSearchCategory" value="<?php echo $_GET["categoryID"];?>">
				<div class="form-group">
					<input value="<?php echo $_GET["txtArtSearch"];?>" type="text" class="form-control" name="txtArtSearch" required placeholder="Search images, vector, illustration">
					<input type="submit" name="btnArtSearch" class="btn btn_searchArt " value="Search">
				</div>
			</form>
		</div>

		<div class="col-md-4 myclass1" >
			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				<div class="btn-group" role="group">					
					<?php
					 if($_SESSION['guet_yes'] != 'yes'){ 
					if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 1){ ?>
						<a class="btn btn-default btn-border-radius" href="<?php echo $BaseUrl.'/post-ad/photos/?post';?>">Sell Art</a> <?php
					}else{
						?>
						<a class="btn btn-default btn-border-radius" href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' >Sell Art</a> <?php
					 } }
					?>
				</div>
				<div class="btn-group" role="group">
				<?php if($_SESSION['guet_yes'] != 'yes'){ ?>
					<a href="<?php echo $BaseUrl; ?>/artandcraft/dashboard/" class="btn btn-default btn-border-radius" style="margin-left: 10px;">Dashboard</a>
				<?php } ?>
				</div>				
			</div>			
		</div>
		<!-- <div class="col-md-1  myclass1" >
			<a style="color:white;" href=""></a> 
		</div> -->
	</div>
</div>
<style>
	.myclass1 {
		
		color: white;
		font-size: 15px;
		line-height: 41px;
		font-family: "Proxima Nova";		
		margin-top: 15px;

	}
	.myclass1 a:hover{
		background-color: #99068a;
		
		color:white;
	}
</style>