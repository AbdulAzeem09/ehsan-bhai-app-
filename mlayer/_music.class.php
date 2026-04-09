<?php 
class _music
{
    public $dbclose = false;
	private $conn;
	public $ta;
	public $ca;
	public $mg;
	public $mav;
	public $ly;
	public $maf;
	public $masf;
	
	function __construct() { 
		$this->ta 	= new _tableadapter("music_album");
		$this->ca 	= new _tableadapter("music_cat");
		$this->mg 	= new _tableadapter("music_genre");
		$this->mav 	= new _tableadapter("music_audio_video");
		$this->ly 	= new _tableadapter("music_lyrics");
		$this->maf 	= new _tableadapter("music_album_favorites");
		$this->masf = new _tableadapter("music_album_song_favorites");
		$this->mp 	= new _tableadapter("music_playlist");
		$this->cp   = new _tableadapter("createplaylist");
		$this->mc   = new _tableadapter("music_cat");
		
		 
		$this->ta->dbclose = false;
		$this->ca->dbclose = false;
		$this->mg->dbclose = false;
		$this->mav->dbclose = false;
		$this->ly->dbclose = false;
		$this->maf->dbclose = false;
		$this->masf->dbclose = false;
		$this->mp->dbclose = false;
		$this->cp->dbclose = false;
	} 
	
	function create($data)
	{
		return	$this->ta->create($data);
	}
	
	//read all album
	function readAll($pid){
		return $this->ta->read("where spProfiles_idspProfiles = '$pid'","order by ma_id desc");
	}
	
	function remove($ma_id) {
        $this->ta->remove("WHERE ma_id = " . $ma_id);
    }
	
	function remove_song($mav_id) {
        $this->mav->remove("WHERE mav_id = " . $mav_id);
    }
	
	function update_public($ma_id,$ispublic)
	{
		return $this->ta->update(array("ispublic" => $ispublic), "WHERE ma_id ='" . $ma_id . "'");
		///////
	}
	
	function get_category()
	{
		return $this->ca->read();
	}
	
	function get_genre()
	{
		return $this->mg->read();
	}
	
	function get_album()
	{
		return $this->ta->read();
	}
	
	function add_audio_video($data)
	{
		return	$this->mav->create($data);
	}

	function update_audio_video($data, $id)
	{
		return	$this->mav->update($data, "WHERE mav_id=". $id);
	}
	
	function readVideo($ma_id)
	{
		//SELECT COUNT(ma_id) FROM `music_audio_video` where ma_id = 8 
		return $this->mav->read("where ma_id = $ma_id","","COUNT(ma_id) as totalvideo");
	}
	
	function get_video($ma_id)
	{
		return $this->mav->read("
		INNER JOIN music_cat AS c ON t.category_id = c.category_id
		INNER JOIN music_album AS m ON t.ma_id = m.ma_id
		INNER JOIN music_genre AS g ON g.genre_id = t.genre_id
		WHERE t.mav_id = '$ma_id'");
	}
	
	function get_video_category($cat_id)
	{
		return $this->mav->read("where category_id = ".$cat_id." AND music_type = 2 "," ORDER BY RAND() LIMIT 8 ");
	}
	
	function add_lyrics($data)
	{
		return	$this->ly->create($data);
	}
	
	function get_lyrics()
	{
		return $this->ly->read("","","t.*,a.spProfileName as profilename","LEFT JOIN spprofiles as a ON a.idspProfiles = t.spProfiles_idspProfiles");

	}
	
	function get_video_public()
	{
		return $this->mav->read("where is_public = 1 AND t.is_deleted = 0 AND music_type = 2","","t.*,a.*","LEFT JOIN music_album as a ON a.ma_id = t.ma_id");
	}
	
	function get_video_publics()
	{
		return $this->mav->read("where t.is_public = 1 AND t.is_deleted = 0 AND t.music_type = 2","GROUP BY t.ma_id","t.*,a.*,t.ma_id as album_id","INNER JOIN music_album as a ON a.ma_id = t.ma_id");
	}
	
	function get_video_private()
	{
		return $this->mav->read("where is_public = 0 AND t.is_deleted = 0 AND music_type = 2","","t.*,a.*","LEFT JOIN music_album as a ON a.ma_id = t.ma_id");
	}
	
	function get_audio_album($pid)
	{
		return $this->mav->read("where t.music_type = 1 AND t.is_deleted = 0 and t.spProfiles_idspProfiles = $pid","group by t.ma_id","a.*,count(t.ma_id) as total_audio","LEFT JOIN music_album as a ON a.ma_id = t.ma_id");
	}
	
	function get_video_album($pid)
	{
		return $this->mav->read("where t.music_type = 2 AND t.is_deleted = 0 and t.spProfiles_idspProfiles = $pid","group by t.ma_id","a.*,count(t.ma_id) as total_videos","LEFT JOIN music_album as a ON a.ma_id = t.ma_id");
	}
	
	function get_audio_song($ma_id)
	{
		return $this->mav->read("where t.music_type = 1 AND t.is_deleted = 0 and t.ma_id = $ma_id");
	}
	
	function get_video_song($ma_id)
	{
		return $this->mav->read("where t.music_type = 2 AND t.is_deleted = 0 and t.ma_id = $ma_id");
	}
	
	function get_album_by_id($ma_id)
	{
		return $this->ta->read("where t.ma_id = $ma_id");
	}
	
	function add_album_fav($data)
	{
		return	$this->maf->create($data);
	}
	
	function update_fav($ma_id,$pid,$uid)
	{
		return $this->maf->remove("WHERE ma_id ='" . $ma_id . "' and pid='".$pid."' and uid='".$uid."'");
	}
	
	function check_album_fav($ma_id,$pid,$uid)
	{
		return $this->maf->read("where t.ma_id = $ma_id and t.pid = $pid and t.uid = $uid");
	}
	
	function add_song_fav($data)
	{
		return	$this->masf->create($data);
	}
	
	function update_song_fav($mav_id,$ma_id,$pid,$uid)
	{
		return $this->masf->remove("WHERE mav_id ='" . $mav_id . "' and ma_id ='" . $ma_id . "' and pid='".$pid."' and uid='".$uid."'");
	}
	
	function check_song_fav($mav_id,$ma_id,$pid,$uid)
	{
		return $this->masf->read("where t.mav_id = $mav_id and t.ma_id = $ma_id and t.pid = $pid and t.uid = $uid");
	}
	
	function get_album_l($record_index,$limit)
	{
		return $this->ta->read("INNER JOIN music_audio_video as mav on mav.ma_id = t.ma_id where mav.music_type = 1 GROUP BY t.ma_id ORDER BY t.ma_id DESC LIMIT $record_index, $limit");
	}
	
	function get_album_video_l($record_index,$limit)
	{
		return $this->ta->read("INNER JOIN music_audio_video mav on mav.ma_id = t.ma_id where mav.music_type = 2 GROUP BY t.ma_id ORDER BY t.ma_id DESC LIMIT $record_index, $limit");
	}

	function get_album_videos($albumId)
	{
		return $this->mav->read("INNER JOIN music_album MA on MA.ma_id = t.ma_id
				INNER JOIN music_cat MC on MC.category_id = t.category_id
				WHERE t.music_type = 2
				AND t.is_deleted = 0
				AND t.ma_id = ".$albumId."
				ORDER BY t.mav_id DESC");
	}
	
	function get_friend_album($friend_ids,$record_index,$limit)
	{
		return $this->mav->read("where t.spProfiles_idspProfiles IN ($friend_ids) AND t.is_deleted = 0","ORDER BY t.mav_id DESC LIMIT $record_index, $limit","ma.*,t.*","LEFT JOIN music_album as ma ON ma.ma_id = t.ma_id");
	}
	
	function get_friend_video($friend_ids)
	{
		return $this->mav->read("where t.spProfiles_idspProfiles IN ($friend_ids) AND t.is_deleted = 0 ORDER BY t.mav_id DESC LIMIT 6");
	}
	
	function get_friend_videos($friend_ids,$record_index, $limit)
	{
		return $this->mav->read("where t.spProfiles_idspProfiles IN ($friend_ids) AND t.is_deleted = 0 ORDER BY t.mav_id DESC LIMIT $record_index, $limit");
	}
	
	
	function get_recent_videos($pid,$record_index, $limit)
	{
		return $this->mav->read("where t.spProfiles_idspProfiles = $pid AND t.is_deleted = 0 and created_date > now() LIMIT $record_index, $limit");
	}
	
	function get_recent_video($pid)
	{
		return $this->mav->read("where t.spProfiles_idspProfiles = $pid AND t.is_deleted = 0 and created_date > now() LIMIT 6");
	}
	
	function get_fav_video($pid,$uid)
	{
		return $this->masf->read("where t.pid = $pid and t.uid = $uid and mav.music_type = 2","","t.*,ma.*,mav.*","LEFT JOIN music_album ma on ma.ma_id = t.ma_id LEFT JOIN music_audio_video mav on mav.mav_id = t.mav_id");
	}
	
	function get_fav_audio($pid,$uid)
	{
		return $this->masf->read("where t.pid = $pid and t.uid = $uid and mav.music_type = 1","","t.*,ma.*,mav.*","LEFT JOIN music_album ma on ma.ma_id = t.ma_id LEFT JOIN music_audio_video mav on mav.mav_id = t.mav_id");
	}
	
	function update_rating($rating,$masfid)
	{
		return $this->masf->update(array("rating" => $rating), "WHERE masf_id ='" . $masfid . "'");
	}
	
	function get_playlist($pid,$uid)
	{
		return $this->maf->read("where t.pid = $pid and t.uid = $uid and ma.ispublic = 1 GROUP BY ma.ma_id","","t.*,ma.*","INNER JOIN music_album ma ON ma.ma_id = t.ma_id");
	}
	
	function get_playlisted($pid,$uid,$ma_id)
	{
		return $this->maf->read("where t.pid = $pid and t.uid = $uid and ma.ispublic = 1 and mav.ma_id = $ma_id","","t.*,mav.*,ma.*","INNER JOIN music_album ma ON ma.ma_id = t.ma_id INNER JOIN music_audio_video mav ON mav.ma_id = t.ma_id");
	}
	
	function readVideo2($ma_id)
	{
		//SELECT COUNT(ma_id) FROM `music_audio_video` where ma_id = 8 
		return $this->mav->read("where ma_id = $ma_id AND t.is_deleted = 0 and is_public = 1","","COUNT(ma_id) as totalvideo");
	}
	
	function readVideo4($ma_id)
	{
		//SELECT COUNT(ma_id) FROM `music_audio_video` where ma_id = 8 
		return $this->mav->read("where ma_id = $ma_id AND t.is_deleted = 0 and music_type = 2","","COUNT(ma_id) as totalvideo");
	}
	
	function readVideo3($ma_id)
	{
		return $this->mav->read("where t.ma_id = $ma_id AND t.is_deleted = 0 and is_public = 1","","t.*,ma.*","INNER JOIN music_album ma ON ma.ma_id = t.ma_id");
	}
	
	function get_song($mav_id)
	{
		return $this->mav->read("where t.mav_id = $mav_id");
	}
	
	function get_category_song($categoryid)
	{
		return $this->mav->read("where t.category_id = $categoryid AND t.is_deleted = 0 and music_type = 2");
	}
	
	function check_song_added($mav_id,$playlist_id)
	{
		return $this->mp->read("where t.mav_id = $mav_id and t.playlist_id = $playlist_id");
	}
	
	function remove_from_playlist($mav_id,$playlist_id)
	{
		return $this->mp->remove("where t.mav_id = $mav_id and t.playlist_id = $playlist_id");
	}
	
	function add_song_playlist($data)
	{
		return	$this->mp->create($data);
	}
	
	function get_playlist_name($playlist_id)
	{
		return $this->cp->read("where t.list_id = $playlist_id");
	}
	
	function get_playlist_videos($playlist_id,$record_index,$limit)
	{
		return $this->mp->read("where t.playlist_id = $playlist_id","ORDER BY t.mav_id DESC LIMIT $record_index, $limit","t.*,ma.*","INNER JOIN music_audio_video ma ON ma.mav_id = t.mav_id");
	}
	
	function get_playlist_videoss($playlist_id)
	{
		return $this->mp->read("where t.playlist_id = $playlist_id AND ma.is_deleted = 0","ORDER BY t.mav_id DESC","t.*,ma.*,m.*","INNER JOIN music_audio_video ma ON ma.mav_id = t.mav_id INNER JOIN music_album m ON m.ma_id = ma.ma_id");
	}
	
	function remove_song_playlist($mavid,$playlistid)
	{
		$this->mp->remove("WHERE mav_id = $mavid and playlist_id = $playlistid");
	}

	function removePlaylistAllVideos($playlistid)
	{
		$this->mp->remove("WHERE playlist_id = $playlistid");
	}
	
	function get_all_video($record_index,$limit)
	{
		return $this->mav->read("where t.music_type = 2 AND t.is_deleted = 0 AND t.is_public = 1 ORDER BY t.mav_id DESC LIMIT $record_index, $limit");
	}

	function get_vid_module_search_results($record_index,$limit,$searchField,$orderby)
	{
		return $this->mav->read("where t.music_type = 2 AND t.is_deleted = 0 AND t.is_public = 1 AND (t.title like '%".$searchField."%') ORDER BY t.mav_id ".$orderby." LIMIT $record_index, $limit");
	}
	
	function get_all_video_like($alpha,$record_index,$limit)
	{
		$char = strtolower($alpha);
		return $this->mav->read("where t.music_type = 2 AND t.is_deleted = 0 and t.title LIKE '$char%' ORDER BY t.mav_id DESC LIMIT $record_index,$limit");
	}
	
	function get_music_category()
	{
		return $this->mc->read();
	}
	
	function get_category_video($catid,$record_index,$limit)
	{
		return $this->mav->read("where category_id = $catid AND t.is_deleted = 0 AND t.is_public = 1 and music_type = 2 LIMIT $record_index,$limit");
	}
	
	function video_search($catid,$alid)
	{
		return $this->mav->read("where t.category_id = $catid and t.ma_id = $alid and t.is_public = 1 AND t.is_deleted = 0","","t.*,mc.*,ma.*","INNER JOIN music_cat mc ON mc.category_id = t.category_id INNER JOIN music_album ma ON ma.ma_id = t.ma_id");
	}
}
