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

//메뉴 사이즈 설정
$cnt = 100 / $cnt;
?>
<div id="wrap">
	<article id="content">
	
	
		<header>
			<hgroup>		
				<h1 id="brand_logo"><?=$g4['title']?></h1>
				<nav id="user_nav">
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
			</hgroup>
			<nav id="main_nav">
<?
if($config[cf_8] == 1) {
?>
				<ul id="blog_menu">
<?
while($data = mysql_fetch_array($blog_M)){
?>
					<li><a href="#" style="padding: 0 <?=$cnt/5?>%"><?=$data[gr_subject]?></a></li>
<?
}
?>
				</ul>
				<div id="main_menu_space">
				</div>
<?
}
?>
				<ul id="homepage_menu">
<?
while($data = mysql_fetch_array($homepage_M)){
?>
					<li><a href="#" style="padding: 0 <?=$cnt/5?>%"><?=$data[gr_subject]?></a></li>
<?
}
?>
				</ul>
			</nav>
		</header>