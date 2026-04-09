<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
	if (isset($_GET['id']) && $_GET['id'] > 0) {
		$id = $_GET['id'];
	}else {
		// redirect to index.php if user id is not present
		redirect('index.php');
	}
	$sql = "SELECT * FROM spmembership WHERE idspMembership = $id";
	$result = dbQuery($dbConn, $sql) ;
	$row    = dbFetchAssoc($result);
	extract($row);
?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
  <h1>Modify Membership</h1>
</section>
<!-- Main content -->
<section class="content" >
  <!-- start any work here. -->
  <form action="process.php?action=modify" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" onsubmit="return validate(this)">
    <input type="hidden" name="hidId" id="hidId"  value="<?php echo $id;?>"/>
    <div class="box box-success">
      <div class="box-body">
        <div class="row mg_btm_30">

          <div class="col-md-4 col-sm-4 mg_btm_30">
            <div class="form-group">
             <label>Title:</label>
						 		<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required" value="<?php echo $spMembershipName;?>" />
            </div>
           </div>
           <div class="col-md-4 col-sm-4 mg_btm_30">
             <div class="form-group">
               <label>Post Limit:</label>
                 <input type="text" name="txtPostLimit" id="txtPostLimit" class="form-control" required="required" value="<?php echo ($spMembershipPostlimit == 0)?"Unlimited":$spMembershipPostlimit;;?>" />
             </div>
            </div>
            <div class="col-md-4 col-sm-4 mg_btm_30">
              <div class="form-group">
                <label>Membership Duration:</label>
                  <input type="text" name="txtDuration" id="txtDuration" class="form-control" required="required" value="<?php echo $spMembershipDuration;?>" />
              </div>
             </div> 
             <div class="col-md-4 col-sm-4 mg_btm_30">
               <div class="form-group">
                 <label>Amount</label>
                   <input type="text" name="txtAmount" id="txtAmount" class="form-control" required="required" value="<?php echo ($spMembershipAmount == 0)? "-": $spMembershipAmount;?>" />
               </div>
            </div> 
						
            <div class="col-md-4 col-sm-4 mg_btm_30">
              <div class="form-group">
                <label>Icon Path</label>
                  <input type="text" name="txticon" id="txticon" class="form-control" required="required" value="<?php echo $spMembershipIcon;
?>" />
             </div>
           </div> 
           <div class="col-md-4 col-sm-4 mg_btm_30">
             <div class="form-group">
               <label>Description</label>
                 <input type="text" name="txtDescription" id="txtDescription" class="form-control" required="required" value="<?php echo $spMembershipDesc;?>" />
             </div>
           </div> 
         </div>
       </div>
       <div class="box-footer"> 
         <input type="submit" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
         <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
      </div>
     </div>
   </form>

</section><!-- /.content -->
		
