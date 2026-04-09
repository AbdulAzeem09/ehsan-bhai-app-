<?php
if (!defined('WEB_ROOT')) {
		exit;
	}


	/*$sql =  "SELECT * FROM `currency`";
	$result  = dbQuery($dbConn, $sql);
	

	if(isset($_POST['btnButtonsave'])){
			
		if(isset($_POST['managecurrency'])){
		
		$sql12 =  "DELETE FROM `managecurrency`";
		dbQuery($dbConn, $sql12);
			
		$managecurrency = $_POST['managecurrency']; 
			foreach($managecurrency as $value){	
				$sql1 =  "SELECT * FROM `currency` WHERE code='$value'";
				$result1  = dbQuery($dbConn, $sql1);
				$rowval = mysqli_fetch_array($result1);
				$valuess = $rowval['country'];
				$symbol = $rowval['symbol'];
				$sql123 =  "INSERT INTO `managecurrency`(`value`, `name`, `symbol`) VALUES ('$value','$valuess','$symbol')";
				dbQuery($dbConn, $sql123);
			}
		}
	}
*/

/*if(isset($_POST['exdate'])){
	$id = $_POST['id'];
	$exdate = $_POST['exdate'];
	$sql =  "UPDATE `expire_date` SET `expiredate`= '$exdate' WHERE id=$id";
	$result  = dbQuery($dbConn, $sql);
}*/


?>
<!-- Content Header (Page header) -->

		
	<section class="row content-header top_heading">
		<div class="col-md-10">
			<h1>Business Flags</h1>
		</div>
		<div id="demo" class="col-md-2 float-right">
  		</div>
	</section>
	<!-- Main content -->

	
<section class="content">
	<style>
	
select[data-multi-select-plugin] {
    display: none !important;
}

.multi-select-component {
    position: relative;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    height: auto;
    width: 90%;
    padding: 3px 8px;
    font-size: 14px;
    line-height: 1.42857143;
    padding-bottom: 0px;
    color: #555;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
    -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

.autocomplete-list {
    border-radius: 4px 0px 0px 4px;
}

.multi-select-component:focus-within {
    box-shadow: inset 0px 0px 0px 2px #78ABFE;
}

.multi-select-component .btn-group {
    display: none !important;
}

.multiselect-native-select .multiselect-container {
    width: 100%;
}

.selected-wrapper {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    display: inline-block;
    border: 1px solid #d9d9d9;
    background-color: #ededed;
    white-space: nowrap;
    margin: 1px 5px 5px 0;
    height: 22px;
    vertical-align: top;
    cursor: default;
}

.selected-wrapper .selected-label {
    max-width: 514px;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-left: 4px;
    vertical-align: top;
}

.selected-wrapper .selected-close {
    display: inline-block;
    text-decoration: none;
    font-size: 14px;
    line-height: 1.49em;
    margin-left: 5px;
    padding-bottom: 10px;
    height: 100%;
    vertical-align: top;
    padding-right: 4px;
    opacity: 0.2;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    font-weight: 700;
}

.search-container {
    display: flex;
    flex-direction: row;
}

.search-container .selected-input {
    background: none;
    border: 0;
    height: 20px;
    width: 60px;
    padding: 0;
    margin-bottom: 6px;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.search-container .selected-input:focus {
    outline: none;
}

.dropdown-icon.active {
    transform: rotateX(180deg)
}

.search-container .dropdown-icon {
    display: inline-block;
    padding: 10px 5px;
    position: absolute;
    top: 5px;
    right: 5px;
    width: 10px;
    height: 10px;
    border: 0 !important;
    /* needed */
    -webkit-appearance: none;
    -moz-appearance: none;
    /* SVG background image */
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%20viewBox%3D%220%200%2012%2012%22%3E%3Ctitle%3Edown-arrow%3C%2Ftitle%3E%3Cg%20fill%3D%22%23818181%22%3E%3Cpath%20d%3D%22M10.293%2C3.293%2C6%2C7.586%2C1.707%2C3.293A1%2C1%2C0%2C0%2C0%2C.293%2C4.707l5%2C5a1%2C1%2C0%2C0%2C0%2C1.414%2C0l5-5a1%2C1%2C0%2C1%2C0-1.414-1.414Z%22%20fill%3D%22%23818181%22%3E%3C%2Fpath%3E%3C%2Fg%3E%3C%2Fsvg%3E");
    background-position: center;
    background-size: 10px;
    background-repeat: no-repeat;
}

.search-container ul {
    position: absolute;
    list-style: none;
    padding: 0;
    z-index: 3;
    margin-top: 29px;
    width: 100%;
    right: 0px;
    background: #fff;
    border: 1px solid #ccc;
    border-top: none;
    border-bottom: none;
    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}

.search-container ul :focus {
    outline: none;
}

.search-container ul li {
    display: block;
    text-align: left;
    padding: 8px 29px 2px 12px;
    border-bottom: 1px solid #ccc;
    font-size: 14px;
    min-height: 31px;
}

.search-container ul li:first-child {
    border-top: 1px solid #ccc;
    border-radius: 4px 0px 0 0;
}

.search-container ul li:last-child {
    border-radius: 4px 0px 0 0;
}


.search-container ul li:hover.not-cursor {
    cursor: default;
}

.search-container ul li:hover {
    color: #333;
    background-color: rgb(251, 242, 152);
    ;
    border-color: #adadad;
    cursor: pointer;
}

/* Adding scrool to select options */
.autocomplete-list {
    max-height: 300px;
    overflow-y: auto;
}
	</style>
		<!-- start any work here. -->
			<div class="box box-success">
				<div class="box-body">
					<div class="row">
							
                    <div class="col-md-12" style="margin-top:10px;">

             <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<style type="text/css">
    .paginate_button {
	  border-radius: 0 !important;
	}
</style>
<!-- partial:index.partial.html -->
<table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Id</th>
				<th class="text-center">Business Name</th>
                <th class="text-center">Flag Name</th>
                <th class="text-center">Date</th>
				 <th class="text-center">Flagger Name</th>
                <th class="text-center">Reason</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        
 
 
        <tbody>
<?php
				$sqlmanagecurrency =  "SELECT * FROM `flagpost` WHERE spCategory_idspCategory=20";
				$managecurrency  = dbQuery($dbConn, $sqlmanagecurrency);
				$i=1;
				if($managecurrency!=false){
				while($rowmanagecurrency = mysqli_fetch_array($managecurrency)){
				$flag_id=$rowmanagecurrency['flag_id'];
				$pid= $rowmanagecurrency['spProfile_idspProfile'];
				$category_id=$rowmanagecurrency['spCategory_idspCategory'];
				$postid=$rowmanagecurrency['spPosting_idspPosting'];
				//print_r($rowmanagecurrency);
				$sql=  "SELECT * FROM `spprofiles` WHERE idspProfiles=$pid";
				$res= dbQuery($dbConn, $sql);
				
				$row=mysqli_fetch_assoc($res);
				@$flager_name=$row['spProfileName'];
				
				$sql1=  "SELECT * FROM `spbuisnesspostings` WHERE idspbusiness=$postid";
				$res1= dbQuery($dbConn, $sql1);
				if($res1!=false){
				$row1=mysqli_fetch_assoc($res1);
				@$headline=$row1['listing_headline'];
				}
				
?>
                                                   <tr>
                                                        <td class="text-center"><?php echo $i; ?></td>
                                                        <td class="text-center"><?php echo $i; ?></td>
<td class="text-center"><a href="https://dev.thesharepage.com/buisness_for_sale/business_detail.php?postid=<?php echo $postid;?>"><?php echo $headline; ?></a></td>
                                                        <td class="text-center">&nbsp;<?php echo $rowmanagecurrency['why_flag']; ?></td>
                                                        
														
														<td class="text-center"><?php echo $rowmanagecurrency['flag_date']; ?></td>
														
<td class="text-center"><a href="https://dev.thesharepage.com/friends/?profileid=<?php echo $pid;?>"><?php echo $flager_name; ?></td>
	
                                                        <td class="text-center"><?php echo $rowmanagecurrency['flag_desc']; ?></td>
                                                       <td class="menu-action text-center">
										
									
										
										<a href="javascript:void(0);" class="disable-btn " data-work="deactivate" data-Id="<?php echo $postid;?>" data-catId = "<?php echo $category_id;?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 
										
										<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $postid;?>" data-catId = "<?php echo $category_id;?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 
										
                                            <a href="javascript:detail(<?php echo $category_id.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>
                                            	
										</td>
                                                    </tr>
				<?php $i++; } }?>
                                              
	    </tbody>
 
	</table>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
  <script type="text/javascript">
    $(document).ready(function() {

  var table = $('#example').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
    });//End of create main table

  
  $('#example tbody').on( 'click', 'tr', function () {
   
   // alert(table.row( this ).data()[0]);

} );
});
  </script>


                    </div>

				
					</div>
				</div>
			</div>
	</section>
<script type="text/javascript">
            $(document).ready(function(){
                $(document).on("click",".disable-btn",function() {
                    var dataId = $(this).attr("data-Id");
					//alert(dataId);
					  var cat_id = $(this).attr("data-catId");
					// alert(cat_id);
                    var work = $(this).attr("data-work");
				//alert(work);
					if(work=='deactivate'){
						swal({
						  title: "Do You Want Deactive this Listing?",
						  /*text: "You Want to Logout!",*/
						  type: "warning",
						  confirmButtonClass: "sweet_ok",
						  confirmButtonText: "Yes, Deactive!",
						  cancelButtonClass: "sweet_cancel",
						  cancelButtonText: "Cancel",
						  showCancelButton: true,
						},
						                function(isConfirm) {
                  if (isConfirm) {
                   window.location.href = '/dashboard/portfolio/delete_port.php?dataId=' +dataId+'&cat_id='+cat_id+'&work='+work;
                  } 
                });
						
					}	
					if(work=='delete'){
                    swal({
                      title: "Do You Want Delete this Listing?",
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
                   window.location.href = 'deleteflag.php?id=' +dataId+'&work='+work+'&cat_id='+cat_id;
                  } 
                });
					}	

                    // alert(dataId);
                });
            });
            
            
        </script>
		
		<script type="text/javascript">
            $(document).ready(function(){
                $(document).on("click",".deactive-btn",function() {
                    var dataId = $(this).attr("data-id");
					  var cat_id = $(this).attr("data-catId");
                    var work = $(this).attr("data-work");
					//alert(work);
					if(work=='deactive'){
						swal({
						  title: "Do You Want Deactive this Listing?",
						  /*text: "You Want to Logout!",*/
						  type: "warning",
						  confirmButtonClass: "sweet_ok",
						  confirmButtonText: "Yes, Deactive!",
						  cancelButtonClass: "sweet_cancel",
						  cancelButtonText: "Cancel",
						  showCancelButton: true,
						},
						                function(isConfirm) {
                  if (isConfirm) {
                   window.location.href = '/backofadmin/flag/deactivepost.php?id=' +dataId+'&work='+work+'&catId='+cat_id;
                  } 
                });
						
					}	
				

                    // alert(dataId);
                });
            });
            
            
        </script>