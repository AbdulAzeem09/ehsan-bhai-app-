	
	// JavaScript ALL CONTENT
	// ADD 
	function addProfileContent(){
		window.location.href = 'index.php?view=add';
	}
	// MODIFY
	function modifyContnt(contId){
		window.location.href = 'index.php?view=modify&contId=' + contId;
	}
	// ========HIRE AN EMPLOYEE
	function addHireEmpContent(){
		window.location.href = 'index.php?view=add';
	}


	// ========HIRE AN LOOKING FOR A JOB
	function addlokingJobContent(){
		window.location.href = 'index.php?view=add';
	}
	
	// ==========MAKE FOR ALL CONTENT EQUAL===============================
	// ====ADD
	function add(){
		window.location.href = 'index.php?view=add';
	}
	function modify(pageId){
		window.location.href = 'index.php?view=modify&pageId=' + pageId;
	}


function deleteB_Listings(id){
           	swal({
			  title: "Do You Want to Delete This Item?",
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
			   window.location.href = 'deletepic1.php?postid=' + id;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

	}

	function deleteB_Sale(id){
		swal({
	   title: "Do You Want to Delete This Item?",
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
		window.location.href = id;
	   } else {
		// swal("Cancelled", "You canceled)", "error");
	   }
	 });

}

