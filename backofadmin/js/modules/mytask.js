
	// JavaScript Document
	
	// Approve
	function approveTask(notesId){
		window.location.href = 'processMyTask.php?action=approve&notesId=' + notesId;
	}
	//VIEW DETAIL
	function detailTask(noteId){
		window.location.href = 'index.php?view=detail&noteId=' + noteId;
	}
	//START WORKING
	function workingTask(notesId){
		window.location.href = 'processMyTask.php?action=startWork&notesId=' + notesId;
	}
	//COMPLETE WORKING
	function closeWorkingTask(notesId){
		window.location.href = 'processMyTask.php?action=closeWork&notesId=' + notesId;
	}

function deletesppoint(notesId){
		swal({
			  title: "Do You Want to Delete This Item?",
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
		     window.location.href = 'processPoints.php?action=delete&idspPoint=' + notesId;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

		/*if (confirm('Do You Want Delete this Frame Type?')) {
		window.location.href = 'processFrameType.php?action=delete&framType=' + framType;
		}*/
	}
