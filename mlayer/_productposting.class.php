<?php
class _productposting
{
    public $dbclose = false;
    private $conn;
    public $ta;
    function __construct()
    {
        $this->ta2 = new _tableadapter("sppostingsartcraft");
        $this->bid = new _tableadapter("spbid");
        $this->wallet = new _tableadapter("spstorewallet");
        $this->taa = new _tableadapter("testharikesh");
        $this->tm = new _tableadapter("spprofiles");
        $this->ta = new _tableadapter("spproduct"); //spShipping
        $this->tapp = new _tableadapter("spproduct"); //spShipping 
        $this->tap = new _tableadapter("spproduct"); //spShipping
        $this->tap->join = "INNER JOIN share as d  ON t.idspPostings = d.spPostings_idspPostings";
        $this->tar = new _tableadapter(" spstore_refund_order ");
        $this->tab = new _tableadapter("spcustomers_basket"); //spShipping
        $this->tad = new _tableadapter("spfreelancer");
        $this->ts = new _tableadapter("flagpost");
        $this->pc = new _tableadapter("sppostingsartcraft");
        $this->te = new _tableadapter("spevent");
        $this->tj = new _tableadapter(" spjobboard");
        $this->tl = new _tableadapter("sprealstate");
        $this->ta->dbclose = false;
    }

    function updateship($data, $orderid)
    {
        return $this->tab->update($data, "WHERE idspOrder = $orderid");
        //echo $this->tab->sql;

    }

    function single_my_public($catid, $catName)
    {
        $catName = $this->ta->escapeString($catName);
        //return  $this->ta->read("WHERE subcategory = '$catName' ");
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND subcategory = " . $catName . " ");
        //echo $this->ta->sql;
    }

    function del_product($enqid)
    {
        $this->ta->remove("WHERE idspPostings = " . $enqid);
    }

    function readfromartcraft($id)
    {

        return $this->pc->read("WHERE idspPostings=$id");
    }

    function read_bid_wallet($id)
    {

        return $this->wallet->read("WHERE orderid=$id");
    }

    function readshiptm($uid)
    {
        return $this->tab->read("WHERE idspOrder =" . $uid);
        //echo $this->tab->sql;
    }

    function readshipstatus($uid)
    {
        return $this->tab->read("WHERE idspOrder =$uid");
    }

    function flagcount($categorys, $uid)
    {
		
        return $this->ts->read("WHERE spCategory_idspCategory=$categorys AND spPosting_idspPosting =$uid");
    }

    function create($data)
    {
        $postid = $this->ta->create($data);
        return $postid;

        //echo $this->ta->sql; die("-----------------");
    }



    //this is my code
    function creathari($data)
    {
        $this->taa->create($data);
    }
    function delhari($enqid)
    {
        $this->taa->remove("WHERE id= " . $enqid);
    }
    //read 
    function readhari()
    {
        return $this->taa->read();
    }

    function readbyid($id)
    {
        return $this->taa->read("WHERE id=" . $id);
    }

    //update 

    function updatehari($data, $id)
    {
        $this->taa->update($data, "WHERE id ='" . $id . "'");
    }

    //end my code



    function insertrefund($data)
    {

        return $this->tar->create($data);
        //echo $this->tar->sql;
        //die("++++++++++++++++++");

        //return $postid;
    }

    function readdata($uid, $pid)
    {
      
      $condition = "WHERE idspPostings = $uid AND spProfiles_idspProfiles = $pid";

      return $this->ta->read($condition);
    }


    function read($uid)
    {
        $uid = $this->ta->escapeString($uid);
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE idspPostings =" . $uid);
        //echo $this->ta->sql;die('===========111');
    }
    function readuserids($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return  $this->tm->read("WHERE idspProfiles =" . $uid);
    }
    function readuser($pid,$uid)
    {
      $condition = "WHERE t.idspProfiles = $pid AND t.spUser_idspUser = $uid";
      return $this->tm->read($condition);
      //return $this->tm->sql; //die('------------'); 

    }
    function readprofiles($uid)
    {
        $uid = $this->ta->escapeString($uid);
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE idspPostings =" . $uid);
    }

    function readnow($uid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->tab->read("WHERE idspPostings =" . $uid);
    }

    function read_sku($sku)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return  $this->ta->read("WHERE t.skucode =  '$sku' ");
        //echo $this->ta->sql; die("-------------");

    }

    function read1($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->tad->read("WHERE spProfiles_idspProfiles =" . $pid);
    }
    function read2($catid, $pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return  $this->ta->read("WHERE spProfiles_idspProfiles =$pid AND spCategories_idspCategory= $catid");
        //echo $this->ta->sql;die;

    }

    function publicpost_two()
    {
        return $this->ta->read("WHERE spCategories_idspCategory = 1 AND spPostingVisibility=-1 AND spPostingExpDt >= CURDATE()", " ORDER BY idspPostings ASC LIMIT 4");
    }

    function activate_product($postid)
    {
        return $this->ta->update(array("spPostingVisibility" => "-1"), " WHERE idspPostings ='" . $postid . "'");
    }
    function productstatus($products)
    {
        return    $this->ta->update(array("spPostingsFlag" => "1"), " WHERE idspPostings ='" . $products . "'");
    }
    function jobboardstatus($products)
    {
        return    $this->tj->update(array("flag_status" => "1"), " WHERE idspPostings ='" . $products . "'");
    }
    function artstatus($products)
    {
        return    $this->pc->update(array("flag_status" => "1"), " WHERE idspPostings ='" . $products . "'");
    }
    function eventstatus($products)
    {
        return    $this->te->update(array("flag_status" => "1"), " WHERE idspPostings ='" . $products . "'");
    }
    function realstatus($products)
    {
        return    $this->tl->update(array("spPostingsFlag" => "1"), " WHERE idspPostings ='" . $products . "'");
    }

    function freelancerstatus($products)
    {
        return    $this->tad->update(array("spPostingsFlag" => "1"), " WHERE idspPostings ='" . $products . "'");
    }

    function myActPost($pid, $visilty, $catid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = " . $visilty . " AND spProfiles_idspProfiles = " . $pid . " AND t.idspCategory = $catid", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }


    function refferaluserproduct($uid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ") ", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql; die('=========');
    }



    // SHOW SINGLE FRIEND STORE
    function singlefriendstore($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = 1 AND t.spProfiles_idspProfiles =" . $pid, "ORDER BY spPostingDate DESC");
    }

    //show only single profile data
    function getAllStoreProduct($pid)
    {
        return $this->ta->read("INNER JOIN spprofiles_has_spgroup AS g ON g.spProfiles_idspProfiles = t.spProfiles_idspProfiles WHERE t.spPostingVisibility = -1 AND t.spCategories_idspCategory = 1 AND t.spProfiles_idspProfiles =" . $pid, "GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }

    function readprofile($pid)
    {
        //return $this->ta->read("WHERE spProfiles_idspProfiles =".$pid);
        return $this->ta->read("WHERE spProfiles_idspProfiles =" . $pid);
    }
    
    function update($data, $pid)
    {
        return $this->ta->update($data, $pid);
    }

    function auctionproductpost($catid)
    {


        return $this->ta->read("WHERE spPostingVisibility=0 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");

        //echo $this->ta->sql; die;
    }

    function activeprevpost($postid)
    {
        //die('====')
        return $this->ta->update(array("spPostingVisibility" => "-1"), "WHERE idspPostings ='" . $postid . "'");
        //echo $this->ta->sql;die('==');
    }


    function allauctionproduct($catid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' ORDER BY spPostingExpDt DESC");
    }
    function allretailproductnumrows($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt > CURDATE() AND sellType = 'Retail' ORDER BY spPostingExpDt DESC ");
        // echo $this->ta->sql; die('==');
    }

    function allretailproduct($catid, $pid, $start, $limitaa)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1  AND spcategories_idspcategory = 1 AND spPostingExpDt > CURDATE() AND sellType = 'Retail' ORDER BY spPostingExpDt DESC  limit $start, $limitaa");
        //echo $this->ta->sql; die('==');
    }

    
    function allretailproduct_retails($catid, $pid, $start, $limitaa)
    {
       return  $this->tapp->read("WHERE spPostingVisibility=-1  AND spcategories_idspcategory = 1 AND spPostingExpDt > CURDATE() AND sellType = 'Retail' ORDER BY spPostingExpDt DESC limit $start, $limitaa");
    }
    
    
    function allretailproduct_heigestprice($catid, $pid, $start, $limitaa)
    {
        return   $this->ta->read("WHERE spPostingVisibility=-1  AND spcategories_idspcategory = 1 AND spPostingExpDt > CURDATE() AND sellType = 'Retail' ORDER BY retailSpecDiscount DESC LIMIT 1");
        //echo $this->ta->sql; die('==');
    }

    function allretailproduct1($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt > CURDATE() AND sellType = 'Retail' ORDER BY spPostingExpDt DESC");
        // echo $this->ta->sql; die('==');
    }
    function allretaillimitedproduct($catid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC LIMIT 15");
    }

    function allwholesaleproduct($catid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE()");
    }

    function allwholeSaleProfiles()
    {
        return $this->ta->read("INNER JOIN spprofiles as f ON t.spProfiles_idspProfiles = f.idspprofiles where t.spPostingVisibility=-1 and t.spCategories_idspCategory = 1 and t.spPostingsFlag = 0 AND t.sellType = 'wholesale' group by t.spProfiles_idspProfiles");
    }

    function limitallauctionproduct($catid, $pid)
    {

        //$date =date('Y-m-d');

        // return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt > '$date' AND //sellType = 'Auction' AND status='0'  ORDER BY idspPostings DESC LIMIT 5");

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE() AND spPostingsFlag='2' ORDER BY idspPostings DESC LIMIT 10");
        // echo  $this->ta->sql;
    }

    function limitallretailproduct($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE() AND spPostingsFlag='2' ORDER BY idspPostings DESC LIMIT 10");
        // echo  $this->ta->sql; die('====');
    }

    function limitallpersonalproduct($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Personal' AND spPostingExpDt >= CURDATE() AND spPostingsFlag='2' ORDER BY idspPostings DESC LIMIT 10");
        // echo  $this->ta->sql; die('====');
    }

    function limit_all_product($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE()  AND spPostingExpDt >= CURDATE()  ORDER BY idspPostings DESC ");
        // echo  $this->ta->sql; die('====');
    }

    function all_share_product($catid, $pid, $groupid)
    {

        return $this->tap->read("WHERE t.spPostingVisibility=-1 AND d.spCategories_idspCategory = " . $catid . " AND t.spPostingExpDt >= CURDATE()  AND t.spPostingExpDt >= CURDATE() AND t.spPostingsFlag='2' AND d.spShareToGroup = " . $groupid . " ORDER BY t.idspPostings DESC ");
        // echo  $this->ta->sql;
    }

    function limitallwholesaleproduct($catid, $pid)
    {
        return  $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE()AND status='0' ORDER BY idspPostings DESC LIMIT 5");

        //echo   $this->ta->sql;
    }


    function limitDESCretailsort($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Retail' ORDER BY retailSpecDiscount DESC LIMIT 5");
        //echo   $this->ta->sql;die('=======');
    }


    
    function limitDESCretailsort_p($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Personal' ORDER BY retailSpecDiscount DESC LIMIT 5");
        //echo   $this->ta->sql;die('=======');
    }

    function limitASCretailsort($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Retail'AND spPostingsFlag='2' ORDER BY retailSpecDiscount ASC LIMIT 5");
    }

    function limitASCretailsort_p($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Personal'AND spPostingsFlag='2' ORDER BY retailSpecDiscount ASC LIMIT 5");
    }

    function limitDESCwholesellsort($catid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' ORDER BY spPostingPrice DESC LIMIT 5");
    }

    function limitASCwholesellsort($catid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' ORDER BY spPostingPrice ASC LIMIT 5");
    }

    function limitDESCauctionsort($catid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' ORDER BY spPostingPrice DESC LIMIT 5");
    }

    function limitASCauctionsort($catid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' ORDER BY spPostingPrice ASC LIMIT 5");
    }



    /*yadnn*/

    function readDESCretailsort($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Retail' ORDER BY retailQuantity DESC");
        //echo  $this->ta->sql; die('-----');
    }
    function readDESCretailsort_p($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Personal' ORDER BY retailSpecDiscount DESC");
        //echo  $this->ta->sql; die('-----');
    }

    function readASCretailsort($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Retail' ORDER BY retailQuantity ASC");
    }
    function readASCretailsort_p($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Personal' ORDER BY retailSpecDiscount ASC");
    }

    function readDESCwholesellsort($catid, $pid, $start, $limit)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' ORDER BY spPostingPrice DESC" . ' ' . "limit $start,$limit");
    }

    function readASCwholesellsort($catid, $pid, $start, $limit)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' ORDER BY spPostingPrice ASC" . ' ' . "limit $start,$limit");
    }

    function readDESCauctionsort($catid, $pid)
    {

        return  $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Auction' ORDER BY spPostingPrice DESC");
        //echo $this->ta->sql;
    }

    function readASCauctionsort($catid, $pid)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND  spPostingExpDt >= CURDATE() AND sellType = 'Auction' ORDER BY spPostingPrice ASC");
    }

    function myretailDESCproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Retail' AND spPostingExpDt >= CURDATE() ORDER BY spPostingPrice DESC");
    }

    function myretailASCproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Retail' AND spPostingExpDt >= CURDATE() ORDER BY spPostingPrice ASC");
    }


    function myWholesalerDESCproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE() ORDER BY spPostingPrice DESC");
    }

    function myWholesalerASCproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE() ORDER BY spPostingPrice ASC");
    }

    function myAuctionDESCproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Auction' AND spPostingExpDt >= CURDATE() ORDER BY spPostingPrice DESC");
    }

    
    function myAuctionASCproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Auction' AND spPostingExpDt >= CURDATE() ORDER BY spPostingPrice ASC");
    }

    function myallretailproduct_pp($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Personal' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC");
         //echo $this->ta->sql;
         //die("mk");
         
    }

    function myallretailproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC ");
    }

    function getproductlist($catid, $sell_type, $offset, $limit)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE() AND sellType = '" . $sell_type . "' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC LIMIT " . $offset . ", " . $limit . "");
    }


    function getallproductlist($catid, $offset, $limit)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spPostingExpDt >= CURDATE()  ORDER BY idspPostings DESC LIMIT " . $offset . ", " . $limit . "");
    }


    function myallwholesaleproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . "  AND spProfiles_idspProfiles = " . $pid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC ");
        //echo $this->ta->sql;
        //die("mm");
    }

    function myallauctionproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND spPostingExpDt >= CURDATE() AND sellType = 'Auction' AND spPostingExpDt >= CURDATE() ORDER BY idspPostings DESC ");
    }


    /*  function allretailfavrouiteproduct($catid,$postid) {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND idspPostings = " . $postid . "  AND spPostingExpDt >= CURDATE() AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()");
    }*/


    /* function allretailfavrouiteproduct($catid,$postid) {
        
        return $this->ta->read("INNER JOIN spstorefavorites as d ON t.spProfiles_idspProfiles  = d.spProfiles_idspProfiles WHERE t.spPostingVisibility=-1 AND t.spCategories_idspCategory = " . $catid . " AND d.spPostings_idspPostings = " . $postid . "  AND t.spPostingExpDt >= CURDATE() AND t.sellType = 'Retail' AND t.spPostingExpDt >= CURDATE()");


    }*/


    function readallfavrouiteproduct($catid, $pid)
    {

        return  $this->ta->read("INNER JOIN spstorefavorites as d ON t.idspPostings  = d.spPostings_idspPostings WHERE d.spProfiles_idspProfiles =  " . $pid . " AND t.spCategories_idspCategory = " . $catid . " ");
        //  echo $this->ta->sql;
        //  die("++++++");
    }


    function allretailfavrouiteproduct($catid, $pid)
    {

        return $this->ta->read("INNER JOIN spstorefavorites as d ON t.idspPostings  = d.spPostings_idspPostings WHERE d.spProfiles_idspProfiles =  " . $pid . " AND t.spCategories_idspCategory = " . $catid . "  ORDER BY t.idspPostings desc ");
        //echo $this->ta->sql;
          
    }

    function myallfavrouiteproduct($catid, $pid)
    {

        return $this->ta->read("INNER JOIN spstorefavorites as d ON t.idspPostings  = d.spPostings_idspPostings WHERE d.spProfiles_idspProfiles =  " . $pid . " AND t.spCategories_idspCategory = " . $catid . "  AND t.spPostingExpDt >= CURDATE()");
    }


    function allwholesalefavrouiteproduct($catid, $pid)
    {

        return $this->ta->read("INNER JOIN spstorefavorites as d ON t.idspPostings  = d.spPostings_idspPostings WHERE d.spProfiles_idspProfiles =  " . $pid . " AND t.spCategories_idspCategory = " . $catid . " AND t.sellType = 'Wholesale' AND t.spPostingExpDt >= CURDATE()");
        // echo  $this->ta->sql; die('-----');
    }


    function allauctionfavrouiteproduct($catid, $pid)
    {

        return $this->ta->read("INNER JOIN spstorefavorites as d ON t.idspPostings  = d.spPostings_idspPostings WHERE d.spProfiles_idspProfiles =  " . $pid . " AND t.spCategories_idspCategory = " . $catid . " AND t.sellType = 'Auction' AND t.spPostingExpDt >= CURDATE()");
    }
    function all__Personal($catid, $pid)
    {

        return $this->ta->read("INNER JOIN spstorefavorites as d ON t.idspPostings  = d.spPostings_idspPostings WHERE d.spProfiles_idspProfiles =  " . $pid . " AND t.spCategories_idspCategory = " . $catid . " AND t.sellType = 'Personal' AND t.spPostingExpDt >= CURDATE()");
        // echo  $this->ta->sql; die('-----');
    }

    function myactiveauctionbid($pid)
    {

        
        return $this->bid->read(" WHERE spProfiles_idspProfiles = $pid ");
        echo  $this->bid->sql; die('-----');
    }

    function active_auction_bid($pid)
    {
        return $this->bid->read("WHERE spProfiles_idspProfiles=$pid and status=0 ");
        echo $this->bid->sql;
    }
    function awarded_auction_bid($pid)
    {
        return $this->bid->read("WHERE spProfiles_idspProfiles=$pid and status=1");
    }
    function paid_auction_bid($pid)
    {
        return $this->bid->read("WHERE spProfiles_idspProfiles=$pid and status=3");
        echo $this->bid->sql;
    }

    function myallactiveproduct($pid)
    {

        return $this->ta->read(" WHERE t.spProfiles_idspProfiles =  " . $pid . " AND t.spPostingVisibility=-1 AND t.spPostingExpDt >= CURDATE()");
    }



    function mydeactiveauctionbid($pid)
    {

        /*return $this->ta->read("INNER JOIN spbid as d ON t.idspPostings  = d.spPostings_idspPostings WHERE  d.auctionPrice = (SELECT MAX(auctionPrice) FROM spbid WHERE t.idspPostings  = d.spPostings_idspPostings) AND t.sellType = 'Auction' AND t.spPostingExpDt < CURDATE()");*/

        return $this->ta->read("INNER JOIN spbid as d ON t.idspPostings  = d.spPostings_idspPostings WHERE  d.auctionPrice = (SELECT MAX(auctionPrice) FROM spbid WHERE t.idspPostings  = d.spPostings_idspPostings) AND t.sellType = 'Auction' AND t.spPostingExpDt < CURDATE()");
    }


    function getexpiredproductbid($pid)
    {


        return $this->ta->read("INNER JOIN spbid as d ON t.idspPostings = d.spPostings_idspPostings WHERE d.spProfiles_idspProfiles =  " . $pid . " AND t.sellType = 'Auction' AND t.spPostingExpDt < CURDATE() AND  d.status = 0");
    }





    function auctionquantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid . " AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
    }

    function retailquantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid . " AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
    }

    function wholesalequantity($postid)
    {
        return $this->ta->read("WHERE idspPostings = " . $postid . " AND (spPostFieldLabel = 'Limited Quantity' OR spPostFieldLabel ='Ticket Capacity' OR spPostFieldLabel ='Supply Ability' OR spPostFieldName ='retailQuantity_')");
    }

    // TOTAL NUMBER OF PRODUCT WHICH USER POST
    function publicpost_count($pid)
    {
        return $this->ta->read("WHERE spPostingVisibility = -1 AND spCategories_idspCategory = 1 AND spProfiles_idspProfiles = " . $pid, " AND spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }

    function publicpost_count_artcraft($pid)
    {
        return $this->ta2->read("WHERE spPostingVisibility = -1 AND spCategories_idspCategory = 13 AND spProfiles_idspProfiles = " . $pid, " AND spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }


    function seller_product($sellerid)
    {
        return $this->ta->read("where spPostingVisibility=-1 and spProfiles_idspProfiles ='$sellerid' AND spCategories_idspCategory = 1 GROUP BY idspPostings ORDER BY RAND() LIMIT 3");
    }

    function moreseller_product($sellerid, $postid)
    {
        $postid = $this->ta->escapeString($postid);
        return $this->ta->read("where spPostingVisibility=-1 and spProfiles_idspProfiles ='$sellerid' AND spCategories_idspCategory = 1 and idspPostings != '$postid' GROUP BY idspPostings ORDER BY RAND() LIMIT 3");
    }

    function myretailgroupproduct($catid, $gname)
    {
        return $this->ta->read("WHERE spCategories_idspCategory = " . $catid . " AND spgroup = 
            '$gname' AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()");
    }

    function myretailgroupproductlimit($catid, $gname)
    {
        return $this->ta->read("WHERE spCategories_idspCategory = " . $catid . " AND spgroup = 
            '$gname' AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()", "ORDER BY spPostingDate DESC LIMIT 5");
    }

    function mywholesalegroupproduct($catid, $gname)
    {
        return $this->ta->read("WHERE spCategories_idspCategory = " . $catid . " AND spgroup = 
            '$gname' AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE()");
    }


    function mywholesalegroupproductlimit($catid, $gname)
    {
        return $this->ta->read("WHERE spCategories_idspCategory = " . $catid . " AND spgroup = 
            '$gname' AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE()", "ORDER BY spPostingDate DESC LIMIT 5");
    }

    function myauctiongroupproduct($catid, $gname)
    {
        return $this->ta->read("WHERE spCategories_idspCategory = " . $catid . " AND spgroup = 
            '$gname' AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
    }

    function myauctiongroupproductlimit($catid, $gname)
    {
        return $this->ta->read("WHERE spCategories_idspCategory = " . $catid . " AND spgroup = 
            '$gname' AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()", "ORDER BY spPostingDate DESC LIMIT 5");
    }


    function myretailproduct_pp($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Personal' AND spPostingExpDt >= CURDATE()");
         //echo $this->ta->sql;

    }




    function myretailproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()");
    }

    function friendProduct($catid, $pid)
    {
        return  $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . "  AND spPostingExpDt >= CURDATE()");
        //echo $this->ta->sql;
    }

    function friendProductlimit($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . "  AND spPostingExpDt >= CURDATE() LIMIT 12");
    }

    function friendProductlimitmore($catid, $pid, $row, $rowperpage)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . "  AND spPostingExpDt >= CURDATE() LIMIT $row, $rowperpage");
    }


    function myretailproductlimit($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Retail' AND spPostingExpDt >= CURDATE()", "ORDER BY spPostingDate DESC LIMIT 5");
    }

    function mywholesaleproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Wholesale' AND spPostingExpDt >= CURDATE()");
         //echo $this->ta->sql;

    }


    function myauctionproduct($catid, $pid)
    {
        return $this->ta->read("WHERE spPostingVisibility=-1 AND spCategories_idspCategory = " . $catid . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = 'Auction' AND spPostingExpDt >= CURDATE()");
        //echo $this->ta->sql;
    }

    function readprice($postid)
    {
        return $this->ta->read("WHERE t.spPostings_idspPostings =" . $postid . " AND spPostFieldName ='spPostingPriceHourly_ ' AND spPostFieldValue = 1");
    }

    //my sote product with specefic profile
    function myStoreProduct($pid)
    {
        
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . (int)$pid . " AND t.spCategories_idspCategory = 1", " ORDER BY spPostingDate DESC");

    }

    function reatilactiveProduct($pid)
    {
        return   $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.sellType = 'Retail' AND t.spCategories_idspCategory = 1", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
        //echo     $this->ta->sql; die("-------------------");

    }
    function reatilactiveProduct_Personal($pid)
    {
        return   $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.sellType = 'Personal' AND t.spCategories_idspCategory = 1", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
        //echo     $this->ta->sql; die("-------------------");

    }
    function wholesaleactiveProduct($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.sellType = 'Wholesale' AND t.spCategories_idspCategory = 1", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }

    function auctionactiveProduct($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.sellType = 'Auction' AND t.spCategories_idspCategory = 1", "AND t.spPostingExpDt >= CURDATE() ORDER BY spPostingDate DESC");
    }



    function auctionexpiredProduct($pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = -1 AND t.spProfiles_idspProfiles = " . $pid . " AND t.sellType = 'Auction' AND t.spCategories_idspCategory = 1", "AND t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");
    }





    // SHOW ALL PRODUCT BY VISIBITLTY AND MODULE WISE
    function myProductVis($pid, $visilty, $catid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility = " . $visilty . " AND t.spProfiles_idspProfiles = " . $pid . " AND t.spCategories_idspCategory = $catid", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;
    }

    // MY DRAFT PRODUCTS PROFILE AND CATEGORY WISE
    function readMyDraftprofile($catid, $pid)
    {
        //return $this->ta->read("WHERE t.idspProfiles = " . $profileid . " AND t.spPostingVisibility=0");
        return  $this->ta->read("WHERE t.spProfiles_idspProfiles =" . $pid . " AND t.spCategories_idspCategory = $catid AND t.spPostingVisibility = 0", "ORDER BY spPostingDate DESC");
        //echo  $this->ta->sql; die;
    }


    // MY EXPIRE PRODUCT
    function myExpireProduct($catId, $pid)
    {
        /* return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = $catId AND t.spPostingVisibility != -3 OR t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");*/
        return $this->ta->read("WHERE t.spProfiles_idspProfiles = $pid AND t.spCategories_idspCategory = $catId AND t.spPostingVisibility != -3 AND t.spPostingExpDt < CURDATE() ORDER BY spPostingDate DESC");
    }




    function allwholesellpost($pid, $start, $limit)
    {
        return  $this->ta->read("where t.sppostingvisibility=-1 AND t.spCategories_idspCategory = 1 AND  t.sppostingsflag = 0 AND spPostingExpDt > CURDATE() AND t.sellType = 'Wholesale' GROUP BY idspPostings ORDER BY spPostingDate DESC LIMIT 5");
        //echo $this->ta->sql;die('22');
    }

    // ==============END=================
    function auction($type, $uid, $pid)
    {
        if ($type == 'auction') {
            return  $this->ta->read(" where t.sppostingvisibility=-1 and t.spCategories_idspCategory = 1 AND t.spPostingExpDt > CURDATE() AND t.sellType = '$type' GROUP BY idspPostings ORDER BY spPostingDate DESC");

            //echo $this->ta->sql;
        } else if ($type == 'buypost') {
            return $this->ta->read("where t.spProfiles_idspProfiles = '$uid' AND t.sppostingvisibility=-1 and AND  t.spCategories_idspCategory = 1 AND t.sellType <> 'auction' GROUP BY idspPostings ORDER BY spPostingDate DESC");
        }
    }
    function auction_heigestprice($type, $uid, $pid)
    {
        return $this->ta->read(" where t.sppostingvisibility=-1 and t.spCategories_idspCategory = 1 AND t.spPostingExpDt > CURDATE() AND t.sellType = '$type' GROUP BY idspPostings ORDER BY spPostingPrice DESC limit 1");
        //echo $this->ta->sql;
        //die('========');
    }

    function readitemcondtion_product($folder, $condition, $pid)
    {
        $condition = $this->ta->escapeString($condition);
        return $this->ta->read("where t.sppostingvisibility=-1 AND  t.spCategories_idspCategory = 1 AND t.retailStatus = '$condition' AND t.sellType = '$folder'AND t.spPostingExpDt > CURDATE() ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;
        //die('========');      
    }
    function condtion_product_heigestprice($folder, $condition, $pid)
    {
        return $this->ta->read("where t.sppostingvisibility=-1 AND  t.spCategories_idspCategory = 1 AND t.retailStatus = '$condition' AND t.sellType = '$folder'AND t.spPostingExpDt > CURDATE() ORDER BY spPostingPrice DESC limit 1");
    }


    function readitemcondtion_auctionproduct($type, $condition, $pid)
    {

        return $this->ta->read("where t.sppostingvisibility=-1 AND t.spCategories_idspCategory = 1 AND t.auctionStatus = '$condition' AND t.sellType = '$type' AND 
             t.spPostingExpDt > CURDATE() ORDER BY spPostingDate DESC");
    }
    function readitemcondtion_storeproduct($condition)
    {
        $condition = $this->ta->escapeString($condition);
        return $this->ta->read("where t.sppostingvisibility=-1 AND t.auctionStatus = '$condition' AND t.spPostingExpDt > CURDATE() ORDER BY spPostingDate DESC");
        // echo $this->ta->sql;
        //die('======');

    }
    function condtion_auction_heigestprice_product($type, $condition, $pid)
    {

        return $this->ta->read("where t.sppostingvisibility=-1 AND t.spCategories_idspCategory = 1 AND t.auctionStatus = '$condition' AND t.sellType = '$type' AND 
  t.spPostingExpDt > CURDATE() ORDER BY spPostingPrice DESC limit 1");
        //echo $this->ta->sql;
        //die('======');

    }


    function readitemauction_product($type, $pid)
    {

        $date = date('Y-m-d');

        return $this->ta->read("where t.sppostingvisibility=-1 AND t.spCategories_idspCategory = 1 AND t.sellType = '$type' AND t.spPostingExpDt > '$date'  GROUP BY idspPostings ORDER BY spPostingDate DESC");
    }

    function auction_product_higest_price($type, $pid)
    {

        $date = date('Y-m-d');

        return $this->ta->read("where t.sppostingvisibility=-1 AND t.spCategories_idspCategory = 1 AND t.sellType = '$type' AND t.spPostingExpDt > '$date'  GROUP BY idspPostings ORDER BY spPostingPrice DESC LIMIT 1");
        //echo $this->ta->sql;
        //die('==');
    }


    function updateQty($postid, $newQty)
    {
        $this->ta->update(array("retailQuantity" => $newQty), "WHERE  idspPostings = $postid");
    }


    function updateQtywholesaler($postid, $newQty)
    {
        $this->ta->update(array("supplyability" => $newQty), "WHERE  idspPostings = $postid");
    }

    function trashpost($postid)
    {
        $this->ta->update(array("spPostingVisibility" => -3), "WHERE t.idspPostings = " . $postid);
    }
    function delete_item($postid)
    {
        $this->ta->remove("WHERE t.idspPostings = " . $postid);
    }


    //MY ALL STORE SEARCCH
    function search_myall_store($uid, $txtSearch)
    {
        return $this->ta->read("WHERE d.spUser_idspUser = " . $uid . " AND t.spPostingTitle  like ('" . $txtSearch . "%') AND t.spCategories_idspCategory =1", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;die('=');
    }

    //MY ALL STORE DATA
    function read_all_store($pid)
    {
        $pid = $this->ta->escapeString($pid);
        return  $this->ta->read("WHERE t.spProfiles_idspProfiles = " . $pid . "  AND t.spCategories_idspCategory =1", "ORDER BY spPostingDate DESC");
        // echo $this->ta->sql;
        //die('=');
    }


    //friend store SEARCH
    function search_store_friends_Posting($uid, $txtSearch)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('" . $txtSearch . "%')  AND t.spCategories_idspCategory = 1 AND t.spProfiles_idspProfiles in(select spProfiles_idspProfiles from spProfiles_has_spGroup where spGroup_idspGroup in (select  spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles in(Select idspProfiles from spProfiles where spUser_idspUser=" . $uid . ")))", "ORDER BY spPostingDate DESC");
    }

    //All group store search
    function search_all_group_store($pid, $txtSearch)
    {
        return $this->ta->read("WHERE t.spCategories_idspCategory = 1 AND t.spPostingTitle  like ('" . $txtSearch . "%') AND t.idspPostings in (select spPostings_idspPostings from spShare where spShareToGroup in (select spGroup_idspGroup from spProfiles_has_spGroup where spProfiles_idspProfiles = " . $pid . "))", "ORDER BY spPostingDate DESC");
    }

    //PUBLIC POST SEARCH
    function search_publicpost($start, $category, $txtSearch)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category, "ORDER BY spPostingDate DESC");
    }

    //PUBLIC POST SEARCH
    function searchProductsByTypeAndText($start, $category, $txtSearch, $sellType)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category . " AND t.sellType = '$sellType'", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;die('=');
    }
    function searchProductsByAll($start, $category, $txtSearch)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category . " ", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;die('=');
    }
    function search_store($type, $category, $txtSearch)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category . " AND sellType = '" . $type . "'", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;die("===========");
    }
    function search_personal( $category, $txtSearch)
    {
         return $this->ta->read("WHERE t.spPostingVisibility=-1  AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category . " ", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;die;
    }


    function search_mystore($type, $category, $txtSearch, $pid)
    {
        return $this->ta->read("WHERE t.spPostingVisibility=-1 AND t.spPostingTitle  like ('%" . $txtSearch . "%') AND t.spCategories_idspCategory = " . $category . " AND spProfiles_idspProfiles = " . $pid . " AND sellType = '" . $type . "'", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;
       // die("mmm");
    }


    function singletimelines($pid)
    {
        //return $this->ta->read("WHERE idspCategory = 16 AND t.idspPostings = " . $postid);
        return $this->ta->read("WHERE spProfiles_idspProfiles =  $pid");
    }


    function myretail_store_prange($condition, $start, $end, $exp)
    {
        $condition = $this->ta->escapeString($condition);
        return $this->ta->read("WHERE spPostingPrice BETWEEN $start AND $end AND sellType = 'Retail' AND retailStatus = '" . $condition . "' AND spPostingExpDt > '" . $exp . "'", "ORDER BY spPostingDate DESC");
    }

    function myretailall_store_prange($start, $end, $exp)
    {

        return $this->ta->read("WHERE spPostingVisibility=-1 AND retailSpecDiscount  BETWEEN $start AND $end AND sellType = 'Retail' AND spPostingExpDt > '" . $exp . "'", "ORDER BY spPostingDate DESC");
        //echo $this->ta->sql;
        //die('11');
    }

    function myauction_store_prange($condition, $start, $end, $exp)
    {
        $condition = $this->ta->escapeString($condition);
        return $this->ta->read("WHERE spPostingPrice BETWEEN $start AND $end AND sellType = 'Auction' AND auctionStatus = '" . $condition . "' AND spPostingExpDt > '" . $exp . "'", "ORDER BY spPostingDate DESC");
    }

    function myauctionall_store_prange($start, $end, $exp)
    {
        return $this->ta->read("WHERE spPostingPrice BETWEEN $start AND $end AND sellType = 'Auction' AND spPostingExpDt > '" . $exp . "'", "ORDER BY spPostingDate DESC");
    }

    function spPostingDate($firstTime, $lastTime = '')
    {
        date_default_timezone_set('Asia/Karachi');
        //date_default_timezone_set('Asia/Kolkata');
        //echo date_default_timezone_get();
        if ($lastTime) {
            $now = new DateTime(date('Y-m-d h:i:s', strtotime($lastTime)));
        } else {
            $now = new DateTime(date('Y-m-d h:i:s'));
        }
        $then = new DateTime(date('Y-m-d h:i:s', strtotime($firstTime)));
        $diff = $then->diff($now);
        $time_ago = array('years' => $diff->y, 'months' => $diff->m, 'days' => $diff->d, 'hours' => $diff->h, 'minutes' => $diff->i, 'seconds' => $diff->s);

        if ($time_ago['years'] > 0) {
            return $time_ago['years'] . ' year ago';
        } else if ($time_ago['months'] > 0) {
            return $time_ago['months'] . ' month ago';
        } else if ($time_ago['days'] > 0) {
            if ($time_ago['days'] == 1) {
                return $time_ago['days'] . ' day ago';
            } else {
                return $time_ago['days'] . ' days ago';
            }
        } else if ($time_ago['hours'] > 0) {
            return $time_ago['hours'] . ' hours ago';
        } else if ($time_ago['minutes'] > 0) {
            return $time_ago['minutes'] . ' min ago';
        } else {
            return $time_ago['seconds'] . ' sec just now';
        }
    }

    function get_timeago($ptime)
    {
        date_default_timezone_set('Asia/Karachi');

        $estimate_time = time() - $ptime;
        if ($estimate_time < 1) {
            return 'less than 1 second ago';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  ' second'
        );
        foreach ($condition as $secs => $str) {
            $d = $estimate_time / $secs;
            if ($d >= 1) {
                $r = round($d);
                return '' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }

    function turnUrlIntoHyperlink($string)
    {
        //The Regular Expression filter
        $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";

        // Check if there is a url in the text
        if (preg_match_all($reg_exUrl, $string, $url)) {
            // Loop through all matches
            foreach ($url[0] as $newLinks) {
                if (strstr($newLinks, ":") === false) {
                    $link = 'http://' . $newLinks;
                } else {
                    $link = $newLinks;
                }

                // Create Search and Replace strings
                $search  = $newLinks;
                $replace = '<a href="' . $link . '" title="' . $newLinks . '" target="_blank">' . $link . '</a>';

                $isyoutube = $this->videoType($newLinks);
                if ($isyoutube) {
                    // ===SHOW YOUTUBE VIDEO
                    parse_str(parse_url($newLinks, PHP_URL_QUERY), $my_array_of_vars);
                    $string = str_replace($search, '', $string);
                    $string .= '<iframe style="width: 100%;" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] . '" frameborder="0" allowfullscreen></iframe>';
                } else {
                    // ===SHOW ONLY LINKS
                    $string = str_replace($search, $replace, $string);
                }
            }
        }
        //Return result
        return $string;
    }
}
