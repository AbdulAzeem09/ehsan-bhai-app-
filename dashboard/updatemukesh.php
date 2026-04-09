<?php


/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


require_once("../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 85; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
        .tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
                        .dataTables_filter	{
                            margin-bottom:3px;
                        }
.dataTables_empty{text-align:center!important;}

    </style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
    <!-- left side bar -->
    <div class="col-md-2 no_pad_right">
        <?php
        ;
        include('../component/left-dashboard.php');
        ?>
    </div>
    <!-- main content -->
    <div class="col-md-10 no_pad_left">
        <div class="rightContent">
            
            <!-- breadcrumb -->
            <!--   <section class="content-header">
                <h1>My Selling Product</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">My Selling Product</li>
                </ol>
            </section>-->


        
            <style>
            .smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}
/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
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
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}				
td, th {
    border: 1px solid #dddddd;
   
}		
.h1
{
    font-family:times;
}
.f1
{
    font-family:times;
    font-size:25px!important;
}
            
            </style>
            <?php 
            $p = new _timelineflag;
            //die("mchs");
            $rr = $_GET['mid'];
            $display1 = $p->uread_11($rr);
            $result55 = mysqli_fetch_assoc($display1);

            ?>
            
            
            
            
            <div class="content">
                <div class="col-md-12 ">
                    <h1 class="h1 text-center fs-4 fw-bold bg-success">the student ragistration form</h1>
                    <form action="update1mukesh.php" method="POST" enctype="multipart/form-data" class="f1">
                        <label for="Student_name">student name
                            <span id="nameerror" style="color:red;">*</span>
                        </label>
                        <input type="text" id="name" name="sname" placeholder="enter the student name" maxlength="25" value="<?php echo $result55['name'] ?>" class="form-control">
                        <label for="Student_name">student last name
                            <span id="lnamerror" style="color:red;">*</span>
                        </label>
                        <input type="text" id="lname" name="slname" placeholder="enter the student last name" maxlength="15" value="<?php echo $result55['lname'] ?>" class="form-control">
                        <label for="Student_name">Email
                            <span id="emailerror" style="color:red;">*</span>
                        </label>
                        <input type="email" id="email" name="semail" placeholder="enter the student email id" maxlength="25" value="<?php echo $result55['email'] ?>" class="form-control">
                        <label for="Student_name">student email password
                            <span id="passerror" style="color:red;">*</span>
                        </label>
                        <input type="password" id="password" name="spassword" placeholder="enter the student email password" maxlength="50" value="<?php echo $result55['password'] ?>" class="form-control">
                        <label for="Student_name">student mobile number
                            <span id="moberror" style="color:red;">*</span>
                        </label>
                        <input type="number" id="mob" name="smob" placeholder="enter the student mobile number" maxlength="50" value="<?php echo $result55['mob'] ?>" class="form-control">
                        <label for="Student_name">student country name
                            <span id="imagerror" style="color:red;">*</span>
                        </label>
                        <select class="form-control" name="scountry" value="<?php echo $result55['country'] ?>">
													<option value="1" selected="selected">india</option>
													<option value="2">nepal</option>
													<option value="3">pakistan</option>
													<option value="4">thailand</option>
                        </select>
                        <label for="Student_name">student village address
                            <span id="imagerror" style="color:red;">*</span>
                        </label>
                        <input type="text" name="saddress" maxlength="80" value="<?php echo $result55['address'] ?>" class="form-control"/>
                        <label for="Student_name">student state name
                            <span id="imagerror" style="color:red;">*</span>
                        </label>
                        <select name="sstate" id="" value="<?php echo $result55['state'] ?>" class="form-control"/>
                            <option value="0">bihar</option>
                            <option value="1">punjab</option>
                            <option value="2">uttar pradesh</option>
                            <option value="3">meghalay</option>
                            <option value="4">madhya pradesh</option>
                            <option value="5">keral</option>
                            <option value="6">delhi</option>
                            <option value="7">kolkata</option>
                            <option value="8">gujrat</option>
                            <option value="9">asam</option>
                            <option value="10">guvahati</option>

                        </select>
                        <label for="">student date of birth
                            <span style="color:red">*</span>
                        </label>
                        <input type="date" name="sbirth" id="" value="<?php echo $result55['birth'] ?>" class="form-control"/>
                        <label for="">student monthly salary
                            <span style="color:red">*</span>
                        </label>
                        <input type="money" name="ssalary" value="<?php echo $result55['salary'] ?>" class="form-control" id=""/>
                        <input type="hidden" name="sid" value="<?php echo $result55['eid'] ?>">
                        <!--<button type="button" id="spgroupSubmit" class="btn btnPosting db_btn db_primarybtn btn-create-form float-right" style="margin-top:0px!important;" fdprocessedid="s56p4l">sumbit</button>-->
                        <button type="sumbit" id="msumbit" class="btn btn-success form-control" style="margin-top:23px!important;">update</button>
                    </form>
                </div>
                </div>
            </div>
            


                
            
        

            
          

            
       
            </div>
            </div>
            
        </div>
    </div>
</div>





</div>
</section>
<script>
    $(document).ready(function(){
        $(#msumbit).click(function() {
        var sname = $('#name').val();
        var slname = $('#lname').val();
        var semail = $('#email').val();
        var spassword = $('#password').val();
        var smob = $('#mob').val();
        var simage = $('#image').val();

        if((sname == '') || (slname == '') || (semail == '') || (spassword == '') || (smob == '')) {
            if(sname == '')
            {
                $('#nameerror').html('plz field the required'); 
            }else{
                $('#nameerror').html('');
            }
            if(slname == '')
            {
                $('#lnamerror').html('plz field the required'); 
            }else{
                $('#lnamerror').html('');
            }
            if(semail == '')
            {
                $('#emailerror').html('plz field the required'); 
            }else{
                $('#emailerror').html('');
            }
            if(spassword == '')
            {
                $('#passerror').html('plz field the required'); 
            }else{
                $('#passerror').html('');
            }
            if(smob == '')
            {
                $('#moberror').html('plz field the required'); 
            }else{
                $('#moberror').html('');
            }
            
            
            
                return false;
            


        }
        var sformData = new FormData();
sformData.append('spgroupimage', $('#banner')[0].files[0]);
sformData.append('spGroupName', name);
sformData.append('spgroupCategory', category);
sformData.append('spUserCountry', country);
sformData.append('spUserState', state);
sformData.append('spUserCity', city);
sformData.append('zipcode', zipcode);
sformData.append('address', address);
sformData.append('spgroupstatus', privacy);
sformData.append('spGroupTagline', sort_des);
sformData.append('spGroupAbout', about_group);








        });

    });
</script>


<?php include('../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/f_btm_script.php'); ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                            <!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
     


</body> 
</html>
<?php
} ?>





