<?php 
if (!defined('WEB_ROOT')) {
		exit;
}
	
	
if(isset($_POST['submit'])){

  //print_r($_POST);

  $txtTitle = isset($_POST['txtTitle']) ? $_POST['txtTitle'] : "";
  $txtPostLimit = isset($_POST['txtPostLimit']) ? $_POST['txtPostLimit'] : 0;
  $txtDuration = isset($_POST['txtDuration']) ? $_POST['txtDuration'] : 0;
  $txtAmount = isset($_POST['txtAmount']) ? $_POST['txtAmount'] : "";
  $txtDescription = isset($_POST['txtDescription']) ? $_POST['txtDescription'] : "";
  $txticon = isset($_POST['txticon']) ? $_POST['txticon'] : "";

	
	$sql3 = "INSERT INTO spmembership (spMembershipName, spMembershipPostlimit, spMembershipDuration, spMembershipAmount,spMembershipIcon,spMembershipDesc ) VALUES ('$txtTitle','$txtPostLimit','$txtDuration','$txtAmount','$txticon','$txtDescription')";
	//echo $sql3; die("------------");
	$result3  = dbQuery($dbConn, $sql3);
		
	}


?> 

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
  <h1>Membership</h1>
</section>

<!-- Main content -->
<section class="content" >
<!-- start any work here. -->
  <form action=" " method="post" enctype="multipart/form-data" >

    <div class="box box-success">
      <div class="box-body">
        <div class="row mg_btm_30">

          <div class="col-md-4 col-sm-4 mg_btm_30">
            <div class="form-group">
              <label>Title:</label>
                <input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required" value="" />
            </div>
          </div>
          <div class="col-md-4 col-sm-4 mg_btm_30">
            <div class="form-group">
              <label>Post Limit:</label>
                <input type="text" name="txtPostLimit" id="txtPostLimit" class="form-control" required="required" value="" />
            </div>
          </div>
          <div class="col-md-4 col-sm-4 mg_btm_30">
            <div class="form-group">
              <label>Membership Duration:</label>
                <input type="text" name="txtDuration" id="txtDuration" class="form-control" required="required" value="" />
            </div>
           </div> 

          <div class="col-md-4 col-sm-4 mg_btm_30">
            <div class="form-group">
              <label>Amount</label>
                <input type="text" name="txtAmount" id="txtAmount" class="form-control" required="required" value="" />
             </div>
           </div> 
            <div class="col-md-4 col-sm-4 mg_btm_30">
              <div class="form-group">
                <label>Icon Path</label>
                  <input type="text" name="txticon" id="txticon" class="form-control" required="required" value="" />
              </div>
            </div> 
            <div class="col-md-4 col-sm-4 mg_btm_30">
              <div class="form-group">
                <label>Description</label>
                  <input type="text" name="txtDescription" id="txtDescription" class="form-control" required="required" value="" />
              </div>
            </div> 		
          </div>
        </div>
        <div class="box-footer"> 
          <input type="submit" name="submit" value="Submit" class="btn vd_btn vd_bg-blue finish" /> &nbsp;
          <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
       </div>
    </div>
  </form>

</section><!-- /.content -->
