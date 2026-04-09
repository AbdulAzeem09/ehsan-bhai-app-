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
.smalldot{
	     width : 100px;
  overflow:hidden;
  display:inline-block;
  text-overflow: ellipsis;
  white-space: nowrap;
}
            
            </style>
            
            
            
            <div class="content">
                <div class="col-md-12 ">
                    <h1 class="h1 text-center fs-4 fw-bold bg-success">the student ragistration form</h1>
                    <form enctype="multipart/form-data" class="f1" id="formsubmit">
                        <label for="Student_name">student name
                            <span id="nameerror" style="color:red;">*</span>
                        </label>
                        <input type="text" id="name" name="sfn" placeholder="enter the student name" maxlength="25" class="form-control">
                        <label for="Student_name">student last name
                            <span id="lnamerror2" style="color:red;">*</span>
                        </label>
                        <input type="text" id="lname" name="slname" placeholder="enter the student last name" maxlength="15" class="form-control">
                        
                        <!--<button type="button" id="spgroupSubmit" class="btn btnPosting db_btn db_primarybtn btn-create-form float-right" style="margin-top:0px!important;" fdprocessedid="s56p4l">sumbit</button>-->
                        <button type="submit" id="spposting" class="btn btn-success form-control" value="submit" style="margin-top:23px!important;">Post</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="container">
                <table class="table mt-10">
                    <thead class="bg-light text-success text-center fs-4 fw-bold mt-10">
                        <tr>
                            <th>Id</th>
                            <th>name</th>
                            <th>lastname</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light text-success fs-4 fw-bold">
                        <?php 
                        $p = new _timelineflag;
                        $mjax_11 = $p->mjax_readd();
                        while($store_dta = mysqli_fetch_assoc($mjax_11))
                        {
                        ?>
                        <tr>
                      
                        <td class="text-center"><span class="smalldot"><?php echo ucfirst($store_dta['eid']); ?></span></td>
                        <td class="text-center"><span class="smalldot"><?php echo ucfirst($store_dta['name']); ?></span></td>
                        <td class="text-center"><span class="smalldot"><?php echo ucfirst($store_dta['lname']); ?></span></td>
                        <td></td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>


            </div>
            </div>
            
        </div>
    </div>
</div>





</div>
</section>
<script>
    $("#spposting").on("click", function (e) {
e.preventDefault();
        var namefsdsd = document.getElementById("name").value;
        var lnamefsdfsdf = document.getElementById("lname").value;
        //alert(namefsdsd);
        //alert(slname);
        $.ajax({
       type:"post",
    url: MAINURL + "/dashboard/majaxinsert.php",
    data: {
    fsfdsfsdf: namefsdsd,
    lnfsdfsdfsdfame: lnamefsdfsdf
},

 success:function(data)
 {
   // alert(data);

//   swal(data,"plz yes give me data is fine","success");
 }
});
      
    

    }); 
       
    
</script>
<script src="https:<?php echo $baseurl?>/assets/js/sweetalert.js.0.19/dist/sweetalert2.all.min.js"></script>
<script>

$( document ).ready(function() {
    $("#spposting").submit(function(e){
		
		var a= $("#name").val();
		var b= $("#lname").val();
		
		if((a=="") || (b=="")){
			if(a==""){
			$("#nameerror").text("Please Fill This Field");
			}
			else{
					$("#nameerror").text("");
			}
			if(b==""){
			$("#lnamerror2").text("Please Fill This Field");
			}
			else{
				$("#lnamerror2").text("");
			}
			
			
		}
		if(a==""){
			$("#nameerror").text("Please Fill This Field");
			return false;
    e.preventDefault();
		}
		
		if(b==""){
				$("#lnamerror2").text("Please Fill This Field");
			return false;
    e.preventDefault();
		}
		
		
		
		
		
		Swal.fire({
      title: 'Data Posted Successfully',
     
      icon: 'success',
    
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok !'
    }).then((result) => {
      if (result.isConfirmed) {
      
      }
    })  
}); 

$("#spPortname").change(function(){
 	$("#namerror").text("");
});
$("#spWeblink").change(function(){
  	$("#lnamerror2").text("");
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
<script>
    getPagination('#table-id');
	$('#maxRows').trigger('change');
	function getPagination (table){

		  $('#maxRows').on('change',function(){
		  	$('.pagination').html('');						// reset pagination div
		  	var trnum = 0 ;									// reset tr counter 
		  	var maxRows = parseInt($(this).val());			// get Max Rows from select option
        
		  	var totalRows = $(table+' tbody tr').length;		// numbers of rows 
			 $(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
			 	trnum++;									// Start Counter 
			 	if (trnum > maxRows ){						// if tr number gt maxRows
			 		
			 		$(this).hide();							// fade it out 
			 	}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
			 });											//  was fade out to fade it in 
			 if (totalRows > maxRows){						// if tr total rows gt max rows option
			 	var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
			 												//	numbers of pages 
			 	for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
			 	$('.pagination').append('<li data-page="'+i+'">\
								      <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
								    </li>').show();
			 	}											// end for i 
     
         
			} 												// end if row count > max rows
			$('.pagination li:first-child').addClass('active'); // add active class to the first li 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
       showig_rows_count(maxRows, 1, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

        $('.pagination li').on('click',function(e){		// on click each page
        e.preventDefault();
				var pageNum = $(this).attr('data-page');	// get it's number
				var trIndex = 0 ;							// reset tr counter
				$('.pagination li').removeClass('active');	// remove active class from all li 
				$(this).addClass('active');					// add active class to the clicked 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL
       showig_rows_count(maxRows, pageNum, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL
        
        
        
				 $(table+' tr:gt(0)').each(function(){		// each tr in table not the header
				 	trIndex++;								// tr index counter 
				 	// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
				 	if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
				 		$(this).hide();		
				 	}else {$(this).show();} 				//else fade in 
				 }); 										// end of for each tr in table
					});										// end of on click pagination list
		});
											// end of on select change 
		 
								// END OF PAGINATION 
    
	}	


			

// SI SETTING
$(function(){
	// Just to append id number for each row  
default_index();
					
});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
   //Default rows showing
        var end_index = maxRows*pageNum;
        var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
        var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
        $('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
  $('table tr:eq(0)').prepend('<th> ID </th>')

					var id = 0;

					$('table tr:gt(0)').each(function(){	
						id++
						$(this).prepend('<td>'+id+'</td>');
					});
}

// All Table search script
function FilterkeyWord_all_table() {
  
// Count td if you want to search on all table instead of specific column

  var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

        // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input_all");
  var input_value =     document.getElementById("search_input_all").value;
        filter = input.value.toLowerCase();
  if(input_value !=''){
        table = document.getElementById("table-id");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
          
          var flag = 0;
           
          for(j = 0; j < count; j++){
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
             
                var td_text = td.innerHTML;  
                if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                //var td_text = td.innerHTML;  
                //td.innerHTML = 'shaban';
                  flag = 1;
                } else {
                  //DO NOTHING
                }
              }
            }
          if(flag==1){
                     tr[i].style.display = "";
          }else {
             tr[i].style.display = "none";
          }
        }
    }else {
      //RESET TABLE
      $('#maxRows').trigger('change');
    }
}
</script>




