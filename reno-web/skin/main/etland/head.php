<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가  
?>
<link rel='stylesheet' type='text/css' href='<?=$main_skin_path?>/css/etland.css'>

<style>
#title {
	text-indent: -10000px;
	background: url(<?=$g4['path']?>/data/logo/logo.png) no-repeat;
}
</style>

<div id="wrap">
<header id="main_header">
	<hgroup id="title">
		<h1>RENO WEB</h1>
		<h2>All In One Solution</h2>
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
		<ul>
<?
while($data = mysql_fetch_array($main)){
?>
			<li><a href="#"><?=$data[gr_subject]?></a></li>
<?
}
?>
		</ul>
	</nav>
</header>
