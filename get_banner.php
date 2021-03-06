<?php
include_once("db.php");
$page = $_GET['page'];
$user = (int)$_GET['user'];
$pageEscaped = $mysqli->real_escape_string($page);


// todo: dates, on_off = On
$now = date('Y-m-d H:i:s');
$sql = "
	SELECT * FROM `baneer` 
	WHERE 
		page = '$pageEscaped' 
		AND user_id = $user
		AND on_off = 'On'
		AND dt_start < '$now'
		AND dt_end > '$now'
";

$result = $mysqli->query($sql);

// get all banners for the given page from DB
$banners = array();
while($banner = $result->fetch_assoc()) {
	$banners[] = $banner;
}
if (empty($banners)) die;

$rand = rand(0, count($banners)-1);
echo $banners[$rand]['comment'];