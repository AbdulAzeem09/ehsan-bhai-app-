<?php
    include('../univ/baseurl.php');
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
    $p = new _comment;
    $re = new _redirect;
   $p6 = new _spprofiles;

    $rpvt6 = $p6->read($_POST["profileid"]);

    $profilename = array('spPostings_idspPostings' => $_POST["spPostings_idspPostings"], 'spProfiles_idspProfiles'=>$_POST["spProfiles_idspProfiles"],'userid'=>$_POST["userid"],  'comment'=>$_POST["comment"]);
    $profile=  $_POST['profileid'];
    if(isset($_POST["idComment"]) && !empty($_POST["idComment"]) ){
        $p->updatecpmment($_POST["comment"],$_POST["idComment"]);
        if(isset($_POST['grouptimelines_']) && $_POST["grouptimelines_"] == 1){

            //header("Location:../grouptimelines/");
            $loc = $BaseUrl.'/grouptimelines';
            $re->redirect($loc);
        }else{

            $loc = $BaseUrl.'/timeline';
            $re->redirect($loc);
        }
        
    }else{
        if($_POST['comment'] == ""){

            //header("location:".$BaseUrl."/details");
            $loc = $BaseUrl.'/timeline';
            $re->redirect($loc);
        }else{

            $p->comment($profilename);
            if(isset($_POST['grouptimelines_']) && $_POST["grouptimelines_"] == 1){
                //header("Location:../grouptimelines/");
                $loc = $BaseUrl.'/grouptimelines';
                $re->redirect($loc);
            } else {
                $result = $p->read($_POST['spPostings_idspPostings']);
                $totalcmt = 0;
                if ($result != false) {
                    $totalcmt = $result->num_rows;
                }

                $comment = '<div class="timelinecmnt_'.$_POST['spPostings_idspPostings'].'"><div class="row view_more_cmnt_'.$_POST['spPostings_idspPostings'].' comment_align">
                            <div class="col-md-12"><div class="row view_more_cmnt">
                            <div class="col-md-12">
                                <a class="float-right" href="../publicpost/post_comment_details.php?postid='.$_POST['spPostings_idspPostings'].'" ><span class="morecomment" data-postid="'.$totalcmt.'">View all comments <span class="tltcmt">('.$totalcmt.')</span></span></a>                                        </div>
                            </div>
                            </div>
                        </div></div>';
                echo json_encode(array('spPostings_idspPostings'=>$_POST['spPostings_idspPostings'],'spProfiles_idspProfiles'=>$_POST['spProfiles_idspProfiles'],'userid'=>$_POST['userid'],'comment' => $comment));
                // $url = $BaseUrl."/friends/?profileid=$profile";
                // $re->redirect($url);       
            }
            //header("Location:../timeline/");
        }
    }  
?>