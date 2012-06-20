<?php
$sector_id = $_GET['vertical']+0;
require 'setup.php';
require 'rightsidebar_inc.php';
$nav1 = "services";
$page_title = "Vertical";

//sector main title, intro, image, body
$res = mysql_query("select main_title, main_intro,image.filename as sector_main_image,main_body
		from ((sector_lang join sector_domain on sector_lang.sector_id=sector_domain.sector_id)
		left join image on sector_lang.main_image=image.image_id)
		where sector_domain.domain_id=$domain_id and (sector_lang.language_id=$language_id or 
		sector_lang.language_id=1) 
		and sector_lang.sector_id = $sector_id
		order by sector_lang.language_id desc limit 1");
if (! $res) {
	die(mysql_error());
}
$sector_main = array();
while ($row = mysql_fetch_array($res)) {
	$sector_main[]=$row;
}
$sector_main=$sector_main[0];

//sector latest insights
$sql = "select publication_name, pl.publication_id, filename from  (publication_lang as pl join publication
on pl.publication_id = publication.publication_id)
left join image on pl.image_id=image.image_id
where pl.publication_id in
(select pd.publication_id from publication_domain as pd
where pd.domain_id=$domain_id and pd.visibility=1 and pd.promoted=1)
and publication.sector_id = $sector_id
order by pl.publication_date desc";
//echo $sql;
$res = mysql_query($sql);
if (! $res) {
die(mysql_error());
}
$sector_insights = array();
while ($row = mysql_fetch_array($res)) {
$sector_insights[]=$row;
}
//var_dump($publications);
//echo "<br />";
//echo "<br />";

//langf to specify languages....output to $publication_lang
$sector_insights_lang = array();
foreach($sector_insights as $p){
$row = langf("publication_lang", "publication_id",$p['publication_id'],"publication_name");
//var_dump($row);
//echo  "<br />";
$pl_temp['publication_name']= $row['publication_name'];
$pl_temp['filename'] = $p['filename'];
$pl_temp['publication_id'] = $p['publication_id'];
$sector_insights_lang[]=$pl_temp;
}
//var_dump($publication_lang);
//if longer than three then pass, if not, append unpromoted ones by publishing date
$pl_length = count($sector_insights_lang);
$sector_insights_lang_unpromoted = array();

if ($pl_length<3){
$sql = "select publication_name, pl.publication_id, filename from  (publication_lang as pl join publication
on pl.publication_id = publication.publication_id)
left join image on pl.image_id=image.image_id
where pl.publication_id in
(select pd.publication_id from publication_domain as pd
where pd.domain_id=$domain_id and pd.visibility=1 and pd.promoted!=1)
and publication.sector_id = $sector_id
order by pl.publication_date desc";

$res = mysql_query($sql);
if (! $res) {
die(mysql_error());
}
$sector_insights_unpromoted = array();
while ($row = mysql_fetch_array($res)) {
$sector_insights_unpromoted[]=$row;
}

foreach($sector_insights_unpromoted as $p){
$row = langf("publication_lang", "publication_id",$p['publication_id'],"publication_name");
//var_dump($row);
//echo  "<br />";
$pl_temp['publication_name']= $row['publication_name'];
$pl_temp['filename'] = $p['filename'];
$pl_temp['publication_id'] = $p['publication_id'];
$sector_insights_lang_unpromoted[]=$pl_temp;
}

}
$sector_insights = array_merge($sector_insights_lang, $sector_insights_lang_unpromoted);
$sector_insights = array_slice($sector_insights, 0, 3);

//vertical services, capabilities
$sql ="select service_id from service where sector_id = $sector_id order by service_id;";//service_domain.sortnum does not exist, sort by service_id for now
$res = mysql_query ($sql);
		if (! $res) {
		die ( mysql_error () );
}

$sector_capabilities= array ();
while ( $row = mysql_fetch_array ( $res ) ) {
	$service_id = $row ['service_id'];
	//problem: service_domain does not have a sortnum field here
	$sql ="select service_name as name 
	from (service_domain join service_lang on service_domain.service_id=service_lang.service_id) 
	where service_domain.visibility=1
	and service_lang.service_id = $service_id
	and service_domain.domain_id=$domain_id
	and (service_lang.language_id=$language_id or service_lang.language_id=1)
	order by service_lang.language_id desc limit 1;";
	$resl = mysql_query ($sql);
	if (! $resl) {
		die ( mysql_error () );
	}
	$rowl = mysql_fetch_array ( $resl );
	$rowl['id']=$service_id;
	$sector_capabilities [] = $rowl;	
}
$sector_capabilities = array_slice ( $sector_capabilities, 0, 3 );