<div class="modal fade" id="mailto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Share by Mail</h4>
      </div>
	   <form action="../publicpost/mailto.php" method="post">
			<div class="emaildetails"><!--add dynamic post details--></div>
		
			<input type='hidden' id='shareprofile' value='<?php echo $_SESSION['myprofile'];?>' name='profilename'>
	   
		  <div class="modal-body">
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Recipient</label>
				<input type="email" class="form-control" id="recipientemail" placeholder="Type recipient email..." name="recipientemail">
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" id="emailwith" class="btn btn-primary">Share</button>
		  </div>
	   </form>
    </div>
  </div>
</div>