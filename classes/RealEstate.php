<?php

class RealEstate extends Base{
  
 
  /**
   * Used for Autocomplete in real-estate/index.php page
   *
   */
  public function mainSearch(){
  
    $maxOutput = 15;
    
    $countryId = $_SESSION['spPostCountry'];
    //$stateId = $_SESSION['spPostState'];
    $term = !empty($_GET['term']) ? $_GET['term'] : "";
    //var_dump($countryId);die;
    
    if(!$term){
      errorOut("Term missing");
    }
    
    $finalData = [];
    
    $sql = 'select a.city_id, a.city_title, count(b.idspPostings) as rCount from tbl_city as a 
      inner join sprealstate as b on b.spPostingsCity = a.city_id    
      where a.country_id=? and a.city_title like ? group by a.city_id order by a.city_title  limit 15';
    
    $params = [$countryId, "%$term%"];
    $out = selectQ($sql, "is", $params);
    
    //$params = [$countryId];
    //$out = selectQ($sql, "i", $params);
    
    foreach($out as $one){
      $finalData[] = array('value' => $one['city_id'], 'category' => 'City', 'label' => $one['city_title'], 'count' => $one['rCount']);
    }
    
    $pending = $maxOutput - count($finalData);
    
    if($pending){
    
      $listIdQuery = "spPostListId = ?";
      $params = [$countryId, $term];
      if(strlen($term) >= 5){
        $listIdQuery = "spPostListId like ?";
        $params = [$countryId, "%$term%"];
      }
      
      $sql = 'select spPostListId, count(spPostListId) as rCount from sprealstate where spPostingsCountry=? and '.$listIdQuery.' group by spPostListId order by spPostListId  limit '.$pending;
      
      $out = selectQ($sql, "is", $params);
      
      foreach($out as $one){
        $finalData[] = array('value' => $one['spPostListId'], 'category' => 'ListingId', 'label' => $one['spPostListId'], 'count' => $one['rCount']);
      }      
      
      $pending = $maxOutput - count($finalData);
      
      if($pending){
        $sql = 'select community, count(community) as rCount from sprealstate where spPostingsCountry=? and community=? group by community order by community asc  limit '.$pending;
        
        $params = [$countryId, $term];
        $out = selectQ($sql, "is", $params);
        
        foreach($out as $one){
          $finalData[] = array('value' => $one['community'], 'category' => 'Community', 'label' => $one['community'], 'count' => $one['rCount']);
        }

      
        $pending = $maxOutput - count($finalData);
        if($pending){
          $sql = 'select spPostingAddress, count(spPostingAddress) as rCount from sprealstate where spPostingsCountry=? and spPostingAddress like ? group by spPostingAddress order by spPostingAddress asc  limit '.$pending;
          
          $params = [$countryId, "%$term%"];
          $out = selectQ($sql, "is", $params);
          
          foreach($out as $one){
            $finalData[] = array('value' => $one['spPostingAddress'], 'category' => 'Address', 'label' => $one['spPostingAddress'], 'count' => $one['rCount']);
          }
        }

      }
    
    }

    return ['data' => $finalData, 'format' => 'skipSuccess'];

  } 

}
