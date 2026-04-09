	
	// JavaScript Document
	//ADD
	function addCat(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyRecord(rss_id){
		window.location.href = 'index.php?view=modify&rss_id=' + rss_id;
	}
	// Delete variation
	function deleteRecord(rss_id){
		if (confirm('Do You Want Delete this Record?')) {
		window.location.href = 'processRSS.php?action=delete&rss_id=' + rss_id;
		}
	}


		function deleteCraft(catId){
		if (confirm('Do You Want Delete this Craft?')) {
		window.location.href = 'processCraftCat.php?action=delete&catId=' + catId;
		}
	}
	
	