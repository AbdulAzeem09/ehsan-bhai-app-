
	// JavaScript Document
	function addProductStatus(){
		window.location.href = 'index.php?view=add';
	}
	
	// MODIFY
	function modifyStatus(proStatus){
		window.location.href = 'index.php?view=modify&proStatus=' + proStatus;
	}
	// DELTE
	function deleteStatus(id){

           	swal({
			  title: "Do You Want to Delete This?",
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
			    window.location.href = 'processProStatus.php?action=delete&id=' + id;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});


	/*function deleteStatus(id){
		if (confirm('Do You Want Delete this?')) {
			window.location.href = 'processProStatus.php?action=delete&id=' + id;
		}*/
	}
