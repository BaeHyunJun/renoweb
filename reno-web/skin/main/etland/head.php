<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가  
?>
<header id="main_header">
	<hgroup id="title">
		<h1>RENO WEB</h1>
		<h2>All In One Solution</h2>
	</hgroup>
	<nav id="main_gnb">
		<ul>
			<li>1</li>
			<li>2</li>
			<li>3</li>
		</ul>
	</nav>
	<nav id="main_lnb">
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
