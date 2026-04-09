	
	// JavaScript Document
	
	//ADD
	function addMusicLang(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyMusicLan(musicLan){
		window.location.href = 'index.php?view=modify&musicLan=' + musicLan;
	}
	// Delete Sub variation
	function deleteMusicLan(musicLan){
		 swal({
			  title: "Do You Want to Delete This Music Language?",
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
		    window.location.href = 'processMusicLang.php?action=delete&musicLan=' + musicLan;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

		/*if (confirm('Do You Want Delete this Music Language?')) {
		window.location.href = 'processMusicLang.php?action=delete&musicLan=' + musicLan;
		}*/
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	