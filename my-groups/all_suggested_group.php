<style type="text/css">
    
    .friend_message .messages ul li img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        float: left;
    }

    .friend_message .messages ul li {
    display: inline-block;
    clear: both;
    float: left;
    margin: 15px 15px 5px 15px;
    width: calc(100% - 25px);
    font-size: 1.9em;
    padding: 0 25 0 25px !important;
}
a.page-link:hover {
    color: white;
}
</style>

<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "friendmessage/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../component/f_links.php');?>
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
        <style type="text/css">
            .list-wrapper {
                padding: 15px;
                overflow: hidden;
                }
				
			
				
                .main_grop_box h2 {
					

color: #000;
text-align: center;
font-size: 12px;
/*font-family: MarksimonLight;*/
text-transform: uppercase;
margin: 10px 0 10px;
}
            .list-item {
            border: 1px solid #EEE;
            background: #FFF;
            margin-bottom: 10px;
            padding: 10px;
            box-shadow: 0px 0px 10px 0px #EEE;
            display: contents;
            }
            .list-item h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;    
                }

                .list-item p {
                margin: 0;
                }

                .simple-pagination ul {
                    margin: 0 0 20px;
                    padding: 0;
                    list-style: none;
                    text-align: center;
                    }

                    .simple-pagination li {
                    display: inline-block;
                    margin-right: 5px;
                    }

                    .simple-pagination li a,
                    .simple-pagination li span {
                    color: #666;
                    padding: 5px 10px;
                    text-decoration: none;
                    border: 1px solid #3e2048;
                    background-color: #3e2048;
                    box-shadow: 0px 0px 10px 0px #EEE;
                    }

                    .simple-pagination .current {
                    color: #FFF;

                    }

                    .simple-pagination .prev.current,
                    .simple-pagination .next.current {

                    }
        </style>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
            }
             // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            
        </script>
        <!--This script for sticky left and right sidebar END-->
        <!--NOTIFICATION-->
        <!-- <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'> -->
    </head>
    <body class="bg_gray" >

        <?php
       
  include_once("../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div id="sidebar" class="col-md-2 no-padding">
                    <?php include('../component/left-landing.php');?>
                </div>
                <div class="col-md-10">
                    <div class="row">
                 <div class="col-md-12">

                    <div class="heading01 text-center" id="ip6" style="background-color: white;">


                        <div class="left_head_top" style="margin-left: 130px;">

                            <form class="inner_top_form" method="POST" action="<?php echo $BaseUrl;?>/my-groups/search-group.php">

                                <div class="form-group" style="margin-bottom: -8px!important;">
                                    <select class="form-control cate_drop" name="txtCategory">
                                     <option value="all" >All</option><?php 
                                    //new title

                                     $g_cat = new _spgroup;
                                     $search_title = $g_cat->read_title();

                                     while($rows = mysqli_fetch_assoc($search_title)) {  
                                        ?>

                                        <option value='<?php echo $rows["group_category_name"]; ?>' 
                                            <?php echo (isset($_POST['txtCategory']) && $_POST['txtCategory'] ==$rows["group_category_name"])?'selected':''; ?>>
                                            <?php echo $rows["group_category_name"];?>
                                        </option>
                                    <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control searchbox" aria-describedby="basic-addon1" name="txtSearch" value="<?php if(isset($_POST['txtSearch'])){ echo $_POST['txtSearch'];  }?>" placeholder="Search by group title">
                            </div>
                            <button class="btn groupBtnSearch" type="submit" name="btnSearch"><i class="fa fa-search"></i>  Search</button>
                            <!-- <input type="submit" class="btn" value="Advance Search" name="btnSearch" > -->
                        </form>

                    </div>
                </div>
    <?php
   
    ?>
    
    
        </div>
                <div class="col-md-12" >
                    <div class="heading01 text-center" style="background: white;height: auto;">
                  <div class="list-wrapper">
                     <h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;margin-top: 0px;"><b>GROUPS YOU MIGHT BE INTERESTED IN</b></h3>
                    <?php
					
					 $proobj = new _groupconversation;
 $result= $proobj->readPost33();
 
 $intrestid = array();
 if($result!=false){
 
while($row2 = mysqli_fetch_assoc($result)){

	array_push($intrestid,$row2['intrest_id']);

}
 }


$where = "";
foreach ($intrestid as $val ){
	$where .=  "t.spgroupCategory=". $val .' OR ' ;
}


$where = $where .'spgroupCategory = '.$val;
$g = new _spgroup;
                                $result9 = $g->publicgroup_suggest($where);
                                // echo $g->tap->sql;
								 //die;
                                if ($result9 != false) { 
                                  $count_box = 0;
                                  $count_g = 0;
                                  while($row5 = mysqli_fetch_assoc($result9)){
								 // print_r($row5);
                                      $gid = $row5['idspGroup'];
									  $st=$g->read_group_status($gid);
									  if($st!=false){
									  $sta=mysqli_fetch_assoc($st);
									  $group_status=$sta['spgroupstatus'];
									  
									  }
                                      $_SESSION['gid'] = $gid;
                                      $gname = $row5['spGroupName'];
                                      $_SESSION['gname'] = $gname;
                                      $result6 = $g->public_not_join($row5['idspGroup'], $_SESSION['pid']);
                                      if($gid != ''){
                                        //echo $row9['idspGroup'];
                                        $result2 = $g->groupdetails_suggest($gid);
                                   //  echo $g->tap->sql;
									 //die;
                                        if ($result2 != false) {
										//	die('=============');
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $gdes = $row2["spGroupAbout"];
                                            $gimage = $row2["spgroupimage"];
                                        }

                                        //GET ADMIN  NAME OR IMAGE
                                        $rpvt = $g->members($row5['idspGroup']);
                                        //echo $g->ta->sql; 
                                        if ($rpvt != false) {
                                            while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                if ($row3['spProfileIsAdmin'] == 0) {
                                                    $spProfilePic = $row3['spProfilePic'];
                                                    $Group_Admin_Name = $row3['spProfileName'];
                                                }
                                            }
                                        }  
										
								if($group_status==0){		
                        ?>
						
			
						
                         <div class="list-item"> 

                                            <div class="col-md-4 no-padding" style=" border-style: groove; ">

                                                <div class="main_grop_box <?php echo ''; ?>" style="min-height: 160px !important;">
												 <a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $row5['idspGroup']?>&groupname=<?php echo $row5['spGroupName']?>&timeline" >
                                                   <?php

                                                   if($gimage == ""){ ?>
                                                    <img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_banner.jpg" class="img-responsive group_banner" alt=""  style="height:160px;"/><?php
                                                }else{ ?>
                                                   <img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage ; ?>" class="img-responsive group_banner" alt=""  style="height:160px;"/><?php
                                               }


                                               ?>
											   </a>
											   </div>
                                               <div class="row">
                                                <!--  <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->
                                                <a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $row5['idspGroup']?>&groupname=<?php echo $row5['spGroupName']?>&timeline" ><h2 style="margin-top: -5px;"><?php echo ucwords(strtolower(substr($row5['spGroupName'],0,15))).'...';?></h2></a>
												<div class="row">
												<div class="" style="float:left;margin-left: 50px;">
												<?php if($row5['spgroupflag'] == 1)

                                                {echo '<h6 style="color:black;margin-top: -5px;"><i class="fa fa-lock"></i> Private Group</h6>';}else{echo '<h6 style="color:black;margin-top: -5px;"><i class="fa fa-globe"></i> Public Group</h6>';}?>
										</div>
<div class="" style="float:right;margin-right: 50px;">
                                                <h6 style="text-align:center;color:black;margin-top: -5px;"> <?php
			//	echo $_GET["groupid"]; die("========");
                    $getPendingMembers = $g->joinedMembersOfGroup($row5['idspGroup']);
					      
                    if ($getPendingMembers != false) 
                    {
                        $pendCounter = mysqli_num_rows($getPendingMembers);
                        
                        if ($pendCounter > 0) 
                        {
                    ?>  
                        <p> <span>(<?php echo $pendCounter;?>)</span>  Members </p></a>
                <?php
                    } else { ?>
                        <p>(0) Member1</p></a>
						
         <?php }
		 
		 } else {
					
					echo " <p>(0) Member</p></a>";
					
				}?></h6>

                                            </div> </div>
                                            </div>
                                            <div class="pull-left" style="margin-left: 118px; margin-bottom:5px;">
                                                <label ><button class="join_timeline btn view_right_joinbtn" data-pid="<?php echo $_SESSION['pid'];?>" data-gid="<?php echo $row5['idspGroup']; ?>" data-gname="<?php echo $row5['spGroupName']; ?>" id="addmemontimeline">&nbsp; Join &nbsp;</button></label>
												
												

                                                </div>
                                                <?php
                        //count member old and new

                                                $result3 = $g->allgrpmember($row5['idspGroup']);
												
                                       
                        // echo $g->tad->sql;
                                                if(!empty($result3)){ 
													         $total_member = mysqli_num_rows($result3);
                                                $result4 = $g->newgrpmember($row5['idspGroup']);
												if($result4){
                                                    $new_tot_member = mysqli_num_rows($result4);
                                                }} else{
                                                    $new_tot_member = 0;
                                                }

                                                ?>
                                                <?php if($row5['spgroupCategory'] == '')
                                                { ?>
                                                  <h5 style="color: black;margin-top: 5px;"></h5>
                                                  <?php }else { ?><h5 style="color: black;margin-top: 5px;"><?php echo ucwords(strtolower($row5['spgroupCategory']));?></h5>

                                              <?php } ?>



                                          
                                  </div>
                              </div>
								<?php }} } } ?>
                </div>
                <div id="pagination-container"></div>
            </div>
              </div>
        </section>
        <?php include('../component/footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../component/f_btm_script.php'); ?>
    
    </body>
</html>
<?php
}
?>


<script type="text/javascript">
$(document).ready(function(){
$('#addmemontimeline').click(function(){ 
	//alert("hello");
var gid = $('#grpid').val();
var pid = $('#pid').val();
var gname = $('#gname').val();
$.ajax({
url: "join_group.php",
type: "POST",
data: {
gid: gid,
pid: pid,
gname: gname
},
success: function (response) {
if(response = '1')
{
// var link = document.getElementById('link').value;

window.location = 'index.php';
}
else
{
alert('something went wrong')
}

// $('#bottom_reaction').html(response);
},

});
});
});
</script>
<script>

// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 6;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function (pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});



</script>