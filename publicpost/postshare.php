
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

    
</head>
<style>
.btn:hover {
    color: #f9f4f4!important;
    opacity: 0.8;
}
.db_btn {
   
    border-radius: 10px!important;
}


</style>




<div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content no-radius bradius-15 bg-white">
			<form action="../social/share-timeline.php" method="POST" class="">  
				<div class="modal-header br_radius_top bg-white">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title">Share Post</h4>
					
				</div>
				
			 	<div class="modal-body sharedimage">
			 		<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
					<input type="hidden" id="shareposting" name="spPostings_idspPostings">
					<input type="hidden" id="shareTimelinePost" name="timelineid">
					<div class="row">
						<div class="col-md-6">
						<label>Choose Source<span style="color:red;">*</span></label>
							<div class="dropdown" id="drop1" name="drop2">
							
							  	<button class="btn btn-default dropdown-toggle form-control" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Select group or friend 
									<span class="caret"></span>
							  	</button>
								<span id="error_group" style="color:red;"></span>
							  	<ul class="dropdown-menu" aria-labelledby="dropdownShare">
									<li id="groupshare" class="sppointer sharedd"><a href="#">Share with a group</a></li>
									
									<li id="friendshare" class="sppointer sharedd"><a href="#">Share with a friend</a>
									</li>
							  	</ul>
							</div>
						</div>
						<input type="hidden" value="error" id="checkingtoggle">
						<!-- <div class="col-md-12" id="groupshow">
							<div class="form-group">
								<label>Select Group</label>
								<input type="hidden" class="form-control" id="spgroupshareid" name="spShareToGroup">
								<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
							</div>
						</div> -->
					
						<div class="col-md-6 group-select-block hidden" id="groupshow">
							<div class="form-group">
								<label>Select Group <span style="color:red;">*</span></label>
								<!-- <span id="error_us" style="color:red;"></span> -->
								<select class="select3 form-control" name="spShareToGroup[]" id="groupSelect" multiple  >
									 <option value=""></option>
								</select>
							</div>
						</div>
					
						<!-- <div class="col-md-5 hidden" id="profileshow">
							<div class="form-group">
								<input type="hidden" id="spfriendshareid" name="spShareToWhom">
								<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
							</div>
						</div> -->
					
						<div class="col-md-6 friend-select-block hidden" id="profileshow">
							<div class="form-group">
								<label>Select Friend <span style="color:red;">*</span></label>
								<!-- <span id="error_ur" style="color:red;"></span> -->
								<select class="select2 form-control" name="spShareToWhom[]" id="friendSelect" multiple >
									 <option value=""></option>
								</select>
							</div>
						</div>
					
						<div class="col-md-12">
							<div class="form-group">
								<label style="padding:5px;margin-top:20px;">Say something about this<span style="color:red;"> </span></label>
								<span id="sayfield" style="color:red;margin: -5px;"></span>
								<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
							</div>
						</div>
							
					</div>
					
			  	</div>
			  	<div class="modal-footer br_radius_bottom bg-white">
					<button type="" class="btn btn-danger db_btn db" data-dismiss="modal"><span>Close</span></button>
					<!--<button type="submit" id="share"  class="btn btn-primary db_btn db_primarybtn">Share</button>-->
					<button type="submit" id="share" class="btn btn-primary db_btn db_primarybtn" >Share</button>
			  	</div>
			</form>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" ></script>
<script type="text/javascript">
	$(".select2").select2();
	$(".select3").select2();
 
	 $('#friendSelect').select2({
            placeholder: "Select Friends",
            multiple: true,
            width:'100%',
            ajax: {
                url: '../mlayer/findFriend.php',
                datatype:"json",
                data: function (data) {
					console.log(data);
                	if (!data.term) {
                		data.term = '';
						
                	}
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {

					$('#checkingtoggle').val("");
                	let data=JSON.parse(response);
                	
                    return {
                        results: data,
                        more: false
                    };
                },
                cache: true
            }
			
        });

	 $('#groupSelect').select2({
            placeholder: "Select Groups",
            multiple: true,
            width:'100%',
            ajax: {
                url: '../mlayer/findGroup.php',
                datatype:"json",
                data: function (data) {
                	if (!data.term) {
                		data.term = '';
                	}
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {

					$('#checkingtoggle').val("");
                	let data=JSON.parse(response);
                	
                    return {
                        results: data,
                        more: false
                    };
                },
                cache: true
            }

			

        });
		 


		 $('#share').on('click',function(){
		 	var aa=$('#aboutshare').val();
			 var bb=$('#checkingtoggle').val();
			if(bb != ''){
				//$('#error_group').html('This field is required1111');
				swal("Please Choose Required Fields");

		 		return false;
			}
         else if(aa==''){
		// 	$('#error_group').html('');
	    //  $('#sayfield').html('This field is required22');
		//  		return false;
        }
			else{
				return true;
			}
			
		 	
			
		 });

		//  $('#share').on('click',function(){
		//  	 var aa=$('#groupSelect').val();
		// 	if(aa != ''){
		// 		$('#error_us').html('This field is required');
		//  		return false;
		// 	}
       	
			
			
		//  });

		//  $('#share').on('click',function(){
		// 	 var bb=$('#friendSelect').val();
		// 	if(bb != ''){
		// 		$('#error_ur').html('This field is required');
		//  		return false;
		// 	}
         
			
			
		 	
			
		// });

		
		
		
		
		
		
			
		
		/*$('#share').on('click',function(){
			if(drop2=='Share with a group'){
				var bb=$('#groupSelect').val();
				if(bb!='')
				{
					alert('okk');
				}
				else{
					alert('not okk');
					return false;
				}
					
			}
			else{
				var cc=$('#friendSelect').val();
				if(cc!='')
				{
					alert('okk');
				}					
				else{
					alert('not okk');
					return false;
				}
				
			}
			
			
			
		});*/
		
</script>

