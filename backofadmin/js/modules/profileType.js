	
	// JavaScript Document
	// ADD 
	function addProfileType(){
		window.location.href = 'index.php?view=add';
	}
	// MODIFY 
	function modifyProfileType(ptId){
		window.location.href = 'index.php?view=modify&ptId=' + ptId;
	}
	// Delete 
	function deleteProfileType(ptId){
		if (confirm('Do You Want Delete this Profile Type?')) {
		window.location.href = 'processProfileType.php?action=delete&ptId=' + ptId;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	