<?PHP
date_default_timezone_set('America/Los_Angeles');

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','1');

function devout($str) {
 global $devfile;
 if (isset($devfile)) {
         $fp = fopen($devfile,"a");
         fwrite($fp, $str."\n");
         fclose($fp);
 }
 return 1;
}
// Figure out where we're at (both in the URL and in the filesystem)
$offset = strlen($_SERVER['DOCUMENT_ROOT']);
$_file_ = str_replace("\\","/",__FILE__);
$current_dir = substr($_file_, 0, strrpos($_file_, '/'));
$root_dir = substr($current_dir, 0, strrpos($current_dir, '/'));
$file = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1);
$html_base = substr($root_dir, $offset) . "/";
$file_base = $_SERVER['DOCUMENT_ROOT'] . $html_base;
require_once "$root_dir"."/includes-fe/configure.php";



// Admin base-director
$admin_dir = $file_base.$admin_subdir."/";
$admin_html_dir = $html_base. $admin_subdir."/";

// directory for all upload images
$image_dir = $file_base.$user_image_subdir."/";
$image_html_dir = $html_base . $user_image_subdir."/";

// directory for all upload pdf-files
$pdf_dir = $file_base.$user_pdf_subdir."/";
$pdf_html_dir = $html_base.$user_pdf_subdir."/";

$backup_dir = $admin_dir.$backup_subdir."/";
$backup_html_dir = $admin_html_dir.$backup_subdir."/";

$error_page = $admin_dir."error.php";

mysql_connect($DB_SERVER,$DATABASE_USER,$DATABASE_PASSWORD) || die(mysql_error());
mysql_select_db($DATABASE_NAME) || die(mysql_error());

/* Set domain_id and language_id */

/* What is our domain? */
// The rest of this is related to internationaliation -- what country/language are we using

session_start();

$server = $_SERVER['SERVER_NAME'];
// $server = "www.kurtsalmon.com";
if (($server == "kurtsalmon.cn")||($server=="www.kurtsalmon.cn")) {
  header("Location: http://kurtsalmon.com.cn\n");
  exit;
}

$domain_row = false;

// add into setup.php after $domain_row is set, but before $_SESSION['domain_id'] is set.

function get_ip_country_code() {
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$parts = explode('.',$ipaddress);
	if (sizeof($parts)!=4) {
		die("Invalid ip address");
	}
	$ipnum = (0+$parts[3] + 256*($parts[2]+256*($parts[1]+256*$parts[0])));
	$res = mysql_query("SELECT code2 FROM country_ip WHERE range_start
			<= $ipnum AND $ipnum <= range_end ORDER BY timestamp DESC LIMIT 1");
	if (!$res) {
		die(mysql_error());
	}
	$row = mysql_fetch_array($res);
	return $row['code2'];
}

// if we are on the homepage
function ip_autoforward() {
	global $domain_row;
	if (! isset($_SESSION['domain_id']) ) { // they are new to site
		if ($domain_row['tld'] === "com") { // they are on .com site
			$country_ip = addslashes(get_ip_country_code());
			if (($_SERVER['PHP_SELF'] == '/') ||
					($_SERVER['PHP_SELF'] == '/index.php') ||
					($_SERVER['PHP_SELF'] == '/home.php')) { // homepage
				$res=mysql_query("SELECT * FROM domain WHERE code='$country_ip'");
				if (!$res) {
					die(mysql_error());
				}
				$row = mysql_fetch_array($res);
				if ($row && ($row['domain_id']!=1)) { // visitor outside US
					header("Location: http://kurtsalmon.".$row['tld']);
					exit;
				}
			}
		}
	}
}

ip_autoforward();

if (preg_match("/kurtsalmon\.([a-z.]*)/i",$server,$matches)) {
    $dom = addslashes($matches[1]);
    devout("Trying tld-dom = $dom");
    $res = mysql_query("SELECT * FROM domain WHERE tld='$dom'");
    if (! $res) {die(mysql_error());}
    $domain_row = mysql_fetch_array($res);
    /* debug message */
    if ($domain_row) {
      $domain_id = $domain_row['domain_id'];
      devout("Changing domain to $domain_id based on servername=$dom");
    }
}


/* If that didn't work, try getting domain from sub-directory */
/* Used for development, i.e. isntead of kurtsalmon.de use kurtsalmon.com/de */
if ((! $domain_row)||($domain_id==1)) {
  if (preg_match("/^\\/([a-z.]*)\\//",$_SERVER['PHP_SELF'], $matches)) {
    $dom = addslashes($matches[1]);
    devout("Trying subdirecotry dom = $dom");
    $res = mysql_query("SELECT * FROM domain WHERE tld='$dom'");
    if (! $res) {die(mysql_error());}
    $domain_row = mysql_fetch_array($res);
  }
    /* debug message */
  if ($domain_row) {
    $domain_id = $domain_row['domain_id'];
    devout("Changing domain to $domain_id based on subdir=$dom");
  }
}


/* If that didn't work, use .com as default */
if (! $domain_row) {
  $res = mysql_query("SELECT * FROM domain WHERE tld='com'");
  if (! $res) {die(mysql_error());}
  $domain_row = mysql_fetch_array($res);

  /* debug message */
  if ($domain_row) {
    $domain_id = $domain_row['domain_id'];
    devout("Changing domain to $domain_id based on default");
  }
}

/* Reset language if domain has changed */
/* When first going to german site it should be in german, though later they might view in english */
if (!isset($_SESSION['domain_id']) || ($_SESSION['domain_id']!=$domain_id)) {
    // we have changed domains, so change languages
    $_SESSION['domain_id'] = $domain_id;
    $_SESSION['language_id'] = $domain_row['default_language'];
    devout("Resetting language to ".$domain_row['default_language']." for domain change");
}

$query = $_SERVER['QUERY_STRING'];
$query = preg_replace(array("/\\&\\&/","/\\?\\&/","/(\\?|\\&)$/"),array("&","?",""),preg_replace("/([\\?\\&]|^)language=[a-z\\-]*($|\\&)/","\\1\\2",$query));

if ($query) { $query = "?".$query."&"; }
else {$query = "?";}
$self_url = htmlspecialchars($query);
//var_dump($self_url);
devout("query-string=".$_SERVER['QUERY_STRING']);
devout("self_url=$self_url");

/* Get custom header-file for this domain if it exists (check if custom-header exists and if so use it, if not use begin.php */
$beginphp = "begin_".$domain_row['tld'].".php";
// print $file_base."includes/".$beginphp;
if (! file_exists($file_base."includes/".$beginphp)) {
  $beginphp = "begin.php";
}

/* Get list of languages available for this domain */
$languages = array();
$res = mysql_query("SELECT l.language_id, l.language_code FROM domain_language d, language l WHERE domain_id='$domain_id' AND d.language_id=l.language_id");
if (! $res) {
  die("Setup: ".mysql_error($res));
}

// create global array of languages that are available in the current domain
while ($row = mysql_fetch_array($res)) {
  $languages[] = $row['language_code'];
  $language_ids[$row['language_code']] = $row['language_id'];
  $language_codes[$row['language_id']] = $row['language_code'];
}

/* Check to see if language was manually selected */

if ($_REQUEST['language']) {
  if (isset($language_ids[$_REQUEST['language']])) {
    $language_id = $language_ids[$_REQUEST['language']];
    $_SESSION['language_id'] = $language_id;
    devout("Setting language to $language_id based on manual selection");
  }
} else { /* Use prior language */
  $language_id = $_SESSION['language_id'];
   devout("Using prior language $language_id");
}

$language = $language_codes[$language_id];

/* Get retail-only flag */
/*
$res=mysql_query("SELECT retail_only, title_suffix, footer FROM domain WHERE domain_id='$domain_id'");
if (! $res) {die(mysql_error());}
$row=mysql_fetch_array($res);
$retail_only = $row['retail_only'];
$title_suffix = $row['title_suffix'];
$footer = $row['footer'];
*/
/* Determine whether we need to auto-forward user to different page */

if ($retail_only) {
  if (preg_match("/\\/index.php/",$_SERVER['PHP_SELF'])) {
    header("Location: index_retail.php");
    exit;
  }
  $index_page = "index_retail.php";
  $issues_page = "issues_sector_list.php?id=1";
  $services_page = "services_sector_list.php?id=1";
  $publications_page = "pubs_sector_list.php?id=1";
} else {
  if (preg_match("/\\/index_retail.php/",$_SERVER['PHP_SELF'])) {
    header("Location: index.php");
    exit;
  }
  $index_page = "index.php";
  $issues_page = "issues_list.php";
  $services_page = "services_list.php";
  $publications_page = "pubs_list.php";
}

$domains = array();
//$res = mysql_query("SELECT domain_id, tld, code, retail_only, default_language FROM domain WHERE hidden=0 order by domain_id");
$res = mysql_query("SELECT domain_id, tld, code,  default_language FROM domain WHERE hidden=0 order by domain_id");
while ($row = mysql_fetch_array($res)) {
  $on = ""; if ($row['domain_id'] == $domain_id) {$on = "class=\"on\"";}
  devout("url:"." http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']." from ".$domain_row['tld']." to ".$row['tld']);
  $domains[$row['domain_id']] = array(
      'id' => $row['domain_id'], 
      'code' => $row['code'],
      'default_language' => htmlspecialchars(strtoupper($row['default_language'])),
     // 'retail_only' => htmlspecialchars(strtoupper($row['retail_only'])),
      'url' => "http://www.kurtsalmon.".$row['tld'],
      'on' => $on
     // ,'\.'.$domain_row['tld'],'.'.$row['tld'] 
      );
}
// devout(print_r($domains, 1));
      // .$_SERVER['PHP_SELF'],"/".$domain_row['tld']."/","/".$row['tld']."/"),

header("Content-Type: text/html; charset=UTF-8");
header("Content-Language: $language");

/* Check browser language-preferences */

if (get_magic_quotes_gpc()) {
		function stripslashes_deep($value)
		{
			$value = is_array($value) ?
				array_map('stripslashes_deep', $value) :
					stripslashes($value);

			return $value;
		}

		$_POST = array_map('stripslashes_deep', $_POST);
		$_GET = array_map('stripslashes_deep', $_GET);
		$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
		$_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

// if sector_id is defined, this affects navigation:
if (isset($_REQUEST['sector_id'])) {
  if ($_REQUEST['sector_id']==1) {
    $sector_code = "retail";
  } else if ($_REQUEST['sector_id']==2) {
    $sector_code = "health";
  }
}


/* Setup translation array for active language */
$translate = array();
$res = mysql_query("SELECT o.content as k, n.content as val FROM translation as o, translation as n WHERE o.word_id=n.word_id AND o.language_id='1' AND n.language_id='$language_id'");
if (! $res) {die(mysql_error());}
while ($row = mysql_fetch_array($res)) {
    $translate[$row['k']] = $row['val'];
}

$months = array();
$res = mysql_query("SELECT o.name as k, n.name as val FROM month as o, month as n WHERE o.month_id=n.month_id AND o.language_id='1' AND n.language_id='$language_id'");
if (! $res) {die(mysql_error());}
while ($row = mysql_fetch_array($res)) {
    $months[$row['k']] = $row['val'];
}


//service_list
$res = mysql_query("SELECT sector_id FROM sector ORDER BY sector_id");
if (! $res) {
	die(mysql_error());
}
$sector = array();
while ($row = mysql_fetch_array($res)) {
	$iid = $row['sector_id'];
	$resl = mysql_query("SELECT sector_name FROM sector_lang 
			WHERE sector_id='$iid' AND (language_id='1' OR language_id='$language_id') 
			AND sector_name!='' AND sector_id in 
			(select sector_id from sector_domain where domain_id=$domain_id)
			ORDER BY language_id DESC LIMIT 1");
	if (! $resl) {
		die(mysql_error());
	}
	$rowl = mysql_fetch_array($resl);
	$s = array();
	$s['id'] = $row['sector_id'];
	$sid = $s['id'];
	$s['name'] = $rowl['sector_name'];
	$sector[$s['id']] = $s;
}


//countries in navigation
$res = mysql_query("SELECT tld, domain_id, name FROM domain order by sortnum asc;");
if (! $res) {
	die(mysql_error());
}
$countries = array();
while ($row = mysql_fetch_array($res)) {
	$countries[]=$row;
	if ($row['domain_id']==$domain_id){
		$country_name = $row['name'];
	}
	}
	
//languages in footer
	$res = mysql_query("select language_name,language_code
from (language join domain_language on language.language_id=domain_language.language_id)
where domain_language.domain_id=$domain_id
order by domain_language.sortnum");
	if (! $res) {
		die(mysql_error());
	}
	$languages = array();
	while ($row = mysql_fetch_array($res)) {
		$languages[]=$row;
	}	
	
//social networking in footer
	$res = mysql_query("select show_twitter, twitter_url, show_linkedin, linkedin_url, show_facebook, facebook_url, 
			show_rss, rss_url from domain where domain_id = $domain_id");
	if (! $res) {
		die(mysql_error());
	}
	$sns = array();
	while ($row = mysql_fetch_array($res)) {
		$sns[]=$row;
	}
	$sns=$sns[0];


// print_r($translate);
/*
   CREATE TABLE translation (
      word_id int not null,
      language_id int not null,
      content text not null,
      primary key (word_id,language_id)
   );

   */

function translation($word) {
  global $translate;
  if (isset($translate[$word])) {
    return $translate[$word];
  } else {
    return $word;
  }
}
function translate($word) {
  global $translate;
  if (isset($translate[$word])) {
    print $translate[$word];
  } else {
    print $word;
  }
}



$success = "";
$error = "";

function langf($table, $key, $id, $fields) {
  global $language_id;
  $l=$language_id;
  $resl = mysql_query("SELECT $fields FROM $table WHERE $key='$id' AND (language_id='$l' OR language_id=1) ORDER BY language_id DESC LIMIT 1");
  $temp = "SELECT $fields FROM $table WHERE $key='$id' AND (language_id='$l' OR language_id=1) ORDER BY language_id DESC LIMIT 1";
  //var_dump($temp);
  //echo  "<br />";
  if (! $resl) {die(mysql_error());}
  return mysql_fetch_array($resl);
}

function content_filter($content) {

// add zoom-image-icon onto appropriate edited content-images
return preg_replace(
"/(<a[^>]*href[ \\n\\r\\t]*=[ \\n\\r\\t]*(?:'[^']*(?:png|jpg|gif|bmp)[^']*'|\"[^\"]*(?:png|jpg|gif|bmp)[^\"]*\")[^>]*>)([\\n\\r\\t ]*<[\\n\\r\\t ]*img[^>]*>[\\n\\r\\t ]*)(<\\/[\\n\\r\\t ]*a[\\n\\r\\t ]*>)/i",

"\\1<img class=\"zoomicon\" alt=\"zoom icon\" src=\"images/enlarge.gif\" />\\2\\3",
$content);
}

function tdate($str, $time) {
  global $months;
  return str_replace(array_keys($months),array_values($months),date($str,$time));
}

if (! isset($usemaps)) {
  $usemaps = 0;
}

?>
