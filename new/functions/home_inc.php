<?php
require 'setup.php';
$nav1 = "home";
$page_title = "Home";

// home title, slug
$res = mysql_query ( "SELECT home_title, home_slug
FROM main_content
WHERE domain_id =$domain_id
AND (
language_id =$language_id
OR language_id =1
)
ORDER BY language_id DESC
LIMIT 1" );
if (! $res) {
	die ( mysql_error () );
}
$home = array ();
while ( $row = mysql_fetch_array ( $res ) ) {
	$home [] = $row;
}
$home = $home [0];

// publications, insights
$sql = "select publication_name, publication_id, filename from publication_lang as pl 
left join image on pl.image_id=image.image_id 
where pl.publication_id in 
(select pd.publication_id from publication_domain as pd 
where pd.domain_id=$domain_id and pd.visibility=1 and pd.promoted=1) 
order by pl.publication_date desc";
// echo $sql;
$res = mysql_query ( $sql );
if (! $res) {
	die ( mysql_error () );
}
$publications = array ();
while ( $row = mysql_fetch_array ( $res ) ) {
	$publications [] = $row;
}
// var_dump($publications);
// echo "<br />";
// echo "<br />";

// langf to specify languages....output to $publication_lang
$publication_lang = array ();
foreach ( $publications as $p ) {
	$row = langf ( "publication_lang", "publication_id", $p ['publication_id'], "publication_name" );
	// var_dump($row);
	// echo "<br />";
	$pl_temp ['publication_name'] = $row ['publication_name'];
	$pl_temp ['filename'] = $p ['filename'];
	$pl_temp ['publication_id'] = $p ['publication_id'];
	$publication_lang [] = $pl_temp;
}
// var_dump($publication_lang);
// if longer than six then pass, if not, append unpromoted ones by publishing
// date
$pl_length = count ( $publication_lang );
$publication_lang_unpromoted = array ();

if ($pl_length < 6) {
	$sql = "select publication_name, publication_id, filename from publication_lang as pl
	left join image on pl.image_id=image.image_id
	where pl.publication_id in
	(select pd.publication_id from publication_domain as pd
	where pd.domain_id=$domain_id and pd.visibility=1 and pd.promoted!=1)
	order by pl.publication_date desc";
	
	$res = mysql_query ( $sql );
	if (! $res) {
		die ( mysql_error () );
	}
	$publications_unpromoted = array ();
	while ( $row = mysql_fetch_array ( $res ) ) {
		$publications_unpromoted [] = $row;
	}
	
	foreach ( $publications_unpromoted as $p ) {
		$row = langf ( "publication_lang", "publication_id", $p ['publication_id'], "publication_name" );
		// var_dump($row);
		// echo "<br />";
		$pl_temp ['publication_name'] = $row ['publication_name'];
		$pl_temp ['filename'] = $p ['filename'];
		$pl_temp ['publication_id'] = $p ['publication_id'];
		$publication_lang_unpromoted [] = $pl_temp;
	}

}
$home_insights = array ();
$home_insights = array_merge ( $publication_lang, $publication_lang_unpromoted );
$home_insights = array_slice ( $home_insights, 0, 6 );
// var_dump($home_insights);

// home our services
$res = mysql_query ( "SELECT sector_id FROM sector ORDER BY sector_id" );
if (! $res) {
	die ( mysql_error () );
}
$home_our_services = array ();
while ( $row = mysql_fetch_array ( $res ) ) {
	$iid = $row ['sector_id'];
	$resl = mysql_query ( "SELECT sector_name FROM sector_lang
			WHERE sector_id='$iid' AND (language_id='1' OR language_id='$language_id')
			AND sector_name!='' AND sector_id in
			(select sector_id from sector_domain where domain_id=$domain_id)
			ORDER BY language_id DESC LIMIT 1" );
	if (! $resl) {
		die ( mysql_error () );
	}
	$rowl = mysql_fetch_array ( $resl );
	$s = array ();
	$s ['id'] = $row ['sector_id'];
	$sid = $s ['id'];
	$s ['name'] = $rowl ['sector_name'];
	$home_our_services [$s ['id']] = $s;
}
$count_services = count ( $home_our_services );
if ($count_services > 12) {
	$home_our_services = array_slice ( $home_our_services, 0, 12 );
}
// home news
$sql = "select distinct news_id from news_lang order by news_date desc";

$res = mysql_query ( $sql );
if (! $res) {
	die ( mysql_error () );
}
$home_news = array ();
while ( $row = mysql_fetch_array ( $res ) ) {
	$news_id = $row ['news_id'];
	$resl = mysql_query ( "select headline, news_date, news_url
from (news_lang join news_domain on news_lang.news_id=news_domain.news_id)
where (news_domain.domain_id=$domain_id or news_domain.domain_id=0)
and news_domain.news_id=$news_id
and news_domain.visibility=1
and (news_lang.language_id=$language_id or news_lang.language_id=1)
order by news_lang.language_id desc limit 1;" );
	if (! $resl) {
		die ( mysql_error () );
	}
	$rowl = mysql_fetch_array ( $resl );
	$rowl ['id'] = $news_id;
	$rowl ['news_date'] = date ( "d M Y", strtotime ( $rowl ['news_date'] ) );
	$home_news [] = $rowl;
}

if ($count_services > 12) {
	$home_news = array_slice ( $home_news, 0, 2 );
} else {
	$home_news = array_slice ( $home_news, 0, 3 );
}

// home events
$sql = "select distinct event_id from event_lang order by start_date desc";

$res = mysql_query ( $sql );
if (! $res) {
	die ( mysql_error () );
}
$home_events = array ();
while ( $row = mysql_fetch_array ( $res ) ) {
	$event_id = $row ['event_id'];
 
	$sql = "select event_name, event_url, location_city, start_date
		from (event_lang join event_domain on event_lang.event_id=event_domain.event_id)
		where event_domain.domain_id=$domain_id 
		and event_lang.event_id = $event_id
		and event_domain.visibility=1
		and (event_lang.language_id=$language_id or event_lang.language_id=1)
		and DATE(start_date) >= CURDATE() - INTERVAL 7 DAY 
	    order by event_lang.language_id desc limit 1;";	 
	$resl = mysql_query ( $sql );
	if (! $resl) {
		die ( mysql_error () );
	}
	$rowl = mysql_fetch_array ( $resl );
	if ($rowl!=null){
	$rowl ['id'] = $event_id;
	$rowl ['start_date'] = date ( "d M Y", strtotime ( $rowl ['start_date'] ) );

	$home_events [] = $rowl;
	}	 
}

if ($count_services > 12) {
	$home_events = array_slice ( $home_events, 0, 2 );
} else {
	$home_events = array_slice ( $home_events, 0, 3 );
}
 
