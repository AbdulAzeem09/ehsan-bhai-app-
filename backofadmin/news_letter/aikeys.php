<?php
   if (!defined('WEB_ROOT')) {
   exit;
   }
   // Get API key in tbl_user table in user_id bases
   $userid=$_SESSION['userId'];
   $data = selectQ("select * from tbl_user where user_id=?","s",[$userid],"one");
   
   ?>
<?php include(THEME_PATH . '/tb_link.php');?>
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
   <h1>ADD AI-KEYS</h1>
</section>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row bord-right-space" >
         <div class="col-md-12">
            <div class="box box-primary">
               <form action="aikeys_process.php" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" >
                  <div class="box-header with-border">
                     <h3 class="box-title"> AI-KEY</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                     <div class="form-group">
                        <input class="form-control" name="aikey" id="aikey" value="<?php echo $data['ai_keys'];?>" placeholder="Enter AI-KEYS"/ required>
                     </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                     <div class="pull-right">
                        <button name="submitBtn" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Submit</button>
                     </div>
                  </div>
                  <!-- /.box-footer -->
               </form>
            </div>
            <!-- /. box -->
         </div>
      </div>
      <!--- End Table ---------------->
   </div>
</section>
<!-- /.content -->