    

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse no-padding header_bus" id="bs-example-navbar-collapse-1" >
        <ul class="nav navbar-nav" style="width: 100%">
            <li class="<?php echo ($_GET['news']=='1')?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/dashboard.php?news=1';?>" class="">COMPANY NEWS</a></li>  
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            
            <li class="<?php echo ($activePage == 2)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/favourite.php';?>" class="">  FAVOURITES</a></li>
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            <li class="<?php echo ($activePage == 3)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/resource.php';?>" class="">RESOURCES</a></li>
            <!--<li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            <li class="<?php echo ($activePage == 4)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/gallery.php';?>" class="">My Gallery</a></li>-->  
            
            <?php
                if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 1  || $_SESSION['ptid'] == 3 ) { ?>
                    <li class="pull-right"><a href="<?php echo $BaseUrl.'/business-directory-services/details.php?business='.$_SESSION['pid']; ?>" target="_blank" ><i class="fa fa-user"></i> VIEW MY BUSINESS SPACE</a></li>      
                    <?php
                }
            ?>

              <li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
            <li class="<?php echo ($activePage == 5)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/manage_tab.php';?>" class=""> MANAGE MENU</a></li>

            <!--<li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
            <li class="<?php echo ($activePage == 12)?'active' : '';?>"><a href="<?php //echo $BaseUrl.'/business-directory/manage_dynamic_menu.php';?>" class="">MANAGE PAGE</a></li>-->   

            <li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
            <li class="<?php echo ($activePage == 6)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/manage_banner.php';?>" class=""> BANNER</a></li>
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
            <li class="<?php echo ($activePage == 7)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/manage_content.php';?>" class=""> CONTENT</a></li>
            <!--<li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
            <li class="<?php echo ($activePage == 8)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/manage_service.php';?>" class="">Manage Service</a></li>-->
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
            <li class="<?php echo ($activePage == 9)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/create_new_menu.php';?>" class="">PAGE</a></li>  
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
            <li class="<?php echo ($activePage == 10)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/manage_gallery.php';?>" class="">GALLERY</a></li>
            <li class="<?php echo ($activePage == 12)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/contact_us.php';?>" class="">CONTACT US</a></li>
            <!--<li class="hidden-xs"><a href="#" class="seprator">|</a></li> 
            <li class="<?php echo ($activePage == 11)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/business-directory/manage_album.php';?>" class=""> ALBUM</a></li> -->   
        </ul>
    </div><!-- /.navbar-collapse -->     