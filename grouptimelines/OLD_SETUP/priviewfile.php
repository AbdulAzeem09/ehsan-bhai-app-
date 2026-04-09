<?php

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$pc = new _postingalbum;
$result = $pc->resume($_POST['mediaid']);
if ($result != false) {
    while ($rw = mysqli_fetch_assoc($result)) {
        $resume = $rw["spPostingMedia"];
        $ext = $rw['sppostingmediaExtension'];
        $previewfile = $rw['sppostingmediaTitle'] . $rw['idspPostingMedia'] . "." . $rw['sppostingmediaExt'] . "";
        file_put_contents("../resume/" . $previewfile, $resume);
        echo $previewfile;
    }
}
?>