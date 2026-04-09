
	// JavaScript Document
	function addProType(){
		window.location.href = 'index.php?view=add';
	}
	// MODIFY
	function modifyProType(proType){
		window.location.href = 'index.php?view=modify&proType=' + proType;
	}
	// DELTE
	function deleteProType(proType){
		 swal({
			  title: "Do You Want to Delete This Property Type?",
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
			  window.location.href = 'processProType.php?action=delete&proType=' + proType;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

		/*if (confirm('Do You Want Delete this Property Type?')) {
			window.location.href = 'processProType.php?action=delete&proType=' + proType;
		}*/
	}
