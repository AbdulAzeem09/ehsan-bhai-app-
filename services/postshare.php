<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" /> 
</head>
<?php 

  $postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
	//die("==========");
	$pic = new _classifiedpic;
	//$post_id=$_GET['postid'];
	$res = $pic->readFeature($postid);
	if($res){
	$postr = mysqli_fetch_assoc($res);
	$picture = $postr['spPostingPic'];
	}
?>
	<div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content no-radius">
				<form action="../social/shareServic.php" method="POST" class="sharestorepos">
					<div class="modal-header">
						<h4 class="modal-title">Share this service</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				 	<div class="modal-body sharedimage">
				 		<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
						<input type="hidden" id="shareposting" name="spPostings_idspPostings" value="">
						
						<div class="row">
							<div class="col-md-6">
							
								<div class="dropdown">
								<label>222 Choose Source</label>
								<span id="shareError1" style="color:red;"></span>
								  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										Select group or friend
										<span class="caret"></span>
								  	</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownShare">
										<li id="groupshare" class="sppointer sharedd"><a href="#">Share in a group</a></li>
										<li id="friendshare" class="sppointer sharedd"><a href="#">Share to a friend</a></li>
									</ul>
								</div>
							</div>
							<!-- <div class="col-md-6  hidden" id="groupshow">
								<div class="">
									<input type="hidden" id="spgroupshareid" name="spShareToGroup" value="">
									<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
								</div>
							</div> -->
							<div class="col-md-6 group-select-block hidden" id="groupshow">
							<div class="form-group">
								<label>Select Group</label> <span id="shareError2" style="color:red;">*</span>
								<select class="select3 form-control" name="spShareToGroup[]" id="groupSelect" multiple >
									 <option value=""></option>
								</select>
							</div>
						</div>
								
								 <div class="col-md-6 friend-select-block hidden" id="profileshow">
							<div class="form-group">
								<label>Select Friend</label> <span id="shareError3" style="color:red;">*</span>
								<select class="select2 form-control" name="spShareToWhom[]" id="friendSelect" multiple >
									 <option value="" ></option>
								</select>
							</div>
						</div>
								
							<!-- <div class="col-md-6 hidden" id="profileshow">
								<div class="">
									<input type="hidden" id="spfriendshareid" name="spShareToWhom" value="">
									<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
								</div>
							</div> -->
							<div class="col-sm-12">
							 <span id="shareError" style="color:red;"></span>
								<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">

							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-3 col-md-6">
								<!-- <img id="modalpostingpic" src="../img/no.png" alt="Posting Pic" class="img-rounded img-thumbnail" /> -->
								<?php 
								echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
							 ?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-offset-3 col-md-8">

<table class="table table-borderless" style="">
 
  <tbody>
    <tr>
      <td style="border: 0px;width: 43%;"><label>Ad Name:</label></td>
      <td style="border: 0px;text-align: left;"><?php echo $ProTitle; ?></td>
    </tr>
	<!-- tr>
      <td style="border: 0px;width: 43%;"><label>Date Posted:</label></td>
      <td style="border: 0px;text-align: left;"><?php echo $PostingDate; ?></td>
    </tr>
    <tr>
      <td style="border: 0px;width: 43%;"><label>Postal Code:</label></td>
      <td style="border: 0px;text-align: left;"><?php echo $postalCod; ?></td>
    </tr>
    <tr>
      <td style="border: 0px;width: 43%;"><label>Country:</label></td>
      <td style="border: 0px;text-align: left;"><?php echo $countryTitle; ?></td>
    </tr>
	<tr>
      <td style="border: 0px;width: 43%;"><label>State:</label></td>
      <td style="border: 0px;text-align: left;"><?php echo $stateTitle; ?></td>
    </tr>
	<tr>
      <td style="border: 0px;width: 43%;"><label>City:</label></td>
      <td style="border: 0px;text-align: left;"><?php echo $cityTitle; ?></td>
    </tr -->
  </tbody>
</table>

 
				 </div>

				
				</div>
				
				  	</div>
				  	<div class="modal-footer">
						<button type="" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="submit" id="share" class="btn btn-primary">Share</button>
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
                
                	if (!data.term) {
                		data.term = '';
                	}
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {

                	debugger;
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


                	let data=JSON.parse(response);
                	
                    return {
                        results: data,
                        more: false
                    };
                },
                cache: true
            }
        });
</script>
