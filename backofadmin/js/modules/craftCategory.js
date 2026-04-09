function addArtCat(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyCraft(CraftCat){
		window.location.href = 'index.php?view=modify&CraftCat=' + CraftCat;
	}
	//DELETE 
	function deleteCraft(CraftCat){
		if (confirm('Do You Want Delete this Category?')) {
			window.location.href = 'processCraftCat.php?action=delete&CraftCat=' + CraftCat;
		}
	}