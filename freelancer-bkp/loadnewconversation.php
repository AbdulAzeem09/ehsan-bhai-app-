<?php

	session_start();

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");
	$fc = new _freelance_chat;
	$p = new _spprofiles;
	date_default_timezone_set('Asia/Karachi');
	$result = $fc->readChat($_POST['txtSendrProId'], $_SESSION['pid']);

    // ===GET INFO OF RECEIVER
    $rec = $p->read($_POST['txtSendrProId']);
    if ($rec != false) {
        $rw_rec = mysqli_fetch_assoc($rec);
        $rec_name = $rw_rec["spProfileName"];
        $rec_img = $rw_rec["spProfilePic"];
    }
    // ===END

	$mypid = $_SESSION['pid'];
	// ===GET INFO OF SENDER
    $pr = $p->read($mypid);
    if ($pr != false) {
        $rw = mysqli_fetch_assoc($pr);
        $sender = $rw["spProfileName"];
        $sender_img = $rw["spProfilePic"];
    }
    // ===END
		
	if ($result != false) {
		//src=' ".($row["spProfilePic"])."'
		while ($row = mysqli_fetch_assoc($result)) {

			$dt = new DateTime($row['chat_date']);
            $d = strtotime($row['chat_date']);

            $PName = $p->getProfileName($row['sender_idspProfiles']);
            // ===NEW CHAT
            if ($row['sender_idspProfiles'] == $mypid) {
                ?>
                <li class="sent">
                    <img src="<?php echo ($sender_img);?>" class="img-responsive">
                    <p><?php echo $row["chat_conversation"] ; ?></p>
                </li>
                <?php
            }else{
                ?>
                <li class="replies">
                    <img src="<?php echo ($rec_img);?>" class="img-responsive">
                    <p><?php echo $row["chat_conversation"] ; ?></p>
                </li>
                <?php
            }
            // ===END
           
		}
	}
?>