<?
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$sql_common = " from $g4[group_table] ";

$sql_search = " where (1) ";

$sql_search .= " and gr_1 = ''";

if ($is_admin != "super")
    $sql_search .= " and (gr_admin = '$member[mb_id]') ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "gr_id" :
        case "gr_admin" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($sst)
    $sql_order = " order by $sst $sod ";
else
    $sql_order = " order by gr_id asc ";

$sql = " select count(*) as cnt
         $sql_common 
         $sql_search 
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * 
          $sql_common 
          $sql_search
          $sql_order 
          limit $from_record, $rows ";

$result = sql_query($sql);
?>
<table>
<?
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    echo "<tr>";
    echo "<td><input type='checkbox'></td>";
    echo "<td><b>".get_text($row[gr_subject])."</b></td>";
    echo "</tr>";
}

if ($i == 0)
    echo "<tr><td colspan='6' align=center height=100 bgcolor=#ffffff>설정되지 않은 메뉴가 없습니다.</td></tr>"; 
?>
</table>