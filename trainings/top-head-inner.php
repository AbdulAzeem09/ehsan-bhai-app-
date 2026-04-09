

<div class="col-md-12 no-padding">
    <div class="fulmainarttab">
        <ul class='nav nav-tabs' id='navtabVdo' >
            <li class=""><a href="<?php echo $BaseUrl.'/trainings';?>">Home</a></li> 
			<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

            <li class="<?php echo ($topPage == 4)?'active':'';?>"><a href="<?php echo $BaseUrl.'/trainings/dashboard/';?>" >Dashboard</a></li> <?php } ?>
            <li class="<?php echo ($topPage == 1)?'active':'';?>"><a href="<?php echo $BaseUrl.'/trainings/category.php';?>" >All Courses</a></li>
			<li class="<?php echo ($topPage == 2)?'active':'';?>"><a href="<?php echo $BaseUrl.'/trainings/instructor.php';?>" >Instructors </a></li>
            
            

        </ul>
        <div class="linebtm"></div>
    </div>
</div>