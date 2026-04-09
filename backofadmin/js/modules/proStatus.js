	
	// JavaScript Document
	
	//ADD
	function addProStatus(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyProStatus(proStatus){
		window.location.href = 'index.php?view=modify&proStatus=' + proStatus;
	}
	// Delete Sub variation
	function deleteProStatus(proStatus){
		swal({
			  title: "Do You Want Delete this Property Status?",
			  /*text: "You Want to Logout!",*/
			  type: "warning",
			  confirmButtonClass: "sweet_ok",
			  confirmButtonText: "Yes, Delete!",
			  cancelButtonClass: "sweet_cancel",
			  cancelButtonText: "Cancel",
			  showCancelButton: true,
			},
			function(isConfirm) {
			  if (isConfirm) {
			   window.location.href = 'processProStatus.php?action=delete&proStatus=' + proStatus;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

		/*if (confirm('Do You Want Delete this Property Status?')) {
		window.location.href = 'processProStatus.php?action=delete&proStatus=' + proStatus;
		}*/
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	