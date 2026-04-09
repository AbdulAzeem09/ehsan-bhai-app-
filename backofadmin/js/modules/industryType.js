
	// JavaScript Document
	function addIndustryType(){
		window.location.href = 'index.php?view=add';
	}
	
	// MODIFY
	function modifyIndustryType(indType){
		window.location.href = 'index.php?view=modify&indType=' + indType;
	}
	// DELTE
	function deleteIndustryType(indType){

           	swal({
			  title: "Do You Want to Delete This Industry Type?",
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
			   window.location.href = 'processIndustryType.php?action=delete&indType=' + indType;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});




		/*if (confirm('Do You Want Delete this Industry Type?')) {
			window.location.href = 'processIndustryType.php?action=delete&indType=' + indType;
		}*/
	}
