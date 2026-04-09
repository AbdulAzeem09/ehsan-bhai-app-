<?php

	session_start();

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");
	$fc = new _post_chat;
	$p = new _spprofiles;
	$ptype = 5;
	
	date_default_timezone_set('Asia/Karachi');
	$result = $fc->readChat($_POST['txtSendrProId'], $_SESSION['pid'], $ptype);
		
	if ($result != false) {
		//src=' ".($row["spProfilePic"])."'
		while ($row = mysqli_fetch_assoc($result)) {
			// read profile
            $result2 = $p->read($row['sender_idspProfiles']);
            if ($result2) {
                $row2 = mysqli_fetch_assoc($result2);
                if ($row2['spProfilePic'] != '') {
                    $sender_img = '<img src="'.($row2['spProfilePic']).' " class="img-responsive">';
                }else{
                    $sender_img = "<img src='../assets/images/blank-img/default-profile.png' alt='' class='img-responsive' />";
                }
            }else{
                $sender_img = "<img src='../assets/images/blank-img/default-profile.png' alt='' class='img-responsive' />";
            }
            
            $dt = new DateTime($row['chat_date']);

            $d = strtotime($row['chat_date']);
            if ($row['sender_idspProfiles'] == $_SESSION['pid']) {
                ?>
                <li class="sent">
                    <?php echo $sender_img; ?> 
                    <p><?php echo $row['chat_conversation'];?></p>
                </li>
                <?php
            }else{
                ?>
                <li class="replies">
                    <?php echo $sender_img; ?> 
                    <p><?php echo $row['chat_conversation'];?></p>
                </li>
                <?php
            }
		}
	}
?>