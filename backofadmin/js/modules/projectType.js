	
	// JavaScript Document
	
	//ADD
	function addProjectType(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyProjectType(projectIypeId){
		window.location.href = 'index.php?view=modify&projectIypeId=' + projectIypeId;
	}
	// Delete Sub variation
	function deleteProjectType(projectIypeId){
		if (confirm('Do You Want Delete this Project Type?')) {
		window.location.href = 'processprotype.php?action=delete&projectIypeId=' + projectIypeId;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	