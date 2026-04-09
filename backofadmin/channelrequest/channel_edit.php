<?php

error_reporting(E_ERROR | E_PARSE);
include '../mlayer/' . $class . '.class.php';
include '../univ/baseurl.php';

?>
 
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display:none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>


 <div>
 <?php 
 $ids=$_GET["id"];
$allcmd="select*from rss_data where rss_id=$ids";
$allresult = dbQuery($dbConn, $allcmd);	
$datafetch=mysqli_fetch_assoc($allresult);


if(isset($_POST['submit']))
{
	$sid=$_GET['id'];
$website_name=$_POST['website_name'];
$website_link=$_POST['website_link'];
$news_type=$_POST['news_type'];
$countrys=$_POST['country'];
 
$categorys=$_POST['category'];
$spupdate="update rss_data set website_name='$website_name',website_link='$website_link',news_type='$news_type',country='$countrys',category='$categorys'  where rss_id=$sid";
$updatecmd = dbQuery($dbConn, $spupdate);	
 ?><script>
    window.location = '<?php echo $BaseUrl;?>/backofadmin/channelrequest/index.php?view=channellist&msg=update';
</script><?php

}
 ?>
         <div class="modal-body">
		 
            <form id="addChannelForm" action="" method="POST" style="width:55%">
			<div class="alert alert-info" role="alert"style="font-size:20px">
                         Edit channel
                   </div>
               <div class="form-group">
                  <label for="website_name" class="control-label">Website Name<span class="red">* <span class="spUserCountry erormsg"></span></label>
                  <input type="text" name="website_name" class="form-control" id="website_name" placeholder="Enter Website Name" value="<?php echo $datafetch["website_name"] ?>">
               </div>
               <div class="form-group">
                  <label for="website_link" class="control-label">Website Link<span class="red">* <span class="spUserCountry erormsg"></span></label>
                  <textarea class="form-control" name="website_link" id="website_link"><?php echo $datafetch["website_link"] ?></textarea>
               </div>
			     <?php //echo $datafetch["news_type"]; die("000000"); ?>
               <div class="form-group">
                  <label for="news_type" class="lbl_7">News Type</label>
                 
                     <select id="news_type" class="form-control" name="news_type" >
                        <option value="">Select News Type</option>
                        <option value="local"<?php if($datafetch["news_type"]=='local'){echo 'selected';} ?>>Local</option>
                        <option value="country_wise"<?php if($datafetch["news_type"]=='country_wise'){echo 'selected';} ?>>Country wise</option>
                     </select>
               </div>
               <div class="form-group">
                  <label for="news_country" class="lbl_7">Country</label>
                  <select id="news_country" class="form-control" name="country" >
                     <option value="">Select Country</option>
                     <?php 

				
 $sql="select*from tbl_country";
						$result = dbQuery($dbConn, $sql);				
                        if ($result != false) {
                            while ($row1 = mysqli_fetch_assoc($result)) {
                     ?>
                              <option value='<?php echo $row1['country_id']; ?>'<?php if($datafetch["country"]==$row1['country_id']){echo 'selected';} ?>><?php echo $row1['country_title']; ?></option>
                     <?php
                           }
                        }
						
						
                     ?>
                  </select>
               </div>
               <div class="form-group">
                  <label for="news_category" class="lbl_7">Category
                     <span class="red">* <span class="spUserCountry erormsg"></span></span>
                  </label>
                  <select id="news_category" class="form-control" name="category" >
                     <option value="">Select Category</option>
                        <?php
                           $ssql="select*from news_categories"; 
						   $result = dbQuery($dbConn, $ssql);	
                           if ($result!= false) {
                              while ($row2 = mysqli_fetch_assoc($result)) {
                        ?>
                                 <option value='<?php echo $row2['id']; ?>'<?php if($datafetch["category"]==$row2['id']){echo 'selected';} ?>><?php echo $row2['name']; ?></option>
                        <?php
                              }
                           }
                        ?>
                  </select>
               </div>
			       
            
         </div>
         <div>
           
            <button type="submit" id="channelSubmit" class="btn btn-primary" name="submit"style="padding:10px 20px 10px 20px;font-size:20px;margin-left:20px;">Edit </button>
			<a href='<?php echo $BaseUrl;?>/backofadmin/channelrequest/index.php?view=channellist' class="btn btn-danger"style="font-size:20px;padding:10px 20px 10px 20px">Cancel</a>
			
			
         </div>
		 </form>
		 
       
   
</div>
 
 
 
<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}

   
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 
 
 //$query2="SELECT * FROM rss_data WHERE seller_userid='$selectname' AND date_txn BETWEEN '$sdate' AND '$edate'";
 
// $result=dbQuery($dbConn, $query2);

 //$roww2=mysqli_fetch_assoc($ress2);
if(isset($_GET['status']) &&($_GET['status']!='')){
	$rss_id=$_GET['id'];

	$status=$_GET['status'];
	$sql5="UPDATE `rss_data` SET `rss_status`=$status WHERE rss_id=$rss_id";


 dbQuery($dbConn, $sql5);
}

	$rowsPerPage = 25;
  	$sql		=	"SELECT * FROM rss_data";
  	$result = dbQuery($dbConn, $sql);
	 
?>
	
	  

	 

 

 

 

 
 
   
	
  
	