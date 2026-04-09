
	// JavaScript Document
	//ADD
	function addArtSize(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifySize(sizeId){
		window.location.href = 'index.php?view=modify&sizeId=' + sizeId;
	}
	//DELETE ART SIZES
	function deleteSize(sizeId){   
		if (confirm('Do You Want to Delete This?')) { 
			window.location.href = 'processArtSize.php?action=delete&sizeId=' + sizeId;
		}
	}
	