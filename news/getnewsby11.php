<?php
include '../univ/baseurl.php';
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "videos/";
    include_once "../authentication/check.php";

} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");?>

<p style="display:none"><?php echo $abc = date("YmdHis", strtotime($feed_item->pubDate));?></p>


<a href="javascript:void(0)"   onclick="MyCountrynewsBucket555(<?php echo $abc;?>)" id="appendbucket<?php echo $link; ?>" data-website-name="<?php echo $row['website_name'];?>" data-link="<?php echo $feed_item->link; ?>" data-title="<?php echo $feed_item->title; ?>" data-publish-date="<?php echo $date; ?>" data-description="<?php //echo $description; ?>">
	  <?php  
		 $obj=new _spprofiles;
		  
		 
		 
		 $res=$obj->readbucketnewsdata($link,$_SESSION['pid']) ;
		 //print_r($res); die('-------');
		 if($res!=false){
		 echo '<i class="fa fa-archive red" aria-hidden="true" title="UnBucket" style="cursor:pointer;"></i>';
			
		 }
			else{
				echo '<i class="fa fa-archive green" aria-hidden="true" title="Bucket" style=" cursor:pointer;"></i>';
			}																				   
		 ?>	  
	  </a>
	  
	  
	  
	  
	  
	  <script>
	  
	  function MyCountrynewsBucket555(id)
{
var a =  $('#newsid'+id).val();


$.ajax({
url: "bucketNews.php",
type: "POST",
cache:false,
data: {'id':a  


},
success: function(data) {
			// location.reload();
$('#appendbucket'+a).html(data);	 
//alert("success");	  
}

});
						
						
				 }
	  
	  
	  
	  
	  
	  
</script>