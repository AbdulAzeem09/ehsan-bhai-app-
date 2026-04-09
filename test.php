<?php 


$str = "SELECT t.idspPostings FROM sppostings AS t left join spgroup as spg on t.groupid = spg.idspgroup where (t.groupid = ?) and spcategories_idspcategory = ? and t.idspPostings = ? and (sppostingvisibility = ? or sppostingvisibility in (select spgroup_idspgroup from spprofiles_has_spgroup where spprofiles_idspprofiles = ?) ) and (t.spprofiles_idspprofiles = ? or t.spprofiles_idspprofiles in (select sps.spprofiles_idspprofilesreceiver from `spprofiles_has_spprofiles` sps where sps.spprofiles_has_spprofileflag = ? and ? in ( sps.spprofiles_idspprofilesender,sps.spprofiles_idspprofilesreceiver)) or t.spprofiles_idspprofiles in (select sps1.spprofiles_idspprofilesender from `spprofiles_has_spprofiles` sps1 where sps1.spprofiles_has_spprofileflag = ? and ? in (sps1.spprofiles_idspprofilesender,sps1.spprofiles_idspprofilesreceiver)) or t.spprofiles_idspprofiles in ( SELECT following FROM spuser_follow WHERE follower = ? AND status = ? ) or idsppostings in(select timelineid from share where spsharetowhom = ? and timelineid = ?)) union all select t.idspPostings from sppostings as t left join spgroup as spg on t.groupid = spg.idspgroup where t.idsppostings in (select timelineid from share where spsharetowhom = ? and timelineid = ?)";

$params = [
    "77",
    16,
    2925,
    -1,
    "3105",
    "3105",
    1,
    "3105",
    1,
    "3105",
    "3105",
    1,
    "3105",
    2925,
    "3105",
    2925
];


$debug_sql = $str;
foreach ($params as $key => $value) {
    $debug_sql = preg_replace('/\?/',$value , $debug_sql, 1);
}

 echo $debug_sql;




