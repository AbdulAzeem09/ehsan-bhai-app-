

	// JavaScript Document
	//ADD
	function addEventCat(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyEventCat(eventCatId){
		window.location.href = 'index.php?view=modify&eventCatId=' + eventCatId;
	}
	// Delete
	function deleteEventCat(eventCatId){
		if (confirm('Do You Want Delete this Event Category?')) {
			window.location.href = 'processEventCat.php?action=delete&eventCatId=' + eventCatId;
		}
	}

	///Delete group cat
    function deleteGroupCat(eventCatId){
        if (confirm('Do You Want Delete this Event Category?')) {
            window.location.href = 'processgroupcat.php?action=delete&eventCatId=' + eventCatId;
        }
    }
	
function delete_event_cat(eventCatId){
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
		     window.location.href = '?action=delete&id=' + eventCatId;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

		/*if (confirm('Do You Want Delete this Frame Type?')) {
		window.location.href = 'processFramType.php?action=delete&framType=' + framType;
		}*/
	} 

function delete_event_group(eventGroupId){
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
		     window.location.href = 'processEventGroup.php?action=delete&idspeventgr=' + eventGroupId;
			  } else {
			   // swal("Cancelled", "You canceled)", "error");
			  }
			});

		/*if (confirm('Do You Want Delete this Frame Type?')) {
		window.location.href = 'processFrameType.php?action=delete&framType=' + framType;
		}*/
	}

