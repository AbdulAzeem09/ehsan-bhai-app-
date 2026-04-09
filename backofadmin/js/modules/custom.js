	
	// JavaScript ALL CONTENT
	// ADD 
	function add(){
		window.location.href = 'index.php?view=add';
	}
	// MODIFY
	function modify(ID){
		window.location.href = 'index.php?view=modify&id=' + ID;
	}
	// DELETE
	function deletePost(id){
		if (confirm('Do You Want Delete this?')) {
			window.location.href = 'process.php?action=delete&id=' + id;
		}
	}


	function deletee(id){
		     	swal({
  title: "Do You Want to Delete This Banner?",
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
   window.location.href = 'processContent.php?action=delete&noteId=' + id;
  } 
});
	}

function delete_nft(id){
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
   window.location.href = '/backofadmin/nft/process.php?action=delete&id=' + id;
  } 
});
	}
function update_nft(id){
		     	swal({
  title: "Do You Want to Update This Item?",
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
   window.location.href = '/backofadmin/nft/index.php?view=edit&id=' + id;
  } 
});
	}


	
