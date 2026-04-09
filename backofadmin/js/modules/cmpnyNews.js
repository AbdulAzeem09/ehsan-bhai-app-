	
	// JavaScript Document
	// BAN NEWS
	function banCmpnyNews(idCmpnyNews){
		window.location.href = 'index.php?view=ban&idCmpnyNews=' + idCmpnyNews;
	}
	// Delete
	function deleteCmpnyNews(idCmpnyNews){

		swal({
			title: "Do You Want Delete this Company News?",
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
				window.location.href = 'processCmpnyNews.php?action=delete&idCmpnyNews=' + idCmpnyNews;
			} else {
			 // swal("Cancelled", "You canceled)", "error");
			}
		  });
	}
	// ACTIVE NEWS BACK
	function activeCmpnyNews(id){
		if (confirm('Do You Want Active this Company News?')) {
			window.location.href = 'processCmpnyNews.php?action=active&id='+id;
		}
	}
	// DETAIL
	function detailCmpnyNews(id){
		window.location.href = 'index.php?view=detail&id='+id;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	