<?
$sub_menu = "100100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[group_table] ";

$sql_search = " where (1) ";
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

$listall = "<a href='$_SERVER[PHP_SELF]'>처음</a>";

$g4[title] = "메인 메뉴 관리";
include_once("./admin.head.php");

$colspan = 8;
?>

<script type="text/javascript">
var list_update_php = "./boardgroup_list_update.php";
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
			<option value="gr_id">테이블 명</option>
			<option value="gr_subject">제목 명</option>
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
<colgroup width=''>
<colgroup width=100>
<colgroup width=50>
<colgroup width=80>
									<thead>
										<tr>
											<th><?=subject_sort_link("gr_id")?>테이블 명</a></th>
											<th><?=subject_sort_link("gr_subject")?>메뉴 명</a></th>
											<th><?=subject_sort_link("gr_admin")?>메뉴 관리자</a></th>
											<th>세부 메뉴 수</th>
											<th>메인</th>
											<th>수정 / 삭제</th>
										</tr>
									</thead>
									<tbody>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    // 게시판수
    $sql2 = " select count(*) as cnt from $g4[board_table] where gr_id = '$row[gr_id]' ";
    $row2 = sql_fetch($sql2);

    $s_upd = "
		<a href='./boardgroup_form.php?$qstr&w=u&gr_id=$row[gr_id]'>
			<span class='icon'>
				<i class='icon-edit'></i>
			</span>
   		</a>";
    
    $s_del = "";
    if ($is_admin == "super") {
        //$s_del = "<a href=\"javascript:del('./boardgroup_delete.php?$qstr&gr_id=$row[gr_id]');\"><img src='img/icon_delete.gif' border=0 title='삭제'></a>";
        $s_del = "
    		<a href=\"javascript:post_delete('boardgroup_delete.php', '$row[gr_id]');\">
			<span class='icon'>
				<i class='icon-remove'></i>
			</span>
       		</a>";
    }

    $list = $i%2;
    echo "<input type=hidden name=gr_id[$i] value='$row[gr_id]'>";
    echo "<tr class='list$list' onmouseover=\"this.className='mouseover';\" onmouseout=\"this.className='list$list';\" height=27 align=center>";
//    echo "<td><input type=checkbox name=chk[] value='$i'></td>";
    echo "<td><b>$row[gr_id]</b></td>";
    echo "<td><b>".get_text($row[gr_subject])."</b></td>";

    if ($is_admin == "super")
        //echo "<td>".get_member_id_select("gr_admin[$i]", 9, $row[gr_admin])."</td>";
        echo "<td><label>$row[gr_admin]</label></td>";
    else
        echo "<td>$row[gr_admin]</td>";

    echo "<td><a href='./board_list.php?sfl=a.gr_id&stx=$row[gr_id]'>$row2[cnt]</a></td>";
    echo "<td><input type='checkbox' disabled ";
    if($row[gr_1] == 'on'){
		echo "checked";
	}
    echo "/></td>";
    echo "<td>$s_upd / $s_del</td>";
    echo "</tr>\n";
}
?>
									</tbody>
								</table>
<?
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
	
	echo "<div class='row-fluid'>";

	echo "<span class='span6' align=left>$pagelist</span>\n";

	if ($is_admin == "super") { 
		echo "<span class='span6' align=right><a href='./boardgroup_form.php'class='btn'>메뉴 추가</a></span>"; 
	} 
	
	echo "</div>";
?>
							</div>
						</div>						
					</div>
				</div>

				<div class="row-fluid">
					<div id="footer" class="span12">
						2012 - 2013 &copy; Unicorn Admin. Brought to you by <a href="https://wrapbootstrap.com/user/diablo9983">diablo9983</a>
					</div>
				</div>
			</div>
		</div>

<script>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        f.gr_id.value = val;
		f.action      = action_url;
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
<input type='hidden' name='gr_id'>
</form>

<?
include_once("./admin.tail.php");
?>
