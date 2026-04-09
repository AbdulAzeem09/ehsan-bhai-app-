	
	// JavaScript ALL CONTENT
	// ADD 
	function addProfileContent(){
		window.location.href = 'index.php?view=add';
	}
	// MODIFY
	function modifyfaq(Id){
		window.location.href = 'index.php?view=modify&Id=' + Id;
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


	function deletee(id){
		     	swal({
  title: "Do You Want to Delete This FAQ?",
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
   window.location.href = 'processContent.php?action=delete&faqId=' + id;
  } 
});
	}


	
