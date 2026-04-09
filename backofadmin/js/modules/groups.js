	
	// JavaScript Document
	
	// Delete GROUP
	function deleteGroup(groupId){
		if (confirm('Do You Want to Delete this Group?')) {
			window.location.href = 'processGroup.php?action=delete&groupId=' + groupId;
		}
	}
	// GROUP DETAIL
	function detailGroup(id){
		window.location.href = 'index.php?view=detail&id=' + id;
	}
	// BAN GROUP
	function banGroup(id){
		if (confirm('Do You Want Ban this Group?')) {
			window.location.href = 'processGroup.php?action=ban&id='+id;
		}
	}
	// UNLOCK GROUP
	function unlockGroup(id){
		if (confirm('Do You Want Un-lock this Group?')) {
			window.location.href = 'processGroup.php?action=unlock&id='+id;
		}
	}
	// BAN GROUP CATEGORY
	function ban_c(id){

          swal({
			  title: "Do You Want Deactivate this Group Category?",
			  /*text: "You Want to Logout!",*/
			  type: "warning",
			  confirmButtonClass: "sweet_ok",
			  confirmButtonText: "Yes, Deactivate!",
			  cancelButtonClass: "sweet_cancel",
			  cancelButtonText: "Cancel",
			  showCancelButton: true,
			},
			function(isConfirm) {
			  if (isConfirm) {
			 window.location.href = 'processGroup.php?action=ban_c&id='+id;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});


		/*if (confirm('Do You Want Ban this Group?')) {
			window.location.href = 'processGroup.php?action=ban_c&id='+id;
		}*/
	}
	// UNLOCK GROUP CATEGORY
	function unlock_c(id){
           
          swal({
			  title: "Do You Want Activate this Group Category?",
			  /*text: "You Want to Logout!",*/
			  type: "warning",
			  confirmButtonClass: "sweet_ok",
			  confirmButtonText: "Yes, Activate!",
			  cancelButtonClass: "sweet_cancel",
			  cancelButtonText: "Cancel",
			  showCancelButton: true,
			},
			function(isConfirm) {
			  if (isConfirm) {
			window.location.href = 'processGroup.php?action=unlock_c&id='+id;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});


		/*if (confirm('Do You Want Un-lock this Group?')) {
			window.location.href = 'processGroup.php?action=unlock_c&id='+id;
		}*/
	}
	
	
	//MODIFY
	function modifyCategory1(id){
		window.location.href = 'index.php?view=modify&id=' + id;
	}
	
	// Delete GROUP category
	function deleteGroup1(id){


     
     	swal({
			  title: "Do You Want to Delete this Group Category?",
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
			  window.location.href = 'processGroup.php?action=delete1&id=' + id;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

/*
if (confirm('Do You Want Delete this Groupcategory?')) {
			window.location.href = 'processGroup.php?action=delete1&id=' + id;
		}

*/

		
	}












	
	
	
	
	
	
	
	
	
	
	
	