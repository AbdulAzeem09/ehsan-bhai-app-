<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$p = new _postings;
		$tr = new _training;
		$res = $p->read($_POST['postid']);
		if($res != false)
		{
			//print_r(expression)
			$row = mysqli_fetch_assoc($res);
			if($row["spPostingsBought"] == 1)
			{
				echo "Already Bought !";
			}
			else
			{
				$p->checkout($_POST['postid'],$_POST['profileid']);
				$trainingData = array(
					"spTrainId" => $_POST['postid'],
					"spProfileId" => $_POST['profileid']
				);
				$tr->create($trainingData);
				echo "Successfully Checkout";
			}
		}
?> 