	
	// JavaScript Document
	//ADD
	function addCountry(){
		window.location.href = 'index.php?view=add';
	}
	// Delete
	function deleteCountry(countryId){
		if (confirm('Do You Want Delete this Country?')) {
			window.location.href = 'processcountry.php?action=delete&countryId=' + countryId;
		}
	}
	
	
	