<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$gc = new _groupconversation;
$result = $gc->read($_POST['pid']);
if ($result != false) {
    echo '<table class="table table-hover table-condensed" style="table-layout: fixed" id="myTable">
            <thead><tr><th width="2%"></th><th>Participant</th><th>Message</th><th>Created Date</th></tr></thead>';
    while ($row = mysqli_fetch_assoc($result)) {
//        echo "<pre>";
//        print_r($row);
//        echo "</pre>";
        echo'<tbody>';
        $dt = new DateTime($row['spGroupConversationDate']);
        $d = strtotime($row['spGroupConversationDate']);
        echo '<tr> 
                                <td width="2%">                                    				
                                </td>
                                <td width="20%" class="commentoverflow">
                                    <b>' . $row["spProfileName"] . '</b>
                                </td>
                                <td style="word-wrap: break-word;min-width: 57%;max-width: 57%;">' . $row["spGroupConversationText"] . '</td>
                                <td width="18%">' . $dt->format('d M') . "  " . date("H:i", $d) . '</td>
                            </tr>                                                                      
                        </tbody>
                    ';
    }
    echo '</table>';
}
?>