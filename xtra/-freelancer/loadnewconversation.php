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
		
	if ($result != false) {
		//src=' ".($row["spProfilePic"])."'
		while ($row = mysqli_fetch_assoc($result)) {

			$dt = new DateTime($row['chat_date']);
            $d = strtotime($row['chat_date']);
            ?>
            <tr> 
                
                <td class="commentoverflow">
                    <b><?php 
                    $PName = $p->getProfileName($row['sender_idspProfiles']);
                        echo $PName;
                    ?></b>
                </td>
                <td style="word-wrap: break-word;"><?php echo $row['chat_conversation'];?></td>
                <td><?php echo $dt->format('d M Y') . "  " . date("H:i A", $d); ?></td>
            </tr>                                                                      
            <?php
		}
	}
?>