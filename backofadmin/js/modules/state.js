	
	// JavaScript Document
	//ADD
	function addState(){
		window.location.href = 'index.php?view=add';
	}
	// Delete
	function deleteState(stateId){
		if (confirm('Do You Want Delete this State?')) {
			window.location.href = 'processState.php?action=delete&stateId=' + stateId;
		}
	}
	
	
	