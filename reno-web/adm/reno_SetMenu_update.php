<?
$sub_menu = "100300";
include_once("./_common.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], "w");

if ($is_admin != "super" && $w == "") alert("최고관리자만 접근 가능합니다.");

check_token();

/******** 서로 바꾸기
$sql = "select * 
		from $g4[group_table] 
		where gr_2 = '$_POST[gr_2]' 
		and gr_3 = '$_POST[gr_3]'";
$exData = sql_fetch_array(sql_query($sql));

$sql = "select * 
		from $g4[group_table] 
		where gr_id = '$_POST[gr_id]'"; 
$cuData = sql_fetch_array(sql_query($sql));

$sql_common = " gr_1 = '$_POST[gr_1]',
				gr_2 = '$cuData[gr_2]',
                gr_3 = '$_POST[gr_3]' ";

$sql = "update $g4[group_table]
		set $sql_common
		where gr_id = '$exData[gr_id]'";
sql_query($sql);

$sql_common = str_replace("gr_2 = '$cuData[gr_2]'", "gr_2 = '$_POST[gr_2]'", $sql_common);

$sql = "update $g4[group_table]
		set $sql_common
		where gr_id = '$_POST[gr_id]'";
sql_query($sql);
********/

/******* 한칸씩 옴기기 *******/
$gr_id = $_POST[gr_id];
$gr_1 = $_POST[gr_1];
$gr_2 = $_POST[gr_2];
$gr_3 = $_POST[gr_3];
$current = $_POST[current];

for($i = $current, $max = $gr_2; $i != $max ; ($i < $max) ? $i += 1 : $i -= 1) {
	$cur = ($i < $max) ? $i + 1 : $i - 1;
	$sql = "update $g4[group_table]
			set gr_2 = '$i'
			where gr_2 = '$cur'
			and gr_3 = '$gr_3'
			";
	sql_query($sql);
}

$sql_common = " gr_1 = '$gr_1',
				gr_2 = '$gr_2',
				gr_3 = '$gr_3' ";

$sql = "update $g4[group_table]
		set $sql_common
		where gr_id = '$gr_id'";
sql_query($sql);

goto_url("./reno_SetMenu.php");
?>
