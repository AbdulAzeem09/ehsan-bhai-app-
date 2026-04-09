	
	// JavaScript Document
	// DETAIL OF PROFILES
	function singleProfileDetail(userId, pid){
		window.location.href = 'index.php?view=singleprofile&uid='+userId+'&pid='+pid;
	}
	// Delete Category
	function deleteProfile(pid){
		if (confirm('Do You Want Delete this Profile?')) {
		window.location.href = 'processProfile.php?action=delete&pid=' + pid;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	