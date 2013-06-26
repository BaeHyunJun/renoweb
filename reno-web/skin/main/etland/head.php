<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가  
?>
<link rel='stylesheet' type='text/css' href='<?=$main_skin_path?>/css/etland.css'>

<style>
#title h1 {
	text-indent: -10000px;
	background: url(<?=$g4['path']?>/data/logo/logo.png) no-repeat;
}
</style>

<div id="wrap">

<?
include_once("$main_skin_path/skin.php");
?>

	<article id="content">
		<header id="main_header">
			<hgroup id="title">
				<h1><?=$g4['title']?></h1>
			</hgroup>
			<nav id="main_unb">
				<ul>
<?
while($data = mysql_fetch_array($user)){
	if($member['mb_id']){
		if(!isLoginMenu($data[gr_3])){
			continue;
		}
?>
					<li><a href="#"><?=$data[gr_subject]?></a></li>
			
<?
	} else {
		if(isLoginMenu($data[gr_3])){
			continue;
		}
?>
					<li><a href="#"><?=$data[gr_subject]?></a></li>
<?
	}
}
?>
				</ul>
			</nav>
			<nav id="main_mnb">
				<ul id="blog_menu">
<?
while($data = mysql_fetch_array($blogmenu)){
?>
					<li><a href="#"><?=$data[gr_subject]?></a></li>
<?
}
?>
				</ul>
				<ul id="homepage_menu">
<?
while($data = mysql_fetch_array($homepagemenu)){
?>
					<li><a href="#"><?=$data[gr_subject]?></a></li>
<?
}
?>
				</ul>
			</nav>
		</header>