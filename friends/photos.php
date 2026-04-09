

	<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">

<!-- Magnific Popup core JS file -->

	<?php
		$pic = new _postingpic;
		$result33 = $pic->readimage($_GET["profileid"]);
		$result3 = $pic->readimagelimit($_GET["profileid"]);
		$count_photo_num_rows  = $result33->num_rows;
		//echo $pic->ta->sql;
		if($result3 != false)
		{
			echo "<div class='row m_top_10 frndProfileImg no-margin gallery-img m_btm_5'>";
				while($row3 = mysqli_fetch_assoc($result3)){

					/*print_r($row3);*/
					if(isset($row3["spPostingPic"])){
						?>
						<div class="col-md-3 no-padding post1">
                            <a class="thumbnail mag" data-effect="mfp-newspaper"  href="<?php echo ($row3["spPostingPic"]); ?>">
                                <img class="group1 bradius-10" src="<?php echo ($row3["spPostingPic"]); ?>">
                            </a>
                        </div> 
                        
						<?php
						//echo "<div class='col-lg-4 col-sm-6 col-xs-12'>";
						//echo "<div class='thumbnail'><img src='".($row3["spPostingMedia"])."'></div>";
						//echo "</div>";
					}
					
				}
			
				 
			
			echo "</div>";
			if($count_photo_num_rows > 16){
                        ?>
						<h1 class="load-more1 111" style="text-align: center;color:#2784c5;padding: 6px;cursor:pointer" >Load More</h1>
														<input type="hidden" id="row1" value="0">
														<input type="hidden" id="all1" value="<?php echo $count_photo_num_rows; ?>"> 
														<input type="hidden" id="profiddd1" value="<?php echo $_GET['profileid']; ?>"> 
														
						  <?php } 
		}else{

			echo"<h4 style='text-align:center;'>No Photos found</h4>";
		}
	?>
<script type="text/javascript">
	
$('.thumbnail').magnificPopup({
  type: 'image'
  // other options
});



	$(document).ready(function(){
    // Load more data
    $('.load-more1').click(function(){
        var row1 = Number($('#row1').val());
        var allcount1 = Number($('#all1').val());
        row1 = row1 + 16;

        if(row1 <= allcount1){
			
            $("#row1").val(row1);
            var profileid1 = $("#profiddd1").val();
		
  
            $.ajax({
                url: 'more_pic.php', 
                type: 'post',
                data: {row:row1,profile:profileid1},
                beforeSend:function(){
                    $(".load-more1").text("Loading...");
                },
                success: function(response){
					
                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".post1:last").after(response).show().fadeIn("slow");
						
						   $(".load-more1").text("Load More");
                        var rowno = row1 + 16;
                        // checking row value is greater than allcount or not
                        if(rowno > allcount1){
						    $('.load-more1').css("display","none");
                        }else{
                            $(".load-more1").text("Load more");
                        }
						$(".load-more1").text("Load More");
                    }, 2000);
                }
            });
        }else{
            $('.load-more1').text("Loading...");
				
            // Setting little delay while removing contents
            setTimeout(function() {

                // When row is greater than allcount then remove all class='post' element after 3 element
               // $('.post1:nth-child(3)').nextAll('.post1').remove().fadeIn("slow");

                // Reset the value of row
               // $("#row1").val(0); 

                // Change the text and background
                $('.load-more1').text("Load more");
                $('.load-more1').css("background","#15a9ce");
            }, 2000);
        }
    });
});

</script>	
