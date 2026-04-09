<?php
	$p = new _postingview;
	$res = $p->post();
	if($res != false){
		
		while($rows = mysqli_fetch_assoc($res)){	?>
			<div class="col-md-5ths pad_lft_rt_15">
                <div class="trndpox text-center">
                    <a href="<?php echo $BaseUrl;?>/post-details/?postid=<?php echo $rows['idspPostings'];?>">
                    	<?php
						$pic = new _postingpic;
						$result = $pic->read($rows['idspPostings']);
						if($result!= false){
							$rp = mysqli_fetch_assoc($result);
							$picture = $rp['spPostingPic'];
							echo "<img alt='Posting Pic' class='img-responsive' src=' ".($picture)."' >" ;
						}else{
							echo "<img alt='Posting Pic' class='img-responsive' src='assets/images/blank-img/no-trend-post.jpg' >" ;
						}

						//$postdate = strtotime($rows['spPostingDate']);
						//$currentdate = strtotime(date('Y-m-d h:i:sa'));
						//$Diff = abs($currentdate - $postdate);
						//$numberDays = $Diff/86400;  // 86400 seconds in one day
						// it cinvert in integer form
						//$numberDays = intval($numberDays);
							
						?>
                        <h4 data-toggle="tooltip" title="<?php echo ucwords(strtolower($rows['spPostingtitle'])); ?>" ><?php echo   substr(ucwords(strtolower($rows['spPostingtitle'])), 0, 15); ?></h4>
                        <!-- <p><?php //echo $numberDays; ?> Days</p> -->
                    </a>
                </div>
            </div>

        	<?php
        } 
    }?>
