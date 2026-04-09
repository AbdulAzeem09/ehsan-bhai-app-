<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse no-padding header_po" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="<?php echo ($activePage == 7)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/services/dashboard.php';?>" class="">Dashboard</a></li>
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            
            <li class="<?php echo ($activePage == 1)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/services/active-post.php';?>" class="">Active Posts</a></li>
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            <li class="<?php echo ($activePage == 2)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/services/expire-post.php';?>" class="">Expired Posts</a></li>
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            <li class="<?php echo ($activePage == 3)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/services/fav-post.php';?>" class="">Favourite Posts</a></li>
            
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            <li class="<?php echo ($activePage == 5)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/services/flag-post.php';?>" class="">Flagged Posts</a></li>
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            <li class="<?php echo ($activePage == 6)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/services/draft.php';?>" class="">Draft</a></li>
            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
            <li class="<?php echo ($activePage == 4)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/services/myequiry.php';?>" class="">Enquiry</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->