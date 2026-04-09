
	// JavaScript Document
	function addShippingDest(){
		window.location.href = 'index.php?view=add';
	}
	// MODIFY
	function modifyShiping(shipDest){
		window.location.href = 'index.php?view=modify&shipDest=' + shipDest;
	}
	// DELTE
	function deleteShiping(shipDest){
		swal({
			  title: "Do You Want to Delete This Shipping Destination?",
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
			  window.location.href = 'processShipDest.php?action=delete&shipDest=' + shipDest;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});




		/*if (confirm('Do You Want Delete this Shipping Destidnation?')) {
			window.location.href = 'processShipDest.php?action=delete&shipDest=' + shipDest;
		}*/
	}
