
	// JavaScript Document
	function addsubCat(){
		window.location.href = 'index.php?view=add';
	}
	
	// MODIFY
	function modifySubCategory(subCat){
		window.location.href = 'index.php?view=modify&subCat=' + subCat;
	}
	// DELTE
	function deleteSubCategory(subCat){

            
            
     	swal({
			  title: "Do You Want Delete this Sub Category?",
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
			  window.location.href = 'processSubCategory.php?action=delete&subCat=' + subCat;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});






		/*if (confirm('Do You Want Delete this Sub Category?')) {
			window.location.href = 'processSubCategory.php?action=delete&subCat=' + subCat;
		}*/
	}
