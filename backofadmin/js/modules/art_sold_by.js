	
	// JavaScript Document
	
	//ADD
	function addArtSoldBy(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyArtSold(artSold){
		window.location.href = 'index.php?view=modify&artSold=' + artSold;
	}
	// Delete Sub variation
	function deleteArtSold(artSold){
		 swal({
			  title: "Do You Want to Delete This Entry?",
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
		         window.location.href = 'processArtSoldBy.php?action=delete&artSold=' + artSold;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});
		/*if (confirm('Do You Want Delete this Art Sold By?')) {
		window.location.href = 'processArtSoldBy.php?action=delete&artSold=' + artSold;
		}*/
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	