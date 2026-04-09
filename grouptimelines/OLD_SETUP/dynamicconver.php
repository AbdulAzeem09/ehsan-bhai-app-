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
        echo "<div class='row'>";

        echo "<div class='col-md-2' style='clor:#483D8B;font-weight:bold;'>" . $row["spProfileName"] . "</div>";

        $dt = new DateTime($row['spGroupConversationDate']);
        $d = strtotime($row['spGroupConversationDate']);
        echo "<div class='col-md-10'>";
        echo "<span style='margin-top:5px;'>" . $row["spGroupConversationText"] . "</span>";

        echo "<span class='pull-right' style='color:gray'>" . $dt->format('d M') . "  " . date("H:i", $d) . "</span>";
        echo "</div>";
        echo "</div>";
    }
}
?>