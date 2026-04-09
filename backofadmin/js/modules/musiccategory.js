	
	// JavaScript Document
	//ADD
	function addMusicCat(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyMusic(musicCatId){
		window.location.href = 'index.php?view=modify&musicCatId=' + musicCatId;
	}
	// Delete
	function deleteMusic(musicCatId){
		if (confirm('Do You Want Delete this Music Category?')) {
		window.location.href = 'processeventcat.php?action=delete&musicCatId=' + musicCatId;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	