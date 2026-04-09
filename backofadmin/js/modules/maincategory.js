	
	// JavaScript Document
	//ADD
	function addCat(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyCategory(catId){
		window.location.href = 'index.php?view=modify&catId=' + catId;
	}
	// Delete variation
	function deleteCategory(catId){
		if (confirm('Do You Want Delete this Category?')) {
		window.location.href = 'processCategory.php?action=delete&catId=' + catId;
		}


		function deleteCraft(catId){
		if (confirm('Do You Want Delete this Craft?')) {
		window.location.href = 'processCraftCat.php?action=delete&catId=' + catId;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	