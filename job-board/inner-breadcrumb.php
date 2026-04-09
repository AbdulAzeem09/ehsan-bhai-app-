    
    <?php
    $m = new  _postingview;
    //my Active job
    $res = $m->myProfilejobpost($_SESSION['pid']);
    if($res){
        $active = $res->num_rows;
    }else{
        $active = 0;
    }
    //my De-active job
    $res2 = $m->myDeactiveProfilejob($_SESSION['pid']);
    //echo $m->ta->sql;
    if($res2){
        $deactive = $res2->num_rows;
    }else{
        $deactive = 0;
    }
    //my Draft job
    $res3 = $m->myDraftJob(2 ,$_SESSION['pid']);
    //echo $m->ta->sql;
    if($res3){
        $drafts = $res3->num_rows;
    }else{
        $drafts = 0;
    }
    ?>
    <div class="row no-margin" style="margin: 15px 0px; border: 1px solid #CCC;">
        <div class="dashboard-section">
            <div class="col-xs-12 bg_white no-padding">
                <div class="">
                    <ul class="myjobboaardBread no-margin">
                        
                        <li><a class="<?php echo ($activePage == 1)?'active' : '';?>" href="<?php echo $BaseUrl.'/job-board/dashboard/';?>">Dashboard</a></li> 
                        <li><span>|</span></li>                        
                        <li><a class="<?php echo ($activePage == 2)?'active' : '';?>" href="<?php echo $BaseUrl.'/job-board/all-jobs.php';?>">Job Feeds</a></li>
                        
                        <li><span>|</span></li>
                        <li><a class="<?php echo ($activePage == 7)?'active' : '';?>" href="<?php echo $BaseUrl.'/job-board/all-jobseeker.php';?>">Jobseekers</a></li>
                        
                        <li><span>|</span></li>
                        <li><a class="<?php echo ($activePage == 8)?'active' : '';?>" href="<?php echo $BaseUrl.'/job-board/find-a-job.php';?>">Advance Job Search</a></li>
                        <li><span>|</span></li>
                        <li><a class="<?php echo ($activePage == 9)?'active' : '';?>" href="<?php echo $BaseUrl.'/job-board/inbox.php';?>">Inbox</a></li>
                        

                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    