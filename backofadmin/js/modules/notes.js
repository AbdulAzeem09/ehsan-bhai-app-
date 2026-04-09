	
	// JavaScript STICKY NOTES
	// ADD 
	function addNotes(){
		window.location.href = 'index.php?view=add';
	}
	// APPROVE THE NOTES
	function appNotes(noteId){
		swal({
			title: "Do You Want Approved this Notes?",
			/*text: "You Want to Logout!",*/
			type: "warning",
			confirmButtonClass: "sweet_ok",
			confirmButtonText: "Yes, Approved!",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "Cancel",
			showCancelButton: true,
		  },
		  function(isConfirm) {
			if (isConfirm) {
				window.location.href = 'processNotes.php?action=approve&noteId=' + noteId;
			} else {
			 // swal("Cancelled", "You canceled)", "error");
			}
		  });

		
	}
	// REJECTED THE NOTES
	function rejNotes(noteId){
		window.location.href = 'processNotes.php?action=reject&noteId=' + noteId;
	}

	// Delete
	function deleteNotes(noteId){

     	swal({
			  title: "Do You Want Delete this Notes?",
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
			  window.location.href = 'processNotes.php?action=delete&noteId=' + noteId;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

		/*if (confirm('Do You Want Deleteaaa this Notes?')) {
			window.location.href = 'processNotes.php?action=delete&noteId=' + noteId;
		}*/
	}


	// MODIFY
	function modifyNotes(noteId){
		window.location.href = 'index.php?view=modify&noteId=' + noteId;
	}
	//VIEW DETAIL
	function viewNotes(noteId){
		window.location.href = 'index.php?view=detail&noteId=' + noteId;
	}
	
	