	
	// JavaScript Document
	//ADD
	function addArtCat(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyCategory(ArtCat){
		window.location.href = 'index.php?view=modify&ArtCat=' + ArtCat;
	}
	//DELETE 
	function deleteCategory(ArtCat){
		if (confirm('Do You Want Delete this Category?')) {
			window.location.href = 'processArtCat.php?action=delete&ArtCat=' + ArtCat;
		}
	}



    function deleteclassificateCategory(subCat){



        swal({
                title: "Do You Want Delete this  Category?",
                /*text: "You Want to Logout!",*/
                type: "warning",
                confirmButtonClass: "sweet_ok",
                confirmButtonText: "Yes, Delete!",
                cancelButtonClass: "sweet_cancel",
                cancelButtonText: "Cancel",
                showCancelButton: true,
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location.href = 'process.php?action=delete&subCat=' + subCat;
                } else {
                    // swal("Cancelled", "You canceled)", "error");
                }
            });






        /*if (confirm('Do You Want Delete this Sub Category?')) {
            window.location.href = 'processSubCategory.php?action=delete&subCat=' + subCat;
        }*/
    }

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	