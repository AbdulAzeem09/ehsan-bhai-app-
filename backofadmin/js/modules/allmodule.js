
	// JavaScript Document
	// show user detail of all information
	function postDetail(postid){
		window.location.href = 'index.php?view=detail&postid=' + postid;
	}
	// DETAIL OF PROFILES
	function singleProfileDetail(userId, pid){
		window.location.href = 'index.php?view=singleprofile&uid='+userId+'&pid='+pid;
	}
	// POST BLOCK FOR USER
	function postBlock(postid){
		window.location.href = 'index.php?view=block&postid=' + postid;
	}
	// POST UN-BLOCK FOR USER
	function postUnBlock(postid){
		window.location.href = 'processPosting.php?action=unblock&postid=' + postid;
	}


function deleteAnnouncement(id){ 
//alert('=====');
 
//alert(window.location.href);

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
			   window.location.href = '/backofadmin/channelrequest/index.php?view=delAnnouncement&id=' + id;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

	}
	
	
function deleteWorldnews(id){        
//alert(window.location.href);
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
			   window.location.href = '/backofadmin/channelrequest/index.php?view=deletechannels&id=' + id;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

	}
	
	
	