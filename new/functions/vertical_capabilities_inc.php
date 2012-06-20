<?php
$sector_id = $_GET['vertical']+0;
require 'setup.php';
$nav1 = "services";
$page_title = "Vertical Capabilities";

//check if this service exists in current domain
$res = mysql_query("select count(*) as no from sector_domain
		where sector_id=$sector_id and domain_id=$domain_id");
if (! $res) {
	die(mysql_error());
}
$row = mysql_fetch_array($res);
if ($row['no']==0){
	header("Location: home.php");
	exit;
}

//sector services: main title,image   service title from sector_lang
$res = mysql_query("select main_title, service_title, image.filename as service_main_image
		from ((sector_lang join sector_domain on sector_lang.sector_id=sector_domain.sector_id)
		left join image on sector_lang.service_image=image.image_id)
		where sector_domain.domain_id=$domain_id and (sector_lang.language_id=$language_id or 
		sector_lang.language_id=1) 
		and sector_lang.sector_id = $sector_id
		order by sector_lang.language_id desc limit 1");
if (! $res) {
	die(mysql_error());
}
$service_main = array();
while ($row = mysql_fetch_array($res)) {
	$service_main[]=$row;
}
$service_main=$service_main[0]; 

//vertical services, capabilities
$sql ="select distinct service.service_id 
from ((service join service_node on service_node.service_id=service.service_id) 
join service_domain on service_node.service_id=service_domain.service_id 
and service_node.domain_id=service_domain.domain_id)
where service_node.parent_id=0 
and service_domain.domain_id=$domain_id
and service_domain.visibility=1
and service.sector_id=$sector_id
order by service_node.sortnum;";
$res = mysql_query ($sql);
if (! $res) {
	die ( mysql_error () );
}
$sector_capabilities= array ();
while ( $row = mysql_fetch_array ( $res ) ) {
	$service_id = $row ['service_id'];
	$sql ="select service_id, service_name as name, slug , filename
	from (service_lang left join image on service_lang.image_id=image.image_id)
	where service_lang.service_id = $service_id
	and (service_lang.language_id=$language_id or service_lang.language_id=1)
	order by service_lang.language_id desc limit 1;";
	$resl = mysql_query ($sql);
	if (! $resl) {
		die ( mysql_error () );
	}
	$rowl = mysql_fetch_array ( $resl );
	$sector_capabilities [] = $rowl;
}
 