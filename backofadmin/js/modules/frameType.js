	
	// JavaScript Document
	
	//ADD
	function addFrameType(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyFramType(framType){
		window.location.href = 'index.php?view=modify&framType=' + framType;
	}
	// Delete Sub variation
	function deleteFramType(framType){
		swal({
			  title: "Do You Want to Delete This Frame Type?",
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
		     window.location.href = 'processFrameType.php?action=delete&framType=' + framType;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

		/*if (confirm('Do You Want Delete this Frame Type?')) {
		window.location.href = 'processFrameType.php?action=delete&framType=' + framType;
		}*/
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	