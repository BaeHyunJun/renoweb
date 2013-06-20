<?
$sub_menu = "200100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[member_table] ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "mb_point" :
            $sql_search .= " ($sfl >= '$stx') ";
            break;
        case "mb_level" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        case "mb_tel" :
        case "mb_hp" :
            $sql_search .= " ($sfl like '%$stx') ";
            break;
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

//if ($is_admin == 'group') $sql_search .= " and mb_level = '$member[mb_level]' ";
if ($is_admin != 'super') 
    $sql_search .= " and mb_level <= '$member[mb_level]' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
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
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and mb_leave_date <> ''
         $sql_order ";
$row = sql_fetch($sql);
$leave_count = $row[cnt];

// 차단회원수
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and mb_intercept_date <> ''
         $sql_order ";
$row = sql_fetch($sql);
$intercept_count = $row[cnt];

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$g4[title] = "회원 관리";
include_once("./admin.head.php");

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
?>

<script type="text/javascript">
var list_update_php = "member_list_update.php";
var list_delete_php = "member_list_delete.php";
</script>

<div id="breadcrumb">
	<a href="<?=$g4['admin_path']?>/" title="Go to Admin" class="tip-top"><i class="icon-home"></i> Admin</a>
	<a href="<?=$g4['admin_path']?>/" class="current"><?=$g4[title]?></a>
</div>

<div class="container-fluid">
<form name=fsearch method=get class="row-fluid">
    <div class="span6" align=left>
   	총회원수 : <?=number_format($total_count)?>, 
        <a href='?sst=mb_intercept_date&sod=desc&sfl=<?=$sfl?>&stx=<?=$stx?>' title='차단된 회원부터 출력'><font color=orange>차단 : <?=number_format($intercept_count)?></font></a>, 
        <a href='?sst=mb_leave_date&sod=desc&sfl=<?=$sfl?>&stx=<?=$stx?>' title='탈퇴한 회원부터 출력'><font color=crimson>탈퇴 : <?=number_format($leave_count)?></font></a>
    </div>
    <div class="span6" align=right>
        <select name=sfl class=cssfl>
            <option value='mb_id'>회원아이디</option>
            <option value='mb_name'>이름</option>
            <option value='mb_nick'>별명</option>
            <option value='mb_email'>E-MAIL</option>
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

<colgroup width=15%>
<colgroup width=15%>
<colgroup width=15%>
<colgroup width=15%>
<colgroup width=15%>
<colgroup width=5%>
<colgroup width=5%>
<colgroup width=15%>
									<thead>
										<tr>
											<th><?=subject_sort_link('mb_id')?>아이디</th>
											<th><?=subject_sort_link('mb_name')?>이름</th>
											<th><?=subject_sort_link('mb_nick')?>별명</th>
											<th>E-mail</th>
											<th>최종 접속</th>
											<th>공개</th>
											<th>차단</th>
											<th>수정 / 삭제</th>
										</tr>
									</thead>
									<tbody>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($is_admin == 'group') 
    {
        $s_mod = "";
        $s_del = "";
    } 
    else 
    {
        $s_mod = 
        "<a href=\"./member_form.php?$qstr&w=u&mb_id=$row[mb_id]\">
                <span class='icon'>
        <i class='icon-edit'></i>
        </span></a>";
        //$s_del = "<a href=\"javascript:del('./member_delete.php?$qstr&w=d&mb_id=$row[mb_id]');\"><img src='img/icon_delete.gif' border=0 title='삭제'></a>";
        $s_del = 
        "<a href=\"javascript:post_delete('member_delete.php', '$row[mb_id]');\">
        <span class='icon'>
        <i class='icon-remove'></i>
        </span></a>";
    }

    $leave_date = $row[mb_leave_date] ? $row[mb_leave_date] : date("Ymd", $g4[server_time]);
    $intercept_date = $row[mb_intercept_date] ? $row[mb_intercept_date] : date("Ymd", $g4[server_time]);

    $mb_nick = get_sideview($row[mb_id], $row[mb_nick], $row[mb_email], $row[mb_homepage]);

    $mb_id = $row[mb_id];
    if ($row[mb_leave_date])
        $mb_id = "<font color=crimson>$mb_id</font>";
    else if ($row[mb_intercept_date])
        $mb_id = "<font color=orange>$mb_id</font>";

    $list = $i%2;
    echo "
    <input type=hidden name=mb_id[$i] value='$row[mb_id]'>
    <tr class='list$list col1 ht center'>
        <td title='$row[mb_id]'>$mb_id</td>
        <td>$row[mb_name]</td>
        <td><u>$mb_nick</u></td>
        <td>$row[mb_email]</td>
        <td>".substr($row[mb_today_login],2,8)."</td>
        <td>".($row[mb_open]?'&radic;':'&nbsp;')."</td>
        <!-- <td title='$row[mb_leave_date]'>".($row[mb_leave_date]?'&radic;':'&nbsp;')."</td> -->
        <td title='$row[mb_intercept_date]'><input type=checkbox disabled name=mb_intercept_date[$i] ".($row[mb_intercept_date]?'checked':'')." value='$intercept_date'></td>
        <td>$s_mod / $s_del</td>
    </tr>";
}

if ($i == 0)
    echo "<tr><td colspan='8' align=center height=100 class=contentbg>자료가 없습니다.</td></tr>";


if ($stx)
    echo "<script type='text/javascript'>document.fsearch.sfl.value = '$sfl';</script>\n";
?>
									</tbody>
								</table>
* 회원자료 삭제시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 별명은 삭제하지 않고 영구 보관합니다.

<?
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
	
	echo "<div class='row-fluid'>";

	echo "<span class='span6' align=left>$pagelist</span>\n";
	
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
        f.mb_id.value = val;
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
<input type='hidden' name='mb_id'>
</form>

<?
include_once ("./admin.tail.php");
?>
