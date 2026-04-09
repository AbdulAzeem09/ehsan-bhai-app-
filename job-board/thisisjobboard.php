       <div class="col-sm-12  dashboard-section " style="background-color: #fff; border: 1px solid #ccc;margin-bottom: 10px;border-radius: 5px;width: 99%;">
                        
            <h3 style="margin-top: 10px!important;">JobBoard <?php 
if($_SESSION['ptid'] == 1){
 echo "Employer Dashboard";
}

if($_SESSION['ptid'] == 5){
 echo "Employee Dashboard";
}
			?></h3>
                        
       </div>
