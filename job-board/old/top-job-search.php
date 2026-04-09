<div class="row no-margin">
    <div class="col-sm-12 right_jobboard no-padding">
        <div class="text-right m_top_10" style="margin-right: 10px;">
            <?php
            if($_SESSION['ptid'] == 1){?>
                <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn butn_jobboard">Post a job</a> <?php
            } ?> 
        </div>  
        <div class="top_head_in">
            <form class="job_search" method="post" action="search.php" >
                <div class="row">
                    <div class="col-sm-12 no-padding">
                        <div class="col-md-10 ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="txtJobTitle" class="form-control"  placeholder="Job Title" required="" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="txtJobLoc" class="form-control"  placeholder="Location" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="txtJobLevel" >
                                            <option value="">Select Job Level</option>
                                            <?php
                                                $m = new _masterdetails;
                                                $masterid = 2;
                                                $result = $m->read($masterid);
                                                if($result != false){
                                                    while($rows = mysqli_fetch_assoc($result)){
                                                        echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
                                                    }
                                                }
                                            ?>
                                      </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="btnJobSearch" class="btn btn-default">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>