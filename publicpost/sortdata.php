    
    
        <div class="col-md-12 social 7">
            <?php
            include('../univ/baseurl.php');
            session_start();
            function sp_autoloader($class) {
                include '../mlayer/' . $class . '.class.php';
            }
            spl_autoload_register("sp_autoloader");
            $ordrBy = $_POST['orderdate'];
            $idprofile = $_POST['spProfiles_idspProfiles'];
//print_r($_POST); die('---------');
            $hp = new _hidepost;
            //$results = $hp->getPost($idprofile);
           // echo $hp->ta->sql;
			//echo "<br>";
            $hidepost = array();
            if($results != false){
                while ($rowh = mysqli_fetch_assoc($results)) {
                    array_push($hidepost, $rowh['spPostings_idspPostings']);
                }
            }

            $p = new _postingview;
            $res = $p->globaltimelineDate($ordrBy, $idprofile);
            //echo $p->ta->sql; 
            echo "<div id='timeline-container'>";
            //echo $p->ta->sql;
            if ($res != false)
                while ($timeline = mysqli_fetch_assoc($res)) {
			
			//print_r($timeline); die('---------');
                    if(in_array($timeline['idspPostings'], $hidepost)){ 

                    }else{ 
                        $_GET["timelineid"] = $timeline['idspPostings'];
                        include "../timeline/timelineentry.php";
                    }
                    
                } 
            echo "</div>";
            ?>
        </div>
    


