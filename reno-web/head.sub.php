<?
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$begin_time = get_microtime();

if (!$g4['title'])
    $g4['title'] = $config['cf_title'];

// 쪽지를 받았나?
if ($member['mb_memo_call']) {
    $mb = get_member($member[mb_memo_call], "mb_nick");
    sql_query(" update {$g4[member_table]} set mb_memo_call = '' where mb_id = '$member[mb_id]' ");

    alert($mb[mb_nick]."님으로부터 쪽지가 전달되었습니다.", $_SERVER[REQUEST_URI]);
}


// 현재 접속자
//$lo_location = get_text($g4[title]);
//$lo_location = $g4[title];
// 게시판 제목에 ' 포함되면 오류 발생
$lo_location = addslashes($g4['title']);
if (!$lo_location)
    $lo_location = $_SERVER['REQUEST_URI'];
//$lo_url = $g4[url] . $_SERVER['REQUEST_URI'];
$lo_url = $_SERVER['REQUEST_URI'];
if (strstr($lo_url, "/$g4[admin]/") || $is_admin == "super") $lo_url = "";

// 자바스크립트에서 go(-1) 함수를 쓰면 폼값이 사라질때 해당 폼의 상단에 사용하면
// 캐쉬의 내용을 가져옴. 완전한지는 검증되지 않음
header("Content-Type: text/html; charset=$g4[charset]");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0
/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/

// 블로그 메뉴 가져오기
$sql = "select * from $g4[group_table] where gr_1 = 'main' and gr_3 = 'blog' order by gr_2 asc";
$blog_M = sql_query($sql);

// 블로그 메뉴 갯수 가져오기
$sql = "select count(*) as cnt from $g4[group_table] where gr_1 = 'main'";
$row = sql_fetch($sql);
$cnt = $row[cnt];

// 홈페이지 메뉴 가져오기
$sql = "select * from $g4[group_table] where gr_1 = 'main' and gr_3 = 'homepage' order by gr_2 asc";
$homepage_M = sql_query($sql);

// 로그인시 유저 메뉴 가져오기
$sql = "select * from $g4[group_table] where gr_1 = 'user' and gr_3 = 'login' order by gr_2 asc";
$login_M = sql_query($sql);

// 로그아웃시 유저 메뉴 가져오기
$sql = "select * from $g4[group_table] where gr_1 = 'user' and gr_3 = 'logout' order by gr_2 asc";
$logout_M = sql_query($sql);

// 하단 메뉴 가져오기
$sql = "select * from $g4[group_table] where gr_1 = 'foot' order by gr_2 asc";
$footer_M = sql_query($sql);

function isLoginMenu($data) {
	if($data) {
		return true;
	}
	return false;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<title><?=$g4['title']?></title>
<link rel="stylesheet" href="<?=$g4['path']?>/css/EricMeyer-reset.css" />
<link rel='stylesheet' type='text/css' href='<?=$main_skin_path?>/css/<?=$config['cf_4']?>.css'>
</head>
<script type="text/javascript">
// 자바스크립트에서 사용하는 전역변수 선언
var g4_path      = "<?=$g4['path']?>";
var g4_bbs       = "<?=$g4['bbs']?>";
var g4_bbs_img   = "<?=$g4['bbs_img']?>";
var g4_url       = "<?=$g4['url']?>";
var g4_is_member = "<?=$is_member?>";
var g4_is_admin  = "<?=$is_admin?>";
var g4_bo_table  = "<?=isset($bo_table)?$bo_table:'';?>";
var g4_sca       = "<?=isset($sca)?$sca:'';?>";
var g4_charset   = "<?=$g4['charset']?>";
var g4_cookie_domain = "<?=$g4['cookie_domain']?>";
var g4_is_gecko  = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
var g4_is_ie     = navigator.userAgent.toLowerCase().indexOf("msie") != -1;
<? if ($is_admin) { echo "var g4_admin = '{$g4['admin']}';"; } ?>
</script>
<script type="text/javascript" src="<?=$g4['path']?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/common.js"></script>
<style>
#brand_logo {
	text-indent: -10000px;
	background: url(<?=$g4['path']?>/data/logo/logo.png) no-repeat;
	width: <?=$config[cf_2]?>px;
	height: <?=$config[cf_3]?>px;
}
</style>

<body topmargin="0" leftmargin="0" <?=isset($g4['body_script']) ? $g4['body_script'] : "";?>>
