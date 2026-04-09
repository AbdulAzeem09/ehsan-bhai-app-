
<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$r = new _sppostreview;
		$res = $r->read($_POST["spPostings_idspPostings"],$_POST["spProfiles_idspProfiles"]);
		if($res != false)
		{
			$r->updatereview($_POST["spPostings_idspPostings"],$_POST["spProfiles_idspProfiles"],$_POST["spPostReviewText"],$_POST["spPostRating"]);
			
			if(isset($_POST["flag_"]))
				header("Location:../customer_reviews/?postid=".$_POST["spPostings_idspPostings"]."");
			else
				header("Location:../post-details/?postid=".$_POST["spPostings_idspPostings"]."");
			
		}
		
		else
		{
			$r->create($_POST);
			
			$result = $r->review($_POST["spPostings_idspPostings"]);
			if($result != false)
			{
				$review = $result->num_rows;
				echo $review;
			}
			else
			{
				$review = 0;
				echo $review;
			}
			if(isset($_POST["flag_"]))
				header("Location:../customer_reviews/?postid=".$_POST["spPostings_idspPostings"]."");
			else
				header("Location:../post-details/?postid=".$_POST["spPostings_idspPostings"]."");
		}



		/*$r = new _sppostreview;
		if(isset($_POST["sppostreviewid"]))
		{
			$r->updatereview($_POST["spPostings_idspPostings"],$_POST["spProfiles_idspProfiles"],$_POST["spPostReviewText"],$_POST["spPostRating"],$_POST["sppostreviewid"]);
				
			if(isset($_POST["flag_"]))
				header("Location:../customer_reviews/?postid=".$_POST["spPostings_idspPostings"]."");
			else
				header("Location:../post-details/?postid=".$_POST["spPostings_idspPostings"]."");
		}
		
		else
		{
			
			$r->create($_POST);
			$result = $r->review($_POST["spPostings_idspPostings"]);
			if($result != false)
			{
				$review = $result->num_rows;
				echo $review;
			}
			else
			{
				$review = 0;
				echo $review;
			}
			if(isset($_POST["flag_"]))
				header("Location:../customer_reviews/?postid=".$_POST["spPostings_idspPostings"]."");
			else
				header("Location:../post-details/?postid=".$_POST["spPostings_idspPostings"]."");
		}*/
		
		
		
?>
