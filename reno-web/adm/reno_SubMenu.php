<?
$sub_menu = "100200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

// DHTML 에디터 사용 필드 추가 : 061021
sql_query(" ALTER TABLE `$g4[board_table]` ADD `bo_use_dhtml_editor` TINYINT NOT NULL AFTER `bo_use_secret` ", false);
// RSS 보이기 사용 필드 추가 : 061106
sql_query(" ALTER TABLE `$g4[board_table]` ADD `bo_use_rss_view` TINYINT NOT NULL AFTER `bo_use_dhtml_editor` ", false);

$sql_common = " from $g4[board_table] a ";
$sql_search = " where (1) ";

if ($is_admin != "super") {
    $sql_common .= " , $g4[group_table] b ";
    $sql_search .= " and (a.gr_id = b.gr_id and b.gr_admin = '$member[mb_id]') ";
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bo_table" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "a.gr_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.gr_id, a.bo_table";
    $sod = "asc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * 
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>처음</a>";

$g4[title] = "서브 메뉴 관리";
include_once("./admin.head.php");

$colspan = 6;
?>

<script type="text/javascript">
var list_update_php = 'board_list_update.php';
var list_delete_php = 'board_list_delete.php';
</script>

<div id="breadcrumb">
	<a href="<?=$g4['admin_path']?>/" title="Go to Admin" class="tip-top"><i class="icon-home"></i> Admin</a>
	<a href="<?=$g4['admin_path']?>/" class="current"><?=$g4[title]?></a>
</div>


<div class="container-fluid">
<form name=fsearch method=get class="row-fluid">
    <div class="span6" align=left>메뉴 수 : <?=number_format($total_count)?>개</div>
    <div class="span6" align=right>
		<select name=sfl>
            <option value='a.gr_id'>메인 메뉴 명</option>
            <option value='bo_table'>테이블 명</option>
            <option value='bo_subject'>서브 메뉴 명</option>
		</select>
        
		<span id="search">
        	<input placeholder="Search here..." type=text name=stx class=ed required itemname='검색어' value='<?=$stx?>'><button type="submit" class="tip-right" title="Search"><i class="icon-search icon-white"></i></button>
		</span>
	</div>
</form>


				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
								<h5><?=$g4[title]?></h5>
							</div>
							<div class="widget-content">
								<table class="table table-bordered table-striped table-hover with-check">

<colgroup width=180>
<colgroup width=250>
<colgroup width=250>
<colgroup width=150>
<colgroup width=250>
<colgroup width=80>
									<thead>
										<tr>
											<th>테이블 명</th>
											<th>메인 메뉴 명</th>
											<th>서브 메뉴 명</th>
											<th>메뉴 관리자</th>
											<th>적용 스킨</th>
											<th>수정 / 삭제</th>
										</tr>
									</thead>
									<tbody>
<?
// 스킨디렉토리
$skin_options = "";
$arr = get_skin_dir("board");
for ($k=0; $k<count($arr); $k++) 
{
    $option = $arr[$k];
    if (strlen($option) > 10)
        $option = substr($arr[$k], 0, 18) . "…";

    $skin_options .= "<option value='$arr[$k]'>$option</option>";
}

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $s_upd = "<a href='./board_form.php?w=u&bo_table=$row[bo_table]&$qstr'>
    
			<span class='icon'>
				<i class='icon-edit'></i>
			</span></a>";
    $s_del = "";
    if ($is_admin == "super") {
        //$s_del = "<a href=\"javascript:del('./board_delete.php?bo_table=$row[bo_table]&$qstr');\"><img src='img/icon_delete.gif' border=0 title='삭제'></a>";
        $s_del = "<a href=\"javascript:post_delete('board_delete.php', '$row[bo_table]');\">
			<span class='icon'>
				<i class='icon-remove'></i>
			</span></a>";
    }

    $list = $i % 2;
    echo "<input type=hidden name=board_table[$i] value='$row[bo_table]'>";
    echo "<tr class='list$list col1 ht center'>";
    echo "<td>
	    	<a href='$g4[bbs_path]/board.php?bo_table=$row[bo_table]'>
	    		<b>$row[bo_table]</b>
	   		</a>
    	</td>";

    
   	echo "<td align=left height=25><b>".$row[gr_id]."</b></td>";
    echo "<td align=left height=25><b>".get_text($row[bo_subject])."</b></td>";
    echo "<td align=left height=25><b>".$row[bo_admin]."</b></td>";
    echo "<td align=left height=25><b>".$row[bo_skin]."</b></td>";
    
    echo "<td>$s_upd / $s_del</td>";
    
    echo "</tr>";
} 

if ($i == 0)
    echo "<tr><td colspan='6' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>"; 

?>
									</tbody>
								</table>
<?
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
	
	echo "<div class='row-fluid'>";

	echo "<span class='span6' align=left>$pagelist</span>\n";

	if ($is_admin == "super") { 
		echo "<span class='span6' align=right><a href='./board_form.php' class='btn'>메뉴 추가</a></span>"; 
	} 
	
	echo "</div>";
?>
							</div>
						</div>						
					</div>
				</div>


<script type="text/javascript">
function board_copy(bo_table) {
    window.open("./board_copy.php?bo_table="+bo_table, "BoardCopy", "left=10,top=10,width=500,height=200");
}
</script>

<script>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        f.bo_table.value = val;
		f.action         = action_url;
		f.submit();
	}
}
</script>

<form name='fpost' method='post'>
<input type='hidden' name='sst'   value='<?=$sst?>'>
<input type='hidden' name='sod'   value='<?=$sod?>'>
<input type='hidden' name='sfl'   value='<?=$sfl?>'>
<input type='hidden' name='stx'   value='<?=$stx?>'>
<input type='hidden' name='page'  value='<?=$page?>'>
<input type='hidden' name='token' value='<?=$token?>'>
<input type='hidden' name='bo_table'>
</form>

<?
include_once("./admin.tail.php");
?>