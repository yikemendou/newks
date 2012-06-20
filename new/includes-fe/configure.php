<?PHP

// Database connection information 

$DATABASE_USER = 'root';
$DATABASE_PASSWORD = '';
$DB_SERVER = 'localhost';
$DATABASE_NAME = 'kurt_6-18';

//output log
$devfile = "F:/Program Files/Zend/Apache2/htdocs/ksnew/devfile.txt";

// require encryption when editing the site with the editor
$require_ssl = false;
// $certificate_domain = "98.129.187.158";
$certificate_domain = "www.kurtsalmon.com";
// domain the certificate is under.

// search-result configuration
// live-site 98.129.187.155 key: 
$google_key = "004206353347347617326%3A_adp_mijkvc";

// dev-site 98.129.187.158 key
// $google_key = "004206353347347617326%3Aqvlrvexw-io";

// $google_map_key["com"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRSj8bScmoU_NwwvUE6gyiRcrtoCTBS2wu1jFX0050dAv_0HnZftQOFq5Q";
// $google_map_key["de"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRSj8bScmoU_NwwvUE6gyiRcrtoCTBS2wu1jFX0050dAv_0HnZftQOFq5Q";
// $google_map_key["jp"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRSj8bScmoU_NwwvUE6gyiRcrtoCTBS2wu1jFX0050dAv_0HnZftQOFq5Q";
// $google_map_key["fr"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRSj8bScmoU_NwwvUE6gyiRcrtoCTBS2wu1jFX0050dAv_0HnZftQOFq5Q";

// live-site map-key
$google_map_key["com"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRQwpqpsGTEBArmi4hmk4lAhznBnAhSnNEEwW5NOPXny5SETpqC6FzZdBw";
$google_map_key["de"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRS2JIpsxcjJ0A3aYDh3Ltw3g2CwSxRRkZ3jhFQa6VCFsHYCAhwFci6_lQ";
$google_map_key["co.uk"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRTzpQTYvFSDhb1xN5H2bW-FndGM6RQfiLPpmnFvsMnHROwcOlGvCHszkA";
$google_map_key["co.jp"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRRkZrimF5nhD979BHgZA6WRUdtWAhQeqSgpxVHHTcvtcc38jgcv9tvqMQ";
$google_map_key["com.cn"] = "ABQIAAAABWRrMB5jI4pVMBgLV4YAQRQ6UoHOqZxegYcwxsfCU67zgJduOhSgz_pKyHUWMiRG18s0DV4lwOEGUA";


$search_numperpage = 10;

// standard-image dimensions 
$main_image_width = 610;
$main_image_height = 200;

// dimensions for the two sector images on home-page
$retail_image_width = 610;
$retail_image_height = 500;

$health_image_width = 361;
$health_image_height = 500;

// for sector pages
$sector_image_width = 610;
$sector_image_height = 381;

// team-portrait dimensions
$team_leader_width = 168;
$team_leader_height = 200;

$team_group_width = 60;
$team_group_height = 72;

// team-thumbnail dimensions
$team_thumb_width = 30;
$team_thumb_height  = 36;

// for ads
$ad_image_width = 200;
$ad_image_height = 72;


// scale-factor for image-previews in the editor
$admin_thumb_scale = 6; 


// Subdirectory names for editor, backups and dynamic content
// $backup_subdir is inside $admin_subdir; the others are on the top-level

$admin_subdir = "editor";
$user_image_subdir = "user_images";
$user_pdf_subdir = "uploads";
$backup_subdir = "backups";

    
// available options on settings-page
$home_news_list =  array(0,3,4,5,6);
$home_careers_list =  array(0,3,4,5,6);
$sector_services_list =  array(0,3,4,5,6,99);
$sector_issues_list =  array(0,3,4,5,6);
$sector_pubs_list =  array(0,3,4,5,6);
$issue_services_list =  array(0,3,4,5,6);
$service_pubs_list =  array(0,3,4,5,6);
$pubs_news_list =  array(0,3,4,5,6);
$about_news_list =  array(0,3,4,5,6);
$about_events_list =  array(0,3,4,5,6);
$mainnews_news_list =  array(3,5,7,10,12,15);
$mainnews_events_list =  array(3,5,7,10,12,15);
$newsdetail_news_list =  array(3,5,7,10,12,15);
$eventdetail_event_list =  array(3,5,7,10,12,15);

