<?
$sub_menu = "600100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

$g4['title'] = "외부 서비스 연결";
include_once ("./admin.head.php");
?>

<div id="breadcrumb">
	<a href="<?=$g4['admin_path']?>/" title="Go to Admin" class="tip-top"><i class="icon-home"></i> Admin</a>
	<a href="<?=$g4['admin_path']?>/" class="current"><?=$g4[title]?></a>
</div>

<div class="container-fluid">

<iframe src="http://analytics.naver.com/summary/dashboard.html" width=100%; height=100%>
</iframe>

<?
include_once ("./admin.tail.php");
?>
