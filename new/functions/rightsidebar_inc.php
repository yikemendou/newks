<?php
//aside-team for each sector
$sql ="select distinct team_member_id from team_member where
visibility=1
and sector_id = $sector_id
and domain_id = $domain_id
order by team_member_id;";
$res = mysql_query ($sql);
if (! $res) {
die ( mysql_error () );
}

$sector_team= array ();
while ( $row = mysql_fetch_array ( $res ) ) {
$team_member_id = $row ['team_member_id'];
$sql ="select first_name, last_name, title, title2,office_id, team_member.team_member_id
from (team_member join team_member_lang on team_member.team_member_id=team_member_lang.team_member_id)
where team_member.team_member_id = $team_member_id
and (language_id=$language_id or language_id=1)
order by language_id desc limit 1;";
$resl = mysql_query ($sql);
if (! $resl) {
die ( mysql_error () );
}
	$rowl = mysql_fetch_array ( $resl );

	$office_id=$rowl['office_id'];
	$sql2="select city from office_lang
	where office_id = $office_id
	and (language_id=$language_id or language_id=1)
	order by language_id desc limit 1;";
	$res2 = mysql_query ($sql2);
	if (! $res2) {
	die ( mysql_error () );
}
	$row2 = mysql_fetch_array ( $res2 );

	$rowl['city'] = $row2['city'];

	$sector_team [] = $rowl;
}

//aside-events
	$sql = "select distinct event.event_id
	from (event_lang join event on event_lang.event_id= event.event_id)
	where event.sector_id = $sector_id
	order by event_lang.start_date desc";
	$res = mysql_query ( $sql );
	if (! $res) {
	die ( mysql_error () );
}
$aside_events = array ();
while ( $row = mysql_fetch_array ( $res ) ) {
$related_event_id = $row ['event_id'];

$sql = "select event_name, event_url, location_city, start_date
from (event_lang join event_domain on event_lang.event_id=event_domain.event_id)
where event_domain.domain_id=$domain_id
and event_lang.event_id = $related_event_id
and event_domain.visibility=1
and DATE(start_date) >= CURDATE() - INTERVAL 7 DAY 
and (event_lang.language_id=$language_id or event_lang.language_id=1)
		order by event_lang.language_id desc limit 1;";

		$resl = mysql_query ( $sql );
		if (! $resl) {
die ( mysql_error () );
}
$rowl = mysql_fetch_array ( $resl );
if ($rowl!=null){
$rowl ['id'] = $related_event_id;
$rowl ['start_date'] = date ( "d M Y", strtotime ( $rowl ['start_date'] ) );

$aside_events [] = $rowl;
}
}

$aside_events = array_slice ( $aside_events, 0, 2 );