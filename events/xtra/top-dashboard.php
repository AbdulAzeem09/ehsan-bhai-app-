
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse no-padding header_po" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li class="<?php echo ($activePage == 7)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/events/dashboard';?>" class="">Dashboard</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        
        <li class="<?php echo ($activePage == 1)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/events/active-event.php';?>" class="">Active Events</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 2)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/events/past-event.php';?>" class="">Past Events </a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 3)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/events/draft-event.php';?>" class="">Draft Events</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 4)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/events/sponsor-list.php';?>" class="">Sponsors</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 5)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/events/event-favourite.php';?>" class="">Bookmark Events</a></li>
        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
        <li class="<?php echo ($activePage == 6)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/events/join-event.php';?>" class="">Join Events</a></li>

        <li class="<?php echo ($activePage == 7)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/events/myFlag.php';?>" class="">Flagged Posting</a></li>

    </ul>
</div><!-- /.navbar-collapse -->