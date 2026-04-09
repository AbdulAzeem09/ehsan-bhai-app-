    
        
        
    <?php
    include('../univ/baseurl.php');
    //session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $p  = new _postingview;
    $p2 = new _postingview;

    if(isset($_POST['orderBy'])){
        $orderBy = $_POST['orderBy'];
        $txtProfileId = $_POST['txtProfileId'];


        $res = $p->globaltimelinesProfile_ordr($orderBy, $txtProfileId);
        if ($res != false){
            while ($timeline = mysqli_fetch_assoc($res)) {
                $_GET["timelineid"] = $timeline['idspPostings'];
                $res2 = $p2->singletimelines($_GET["timelineid"]);
                if ($res2 != false){
                    while ($rows = mysqli_fetch_assoc($res2)) {
                        $media = new _postingalbum;
                        $result = $media->read($rows['idspPostings']);
                        if ($result != false) {
                            $r = mysqli_fetch_assoc($result);
                            $picture = $r['spPostingMedia'];
                            $sppostingmediaTitle = $r['sppostingmediaTitle'];
                            $sppostingmediaExt = $r['sppostingmediaExt'];
                            if($sppostingmediaExt == 'mp3'){ ?>
                                <div class="col-md-6 no-padding searchable">
                                    <input type="checkbox" class="emp_checkbox " value="<?php echo $rows['idspPostings']; ?>" data-emp-id="<?php echo $rows['idspPostings']; ?>" style="z-index: 9;left: 6px; top:0px;">
                                    <audio controls>
                                        <source src="<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>" type="audio/<?php echo $sppostingmediaExt;?>">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                                
                                <?php
                            }
                        }


                        
                    }
                }
            }
        }
    }
    ?>
                
