	
	
	
	function deleteContact(conId){
		if (confirm('Do You Want to Delete this Contact Us?')) {
		window.location.href = 'processfeedback.php?action=delete&conId=' + conId;
		}
	}
	
	// Reply Email Individual
	function replyContact(conId){
		window.location.href = 'index.php?view=replyemail&ConId=' + conId;
	}
	// Reply Email Individual
	function detailContact(id){
		window.location.href = 'index.php?view=detail&id=' + id;
	}