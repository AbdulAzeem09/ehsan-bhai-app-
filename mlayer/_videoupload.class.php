<?php 
class _videoupload
{
    public $dbclose = false;
	private $conn;
	public $ta;
	
	function __construct() { 
		$this->ta = new _tableadapter("music_audio_video");
		$this->v = new _tableadapter("spvideo");
		$this->ta->dbclose = false;
	}
	
	// INSERT VALUES OF spvideo IN DB
	function create($data){
		$id = $this->ta->create($data);
		return $id;
	}
	
	// UPDATE VIDEO 
	function update($data,$where){
		return $this->ta->update($data,$where);
	}

	// read the music path
	function readVideo($videoId){
		return $this->ta->read("WHERE idspmusicmedia = $videoId");
	}
		
    // GET ALL VIDEO  VIDEO
    function myAllPrivateVideo($pid,$private){
        return $this->ta->read(
			"INNER JOIN music_cat AS c ON c.category_id = t.category_id
			INNER JOIN music_album AS m ON m.ma_id = t.ma_id			
			INNER JOIN music_genre AS g ON g.genre_id = t.genre_id
			WHERE t.is_public = $private AND t.is_deleted = 0 AND t.spProfiles_idspProfiles = '$pid'"
		);
    }

    function allPrivateVideos($isPrivate = 0){
        return $this->ta->read(
			"INNER JOIN music_cat AS c ON c.category_id = t.category_id
			INNER JOIN music_album AS m ON m.ma_id = t.ma_id			
			INNER JOIN music_genre AS g ON g.genre_id = t.genre_id
			WHERE t.is_public = $isPrivate AND t.is_deleted = 0"
		);
    }

    // GET ALL VIDEO  VIDEO
    function video_search_all_videos($v_cat,$v_al,$state = 0) {
        return $this->ta->read(
			"
			INNER JOIN music_cat AS c ON c.category_id = t.category_id
			INNER JOIN music_album AS m ON m.ma_id = t.ma_id			
			INNER JOIN music_genre AS g ON g.genre_id = t.genre_id
			WHERE t.category_id = '".$v_cat."' AND t.ma_id = '".$v_al."' 
			AND t.is_public = $state AND t.is_deleted = 0"
		);
    }

	// GET ALL VIDEO  VIDEO
    function video_search($v_cat,$v_al,$pid,$private) {
        return $this->ta->read(
			"
			INNER JOIN music_cat AS c ON c.category_id = t.category_id
			INNER JOIN music_album AS m ON m.ma_id = t.ma_id			
			INNER JOIN music_genre AS g ON g.genre_id = t.genre_id
			WHERE t.category_id = '".$v_cat."' AND t.ma_id = '".$v_al."' 
			AND t.is_public = $private AND t.is_deleted = 0 AND t.spProfiles_idspProfiles = '$pid'"
		);
    }
	
	// MY TRASH VIDEOS
    function myTrashVideos($pid){
        return $this->ta->read("INNER JOIN music_album MA on MA.ma_id = t.ma_id
				INNER JOIN music_cat MC on MC.category_id = t.category_id
				WHERE t.is_deleted = 1");
    }
	
	// MY Latest VIDEOS
    function myLatestVideos($limit,$order_by){
        return $this->ta->read("WHERE 1=1 ORDER BY video_id $order_by LIMIT $limit");
    }	

    function add_video($data) {
		return	$this->v->create($data);
	}

	function update_video($data,$where){
		return $this->v->update($data,$where);
	}

	// GET ALL VIDEO 
    function myUploadedVideos($pid){
        return $this->v->read("WHERE spProfiles_idspProfiles = '$pid' AND video_status != 2 ORDER By video_id DESC LIMIT 10");
		//echo $this->v->sql;die('====');
    }
	
    function allplaylist($id){
        $id = $this->v->escapeString($id);
        return $this->v->read("WHERE spProfiles_idspProfiles = '$id' AND video_status != 2 ORDER By video_id DESC LIMIT 10");
		//echo $this->v->sql;die('====');
    }
	
	function myUploadedVdeos($pid){
	   $pid = $this->v->escapeString($pid);
     return $this->v->read("WHERE spProfiles_idspProfiles = '$pid' AND video_status != 2 ORDER By video_id DESC ");
	 //echo $this->v->sql;die('====');
    }
	
	
	function myUploadedVid($pid){
		return $this->v->read("WHERE spProfiles_idspProfiles = '$pid' AND video_status != 2 ORDER By video_id DESC "); 
	//echo $this->v->sql;die('====');
    }

    // GET Public VIDEO 
    function myUploadedPrivateVideos($pid,$private){
        return $this->v->read("WHERE video_visibility = $private AND spProfiles_idspProfiles = '$pid' AND video_status != 2 ORDER By video_id DESC");
    }


  function readSPVideo($videoId){
    $videoId = $this->v->escapeString($videoId);
		return $this->v->read("WHERE video_id = $videoId");
	}

	function readRecentVideos($pid,$limit,$order_by){
		return $this->v->read("WHERE spProfiles_idspProfiles = " . $pid . " ORDER BY video_id $order_by LIMIT $limit");
	}

	function countMyUploadedVideos($pid)
	{
		return $this->v->read("WHERE spProfiles_idspProfiles = " . $pid . " AND video_status != 2 ORDER By video_id DESC");
	}

	function myAlbumVideos($pid,$album_id)
	{
		return $this->v->read("WHERE spProfiles_idspProfiles = '$pid' AND video_status != 2 AND video_albumID = '$album_id' ORDER By video_id DESC");
	}

	
}
