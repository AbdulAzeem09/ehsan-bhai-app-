<?php
include '../univ/baseurl.php';
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "videos/";
    include_once "../authentication/check.php";

} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    //echo "<pre>"; print_r($_FILES); print_r($_REQUEST); exit;

    $n = new _news;
    $category1 ='';
	 

    if(!empty($_POST['type']) && $_POST['type'] == 'category') {
        $result = $n->readByMyCountry($_POST['country'],$_POST['category'],'country_wise');
    } else if(!empty($_POST['type']) && $_POST['type'] == 'country') {
        $res = $n->readCategoryByCountry($_POST['country'],'country_wise');

         
        if($res != false){
            while ($row3 = mysqli_fetch_assoc($res)) {
                $category1 .= '<option value="'.$row3['id'].'">'.$row3['name'].'</option>';
            }
        }
        $result = $n->readNewsByCountry($_POST['country'],'country_wise');
    }

    // print_r($result);

    $news1 = "";
    if($result != false){
        // print_r($result);
        while ($row = mysqli_fetch_assoc($result)) {
            // echo $_POST['country'];
            // $news1 .= '<input type="hidden" id="idspProfileCountry_" value="'.$_POST['country'].'">';
           
            $rss_feed = simplexml_load_file($row['website_link']);
            
			$limit=0;
			
            if(!empty($rss_feed)) {
                // echo $row['website_name'];
			foreach ($rss_feed->channel->item as $key => $feed_item) {
				
				
                                                          $limit++;
												
												if($limit>2){
													break;
												}  
 
              //  foreach ($rss_feed->channel->item as $feed_item) {
                   // echo $row['website_name'];
                    // print_r($feed_item);
                    $randomnum = rand(1111,9999);
                    $publish_date = date("YmdHis", strtotime($feed_item->pubDate));
                    $description = implode(' ', array_slice(explode(' ', $feed_item->description), 0, 14));
                    $news1 .=    '<p style="display:none">'.$publish_date.'</p>
                                <div class="panel opencomment" id="'.$publish_date.'">
                                    <input type="hidden" id="newsid" name="newsid" value="">
                                    
                                    <div class="panel-body">               
									
                                        <div>
                                            <h3 class="feed_title">'.$row['website_name'].'</h3>
                                        </div>
                                        <div class="npcontent">
                                            <div class="newstext">
											<div class="row">
											
											<div class="col-md-8">
                                                <h4>'.$feed_item->title.'</h4>
                                                <p>
                                                    <a href="'.$feed_item->link.'">Read more...</a> 
                                                    | <a href="#"><i class="fa fa-share-alt"></i></a>
                                                    | <a href="javascript:void(0)" class="bookmark" data-website-name="'.$row['website_name'].'" data-link="'.$feed_item->link.'" data-title="'.$feed_item->title.'" data-publish-date="'.$date.'" data-description="" ><i class="fa fa-bookmark" aria-hidden="true"></i></a> 
                                                  
                                                    | <a href="#" onclick="new1()"><i class="fa fa-archive" aria-hidden="true"></i></a> 
													

                                                    | <a href="#"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                </p>
                                            </div>
											
											 <div class="col-md-3">
                                                   <p class="imgres">'.implode(" ", array_slice(explode(" ", $feed_item->description), 0, 7)).'</p>
                                                </div>
                                                <div class="col-md-1"></div>
                                             </div>
											
											   </div>
											   </div>
                                        </div>
                                    </div>
                                </div>';
               
                }
            }
        }
    }

    // echo $news1;
   
    // $id = $_POST['id'];

    // $result = $n->readbycountry($id);
    
    // $resultarr = [];
    // if($result != false){
    //     while ($row = mysqli_fetch_assoc($result)) {  
    //         $rss = simplexml_load_file( $row['website_link']);
    //         foreach($rss->channel->item as $feed_item){
            
    //         $feed_item->title = $feed_item->title;
    //         array_push($resultarr,$row,$feed_item);
    //         }
    //     }
    // } else {
    //     echo $return = "<h4>No Record Found</h4>";
    // }
    // header('Content-type:application/json');
        echo json_encode(['category1' => $category1, 'news1' => $news1]);
}
?>


