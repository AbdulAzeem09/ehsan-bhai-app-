
	// JavaScript Document
	function addJobLevel(){
		window.location.href = 'index.php?view=add';
	}
	// MODIFY
	function modifyJobLvel(jobLvl){
		window.location.href = 'index.php?view=modify&jobLvl=' + jobLvl;
	}
	// DELTE
	function deleteJobLvel(id){
		swal({
			  title: "Do You Want to Delete This Job Level?",
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
			   window.location.href = 'processJobLvl.php?action=delete&id=' + id;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});
		/*if (confirm('Do You Want Delete this?')) {
			window.location.href = 'processJobLvl.php?action=delete&id=' + id;
		}*/
	}
