
	// JavaScript Document
	function addFreeProType(){
		window.location.href = 'index.php?view=add';
	}
	// MODIFY
	function modifyFreeProType(proType){
		window.location.href = 'index.php?view=modify&proType=' + proType;
	}
	// DELTE
	function deleteFreeProType(proType){
	   swal({
			  title: "Do You Want to Delete This Profile Type?",
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
		        	window.location.href = 'processFreeProType.php?action=delete&proType=' + proType;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});
         
		/*if (confirm('Do You Want Delete this Profile Type?')) {
			window.location.href = 'processFreeProType.php?action=delete&proType=' + proType;
		}*/
	}
