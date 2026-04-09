<?php

class _hidepost{

    public $dbclose = false;
    private $conn;
    public $ta;

    function __construct() {
        $this->ta = new _tableadapter("spposthide");
        $this->text = new _tableadapter("textmahesh3");
        $this->ta->dbclose = false;

        
    }
	function create33($data2) {
        $this->text->create($data2);
       

    }
	
	function read33() {
        return $this->text->read();
        
    }
	//update code
	
	function readbyidd($id) {
		return $this->text->read("WHERE id= '$id'");

    }

	
	 function update33($data,$id){
        $this->text->update($data,"WHERE id = ".$id);
    }
	
	function remove33($id){
        $this->text->remove("WHERE id = ". $id);
    }
	
	

    function create($postid, $pid) {
        $saveid = $this->ta->create(array("spPostings_idspPostings" => $postid, "spProfiles_idspProfiles" => $pid, "spPosthideFlag" => 1));
        return $saveid;

    }
    //get all hide post
    function getPost($pid){
        return $this->ta->read("WHERE spProfiles_idspProfiles = $pid ORDER BY idspPosthide DESC ");
    }
    //remove the post for hidden
    function remove($postid, $pid){
        $this->ta->remove("WHERE spProfiles_idspProfiles = $pid AND spPostings_idspPostings = $postid");
    }
    


}

?>