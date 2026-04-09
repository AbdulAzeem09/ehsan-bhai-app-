<?php 
class _productposting
{
    public $dbclose = false;
    private $conn;
    public $ta;
    function __construct() { 
        $this->ta = new _tableadapter("spProduct");//spShipping
        $this->ta->dbclose = false;
    } 
    
    function create($data){
        $postid = $this->ta->create($data);

        return $postid;
    }
    
    function read($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE idspPostings =".$uid);
    }
    
    


     function readprofile($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
    }
    function update($data, $pid){
        $this->ta->update($data, $pid);
    }

    function auctionproductpost($catid) {


        return $this->ta->read("WHERE spPostingVisibility=0 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
    }

 function activeprevpost($postid) {
        return $this->ta->update(array("spPostingVisibility" => "-1"), "WHERE idspPostings ='" . $postid . "'");
    }


 function allauctionproduct($catid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
    }

 function allretailproduct($catid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()");
    }

function allwholesaleproduct($catid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE()");
    }



 function limitallauctionproduct($catid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC LIMIT 5");
    }

 function limitallretailproduct($catid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC LIMIT 5");
    }

function limitallwholesaleproduct($catid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC LIMIT 5");
    }

    function myallretailproduct($catid,$pid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC LIMIT 5");
    }


function myallwholesaleproduct($catid,$pid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . "  AND spProfiles_idspProfiles = " . $pid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC LIMIT 5");
    }

 function myallauctionproduct($catid,$pid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC LIMIT 5");
    }


     function allretailfavrouiteproduct($catid,$postid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND idspPostings = " . $postid . "  AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()");
    }
    


    function allwholesalefavrouiteproduct($catid,$postid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND idspPostings = " . $postid . "  AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE()");
    }

     function allauctionfavrouiteproduct($catid,$postid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND idspPostings = " . $postid . "  AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
    }




    function auctionquantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid ." AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
        
    }

  function retailquantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid ." AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
        
    }

    function wholesalequantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid ." AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
        
    }

 // TOTAL NUMBER OF PRODUCT WHICH USER POST
    function publicpost_count($pid){
        return $this->ta->read("WHERE spPostingVisibility = -1 AND spCategories_idspCategory = 1 AND spProfiles_idspProfiles = " . $pid, "ORDER BY spPostingDate DESC");
    }

    function seller_product($sellerid){
        return $this->ta->read("where spPostingVisibility=-1 and spProfiles_idspProfiles ='$sellerid' AND spCategories_idspCategory = 1 GROUP BY idspPostings ORDER BY RAND() LIMIT 3");
    }

    function myretailproduct($catid,$pid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = ".$pid." AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()");
    }


    function mywholesaleproduct($catid,$pid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = ".$pid." AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE()");
    }


    function myauctionproduct($catid,$pid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = ".$pid." AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
    }

    function readprice($postid)
    {
        return $this->ta->read("WHERE t.spPostings_idspPostings =" .$postid. " AND spPostFieldName ='spPostingPriceHourly_ ' AND spPostFieldValue = 1");
    }

    //my sote product with specefic profile
    function myStoreProduct($pid){
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.spCategories_idspCategory = 1", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }

     // SHOW ALL PRODUCT BY VISIBITLTY AND MODULE WISE
    function myProductVis($pid, $visilty, $catid){
        return $this->ta->read("WHERE t.spPostingVisibility = ".$visilty." AND t.spProfiles_idspProfiles = " . $pid . " AND t.spCategories_idspCategory = $catid", "ORDER BY spPostingDate DESC");
    }

   // MY DRAFT PRODUCTS PROFILE AND CATEGORY WISE
    function readMyDraftprofile($catid, $pid) {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
        return $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spCategories_idspCategory = $catid AND t.spPostingVisibility = 0", "ORDER BY spPostingDate DESC");
    }


    // MY EXPIRE PRODUCT
    function myExpireProduct($catId, $pid){
       /* return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = $catId AND t.spPostingVisibility != -3 OR t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");*/
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = $catId AND t.spPostingVisibility != -3 AND t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");
    }


 function allwholesellpost(){
        return $this->ta->read("where t.sppostingvisibility=-1 and t.spCategories_idspCategory = 1 and t.sppostingsflag = 0 AND t.sellType = 'Wholesale' GROUP BY idspPostings ORDER BY spPostingDate DESC ");
    }

          // ==============END=================
    function auction($type, $uid){
        if($type == 'auction'){
            return $this->ta->read(" where t.sppostingvisibility=-1 and t.spCategories_idspCategory = 1 AND t.sellType = '$type' GROUP BY idspPostings ORDER BY spPostingDate DESC");
        }else if($type == 'buypost'){
            return $this->ta->read("where t.spProfiles_idspProfiles = '$uid' AND t.sppostingvisibility=-1 and t.spCategories_idspCategory = 1 AND t.sellType <> 'auction' GROUP BY idspPostings ORDER BY spPostingDate DESC");
        }
    }

   
  function updateQty($postid, $newQty){
        $this->ta->update(array("spPostFieldValue" => $newQty), "WHERE spPostFieldLabel = 'Ticket Capacity' AND spPostFieldName = 'ticketcapacity_' AND spPostings_idspPostings = $postid");
    }

     function trashpost($postid) {
        $this->ta->update(array("spPostingVisibility" => -3),"WHERE t.idspPostings = " . $postid);
    }


   //MY ALL STORE SEARCCH
    function search_myall_store($uid, $txtSearch) {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory =1", "ORDER BY spPostingDate DESC");
    }


    //friend store SEARCH
    function search_store_friends_Posting($uid, $txtSearch) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%')  AND t.spCategories_idspCategory = 1 AND t.spProfiles_idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "ORDER BY spPostingDate DESC");
    }

    //All group store search
    function search_all_group_store($pid, $txtSearch) {
        return $this->ta->read("WHERE t.spCategories_idspCategory = 1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "ORDER BY spPostingDate DESC");
    }

    //PUBLIC POST SEARCH
    function search_publicpost($start, $category, $txtSearch) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }

 function search_store($type, $category, $txtSearch) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category . " AND sellType = '".$type."'", "ORDER BY spPostingDate DESC");
    }


    function search_mystore($type, $category, $txtSearch,$pid) {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category . " AND spProfiles_idspProfiles = ".$pid." AND sellType = '".$type."'", "ORDER BY spPostingDate DESC");
    }


  function singletimelines($pid) {
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("WHERE spProfiles_idspProfiles =  $pid");
    }
    

}

?>