

	// JavaScript Document
function addUser(){
	console.log('addUser');
	window.location.href = 'index.php?view=add';
}
	function deleteRegUser(userId){

      
     	swal({
  title: "Do You Want to Delete The Selected User?",
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
   window.location.href = 'processRegUser.php?action=delete&userId=' + userId;
  } 
});
	}

	// Reactive User

	function userReactive(userId){

      
		swal({
 title: "Do You Want to Reactive The Selected User?",
 /*text: "You Want to Logout!",*/
 type: "warning",
 confirmButtonClass: "sweet_ok",
 confirmButtonText: "Yes, Reactive!",
 cancelButtonClass: "sweet_cancel",
 cancelButtonText: "Cancel",
 showCancelButton: true,
},
function(isConfirm) {
 if (isConfirm) {
  window.location.href = 'processRegUser.php?action=reactive&userId=' + userId;
 } 
});
   }

   // Permanent Delete

   function permanentDelete(userId){

      
	swal({
title: "Do You Want to Permanent Deleted The Selected User?",
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
window.location.href = 'processRegUser.php?action=PerDeleted&userId=' + userId;
} 
});
}
	
	function activateRegUser(userId){

      
     	swal({
  title: "Do You Want To Activate this User?",
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
   window.location.href = 'processRegUser.php?action=activate&userId=' + userId;
  } 
});
	}

	// show user detail of all information
	function userDetail(userId){
		window.location.href = 'index.php?view=detail&uid=' + userId;
	}

	// show user detail of all information
	function userDetail(userId){
		window.location.href = 'index.php?view=detail&uid=' + userId;
	}
	// DETAIL OF PROFILES
	function singleProfileDetail(userId, pid){
		window.location.href = 'index.php?view=singleprofile&uid='+userId+'&pid='+pid;
	}
	// USER LOCK FUNCTION
	/*function userlock(userId){
		if (confirm('Do You Want Lock this User?')) {
			window.location.href = 'processRegUser.php?action=lock&userId=' + userId;
		}
	}*/

     function userlock(userId){

var base_url = window.location.origin;
//alert(base_url);
//alert(userId);
     	swal({
  title: "Do You Want To Lock this User?",
  /*text: "You Want to Logout!",*/
  type: "warning",
  confirmButtonClass: "sweet_ok",
  confirmButtonText: "Yes, Lock!",
  cancelButtonClass: "sweet_cancel",
  cancelButtonText: "Cancel",
  showCancelButton: true,
},
function(isConfirm) {
  if (isConfirm) {
  window.location.href = 'processRegUser.php?action=lock&userId=' + userId;
  } else {
   // swal("Cancelled", "You canceled)", "error");
  }
});
		
	}



	// USER UNLOCK FUNCTION 
	/*function userunlock(userId){
		if (confirm('Do You Want Un-Lock this User?')) {
			window.location.href = 'processRegUser.php?action=unlock&userId=' + userId;
		}
	}*/

    function userunlock(userId){


     	swal({
  title: "Do You Want To Un-Lock this User?",
  /*text: "You Want to Logout!",*/
  type: "warning",
  confirmButtonClass: "sweet_ok",
  confirmButtonText: "Yes, Un-Lock!",
  cancelButtonClass: "sweet_cancel",
  cancelButtonText: "Cancel",
  showCancelButton: true,
},
function(isConfirm) {
  if (isConfirm) {
  window.location.href = 'processRegUser.php?action=unlock&userId=' + userId;
  } else {
   // swal("Cancelled", "You canceled)", "error");
  }
});


	}


	// SORT BY USER ASC/DESC
	$("#sortBy").on("change", function () {
		var sortyBy = this.value;
		window.location.href = 'index.php?view=list&orderby='+sortyBy;
	});
	// SORT BY USER ACTIVE/IN-ACTIVE
	$("#userBy").on("change", function () {
		var userBy = this.value;
		window.location.href = 'index.php?view=list&useryby='+userBy;
	});
	// SEARCH BY DUPLICATE ID AND MOST POSTED
	$("#searchBy").on("change", function () {
		var searchBy = this.value;
		if(searchBy != 0){
			window.location.href = 'index.php?view=list&searchby='+searchBy;
		}else{
			window.location.href = 'index.php?view=list';
		}
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
