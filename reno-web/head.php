<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once("$g4[path]/head.sub.php");
include_once("$g4[path]/lib/outlogin.lib.php");
include_once("$g4[path]/lib/poll.lib.php");
include_once("$g4[path]/lib/visit.lib.php");
include_once("$g4[path]/lib/connect.lib.php");
include_once("$g4[path]/lib/popular.lib.php");

//print_r2(get_defined_constants());

// 사용자 화면 상단과 좌측을 담당하는 페이지입니다.
// 상단, 좌측 화면을 꾸미려면 이 파일을 수정합니다.
?>
<div id="wrap">
	<article id="content">
		<header id="main_header">
			<hgroup id="title">
				<h1><?=$g4['title']?></h1>
			</hgroup>
			<nav id="main_unb">
				<ul>
<?
if($member['mb_id']){
	while($data = mysql_fetch_array($login_M)){
?>
					<li><a href="#"><?=$data[gr_subject]?></a></li>
<?
	}
} else {
	while($data = mysql_fetch_array($logout_M)){
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
while($data = mysql_fetch_array($blog_M)){
?>
					<li><a href="#"><?=$data[gr_subject]?></a></li>
<?
}
?>
				</ul>
				<ul id="homepage_menu">
<?
while($data = mysql_fetch_array($homepage_M)){
?>
					<li><a href="#"><?=$data[gr_subject]?></a></li>
<?
}
?>
				</ul>
			</nav>
		</header>