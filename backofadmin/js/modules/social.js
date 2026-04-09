
	// JavaScript Document
	//ADD
	function add(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modify(id){
		window.location.href = 'index.php?view=modify&id=' + id;
	}
	//DELETE ART SIZES
	function deletee(id){
		if (confirm('Do You Want to Delete This Social Media Account?')) {
			window.location.href = 'processSocial.php?action=delete&id=' + id;
		}
	}
	