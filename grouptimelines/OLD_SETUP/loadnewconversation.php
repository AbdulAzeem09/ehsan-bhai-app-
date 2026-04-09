<?php

session_start();

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$gc = new _groupconversation;
$result = $gc->read($_POST["idspGroupMessage"]);
if ($result != false) {
    //src=' ".($row["spProfilePic"])."'
    while ($row = mysqli_fetch_assoc($result)) {

        $dt = new DateTime($row['spGroupConversationDate']);
        $d = strtotime($row['spGroupConversationDate']);
        
        echo '<tr> 
                
                <td class="commentoverflow">
                    <b>' . $row["spProfileName"] . '</b>
                </td>
                <td style="word-wrap: break-word;">' . $row["spGroupConversationText"] . '</td>
                <td style="width:100px;">' . $dt->format('d M') . "  " . date("H:i", $d) . '</td>
            </tr>                                                                      
        ';
    }
}
?>