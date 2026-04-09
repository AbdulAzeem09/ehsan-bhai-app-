<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['Id']) && ($_GET['Id']) > 0){
		$faqId  = $_GET['Id'];
	}else {
		redirect('index.php');
	}

	$sql = "SELECT * FROM store_faq WHERE id ='$faqId'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	<script type="text/javascript" src="<?php echo WEB_ROOT_ADMIN; ?>fckeditor/fckeditor.js"></script>
	
	<script type="text/javascript">		
		window.onload = function(){
			// Automatically calculates the editor base path based on the _samples directory.
			// This is usefull only for these samples. A real application should use something like this:
			// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
			var sBasePath = '../../fckeditor/' ;
			var oFCKeditor = new FCKeditor( 'txtDesc' ) ;
			oFCKeditor.BasePath	= sBasePath ;
			oFCKeditor.ReplaceTextarea() ;
		}
	</script>

	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Modify FAQ Page Content</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processContent.php?action=modify"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $faqId;?>"/>
            
			<div class="box box-success">
				<div class="box-body">
					<div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
						<?php 
						if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
							if($_SESSION['count'] <= 1){
								$_SESSION['count'] +=1; ?>
								<div style="min-height:10px;"></div>
								<div class="alert alert-<?php echo $_SESSION['data'];?>">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php echo $_SESSION['errorMessage'];  ?>
								</div> <?php
								unset($_SESSION['errorMessage']);
							}
						} ?>
					</div>
						<div class="row">

						<div class="col-md-8" style="margin-bottom:20px;">
							<label>Question: <span class="red">*</span></label><span id="question_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span></br>
							
	<input type="text" class="form-control" name="faq_question" id="faq_question" onkeyup="keyupFAQfun()" value="<?php echo $spfaq_question; ?>">
							
						</div>
			        	</div>		
				<div class="row">

						<div class="col-md-8" style="margin-bottom:20px;">
							<label>Answer: <span class="red">*</span> </label> <span id="answer_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span></br>

							<textarea class="form-control" rows="8" cols="80" name="faq_answer" id="faq_answer" onkeyup="keyupFAQfun()" maxlength="500" value="<?php echo $spfaq_answer; ?>"><?php echo $spfaq_answer; ?></textarea>
						</div>
						                    
					</div>
                 

				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish"  id="Submitfaq" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>

		
		<script type="text/javascript">
			
$(document).ready(function() {
  //alert();
  $('#Submitfaq').click(function() {
  

  //alert();

var faq_question = $('#faq_question').val();

var faq_answer = $('#faq_answer').val();



if (faq_question == "" && faq_answer == "") {
 $("#question_error").text("Please Enter Your Question.");
   $("#faq_question").focus();

 $("#answer_error").text("Please Enter Your Answer.");
             $("#faq_answer").focus();

  return false;
}
else if (faq_question == "") {
  $("#question_error").text("Please Enter Your Question.");
             $("#faq_question").focus();
  return false;
  } 
else if (faq_answer == "") {
  $("#answer_error").text("Please Enter Your Answer.");
             $("#faq_answer").focus();
  return false;
  } 
else {
$("#frmAddMainNav").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
});

       

function keyupFAQfun() {

  //alert();

var faq_question = $('#faq_question').val();

var faq_answer = $('#faq_answer').val();
//alert(category);
 //alert(category.length);

   if(faq_question != "")
  {
    $('#question_error').text(" ");
    
  }
 
   if(faq_answer != "" )
  {
    $('#answer_error').text(" ");
    
  }

  
  }

</script>
	</section><!-- /.content -->
		