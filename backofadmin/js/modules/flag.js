	
	// JavaScript Document
	//ADD
	function detail(catid, flagid){
		window.location.href = 'index.php?view=detail&catid='+catid+'&flagid='+flagid;
	}
	//
	function warPostEnable(id){
		var element = document.getElementById("frmAddMainNav");
		element.classList.remove("hidden");
		$("#whichReason").val(id);
	}
	//show user flag posts
	function flagUser(pid){
		window.location.href = 'index.php?view=userpost&pid='+pid;
	}
	/*
	function  deletetimelineflag(flagid){

		

              swal({
			title: "Are you sure you want Delete?",
			type: "warning",
			confirmButtonClass: "sweet_ok",
			confirmButtonText: "Yes,Delete",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "No",
			showCancelButton: true,
		},
		function(isConfirm) {
			if (isConfirm) {
					$.ajax({
					type: "POST",
					url: "../flag/deleteflag.php",
					cache:false,
					data: {'flagid':flagid},
					success: function(data) {
						//alert(data);
						window.location.reload();
					} 
				});	
			}
		});



			
	}
	
	function  activepost(postid){
		         swal({
			title: "Are you sure you want Active this Post?",
			type: "warning",
			confirmButtonClass: "sweet_ok",
			confirmButtonText: "Yes,Active",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "No",
			showCancelButton: true,
		},
		function(isConfirm) {
			if (isConfirm) {
					$.ajax({
					type: "POST",
					url: "../flag/activepost.php",
					cache:false,
					data: {'postid':postid},
					success: function(data) {
						//alert(data);
						window.location.reload();
					} 
				});	
			}
		});
	}


	function  deactivepost(postid){


		// alert(postid);

		         swal({
			title: "Are you sure you want Deactive this Post?",
			type: "warning",
			confirmButtonClass: "sweet_ok",
			confirmButtonText: "Yes,Deactive",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "No",
			showCancelButton: true,
		},
		function(isConfirm) {
			if (isConfirm) {
					$.ajax({
					type: "POST",
					url: "../flag/deactivepost.php",
					cache:false,
					data: {'postid':postid},
					success: function(data) {
						//alert(data);
						window.location.reload();
					} 
				});	
			}
		});
	}


function postdetail(postid,flagid){

		window.location.href = 'index.php?view=postdetail&postid='+postid+'&flagid='+flagid;
	}


    function userlock(userId){

//alert(userId);
     	swal({
			  title: "Do You Want Lock this User?",
			
			  type: "warning",
			  confirmButtonClass: "sweet_ok",
			  confirmButtonText: "Yes, Lock!",
			  cancelButtonClass: "sweet_cancel",
			  cancelButtonText: "Cancel",
			  showCancelButton: true,
			},
			function(isConfirm) {
			  if (isConfirm) {
			   window.location.href = 'flaguseraction.php?action=lock&userId=' + userId;
			  } 
			});
		
	}



  function userunlock(userId){

//alert(userId);
     	swal({
			  title: "Do You Want Un-Lock this User?",
			
			  type: "warning",
			  confirmButtonClass: "sweet_ok",
			  confirmButtonText: "Yes, Un-Lock!",
			  cancelButtonClass: "sweet_cancel",
			  cancelButtonText: "Cancel",
			  showCancelButton: true,
			},
			function(isConfirm) {
			  if (isConfirm) {
			  window.location.href = 'flaguseraction.php?action=unlock&userId=' + userId;
			  } 
			});


	}


	function deleteRegUser(userId){

      
			swal({
				  title: "Do You Want Delete this User?",
				
				  type: "warning",
				  confirmButtonClass: "sweet_ok",
				  confirmButtonText: "Yes, Delete!",
				  cancelButtonClass: "sweet_cancel",
				  cancelButtonText: "Cancel",
				  showCancelButton: true,
				},
				function(isConfirm) {
				  if (isConfirm) {
				   window.location.href = 'flaguseraction.php?action=delete&userId=' + userId;
				  } 
				});

     }

    function userDetail(userId){
		window.location.href = 'index.php?view=detail&uid=' + userId;
	}
	// DETAIL OF PROFILES
	function singleProfileDetail(userId, pid){
		window.location.href = 'index.php?view=singleprofile&uid='+userId+'&pid='+pid;
	}

	*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	