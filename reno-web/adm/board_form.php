<?
$sub_menu = "100200";
include_once("./_common.php");
include_once ("$g4[path]/lib/cheditor4.lib.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

function b_draw($pos, $color='red') {
    return "border-{$pos}-width:1px; border-{$pos}-color:{$color}; border-{$pos}-style:solid; ";
}

$sql = " select count(*) as cnt from $g4[group_table] ";
$row = sql_fetch($sql);
if (!$row[cnt])
    alert("게시판그룹이 한개 이상 생성되어야 합니다.", "./boardgroup_form.php");

$html_title = "서브 메뉴";
if ($w == "") {
    $html_title .= " 생성";

    $bo_table_attr = "required alphanumericunderline";

    $board[bo_count_delete] = '1';
    $board[bo_count_modify] = '1';
    $board[bo_read_point] = $config[cf_read_point];
    $board[bo_write_point] = $config[cf_write_point];
    $board[bo_comment_point] = $config[cf_comment_point];
    $board[bo_download_point] = $config[cf_download_point];

    $board[bo_gallery_cols] = '4';
    $board[bo_table_width] = '97';
    $board[bo_page_rows] = $config[cf_page_rows];
    $board[bo_subject_len] = '60';
    $board[bo_new] = '24';
    $board[bo_hot] = '100';
    $board[bo_image_width] = '600';
    $board[bo_upload_count] = '2';
    $board[bo_upload_size] = '1048576';
    $board[bo_reply_order] = '1';
    $board[bo_use_search] = '1';
    $board[bo_skin] = 'basic';
    $board[gr_id] = $gr_id;
    $board[bo_disable_tags] = "script|iframe";
    $board[bo_use_secret] = 0;
} else if ($w == "u") {
    $html_title .= " 수정";

    if (!$board[bo_table])
        alert("존재하지 않은 게시판 입니다.");

    if ($is_admin == "group") {
        if ($member[mb_id] != $group[gr_admin]) 
            alert("그룹이 틀립니다.");
    }

    $bo_table_attr = "readonly style='background-color:#dddddd'";
}

if ($is_admin != "super") {
    $group = get_group($board[gr_id]);
    $is_admin = is_admin($member[mb_id]);
}

$g4[title] = $html_title;
include_once ("./admin.head.php");
?>

<script src="<?=$g4[cheditor4_path]?>/cheditor.js"></script>
<?=cheditor1('bo_content_head', '100%', '200');?>
<?=cheditor1('bo_content_tail', '100%', '200');?>

<div id="breadcrumb">
	<a href="<?=$g4['admin_path']?>/" title="Go to Admin" class="tip-top"><i class="icon-home"></i> Admin</a>
	<a href="<?=$g4['admin_path']?>/" class="current"><?=$g4[title]?></a>
</div>

<div class="container-fluid">
<form name=fboardform method=post onsubmit="return fboardform_submit(this)" enctype="multipart/form-data">
<input type=hidden name="w"     value="<?=$w?>">
<input type=hidden name="sfl"   value="<?=$sfl?>">
<input type=hidden name="stx"   value="<?=$stx?>">
<input type=hidden name="sst"   value="<?=$sst?>">
<input type=hidden name="sod"   value="<?=$sod?>">
<input type=hidden name="page"  value="<?=$page?>">
<input type=hidden name="token" value="<?=$token?>">
<input type=hidden name=proc_count value=1>
<input type=hidden name=bo_list_level value=1>
<input type=hidden name=bo_read_level value=1>
<input type=hidden name=bo_write_level value=1>
<input type=hidden name=bo_reply_level value=1>
<input type=hidden name=bo_comment_level value=1>
<input type=hidden name=bo_upload_level value=1>
<input type=hidden name=bo_download_level value=1>
<input type=hidden name=bo_html_level value=1>
<input type=hidden name=bo_trackback_level value=1>
<input type=hidden name=bo_count_modify value='1'>
<input type=hidden name=bo_count_delete value='1'>
<input type=hidden name=bo_read_point value='0'>
<input type=hidden name=bo_write_point value='0'>
<input type=hidden name=bo_comment_point value='0'>
<input type=hidden name=bo_download_point value='0'>
<input type=hidden name=bo_category_list value=''>
<input type=hidden name=bo_use_category value='0'>
<input type=hidden name=bo_use_sideview value='0'>
<input type=hidden name=bo_use_file_content value='0'>
<input type=hidden name=bo_use_comment value='0'>
<input type=hidden name=bo_use_dhtml_editor value='1'>
<input type=hidden name=bo_use_rss_view value='0'>
<input type=hidden name=bo_use_good value='0'>
<input type=hidden name=bo_use_nogood value='0'>
<input type=hidden name=bo_use_name value='1'>
<input type=hidden name=bo_use_signature value='0'>
<input type=hidden name=bo_use_ip_view value='0'>
<input type=hidden name=bo_use_trackback value='0'>
<input type=hidden name=bo_use_list_content value='0'>
<input type=hidden name=bo_use_list_view value='0'>
<input type=hidden name=bo_use_email value='0'>
<input type=hidden name=bo_gallery_cols value='4'>
<input type=hidden name=bo_table_width value='97'>
<input type=hidden name=bo_image_width value='600'>
<input type=hidden name=bo_reply_order value='1'>
<input type=hidden name=bo_sort_field value=''>
<input type=hidden name=bo_write_min value='0'>
<input type=hidden name=bo_write_max value='0'>
<input type=hidden name=bo_comment_min value='0'>
<input type=hidden name=bo_comment_max value='0'>
<input type=hidden name=bo_upload_count value='2'>
<input type=hidden name=bo_new value='0'>
<input type=hidden name=bo_hot value='0'>
<input type=hidden name=bo_upload_size value='<?=$board[bo_upload_size]?>'>
<input type=hidden name=bo_include_head value='<?=g4_path?>/_head.php'>
<input type=hidden name=bo_include_tail value='<?=g4_path?>/_tail.php'>
<input type=hidden name=bo_content_head value=''>
<input type=hidden name=bo_content_tail value=''>
<input type=hidden name=bo_insert_content value=''>
<input type=hidden name=bo_use_search value='1'>
<input type=hidden name=bo_order_search value='0'>
<input type=hidden name=bo_1 value=''>
<input type=hidden name=bo_2 value=''>
<input type=hidden name=bo_3 value=''>
<input type=hidden name=bo_4 value=''>
<input type=hidden name=bo_5 value=''>
<input type=hidden name=bo_6 value=''>
<input type=hidden name=bo_7 value=''>
<input type=hidden name=bo_8 value=''>
<input type=hidden name=bo_9 value=''>
<input type=hidden name=bo_10 value=''>

	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon">
						<i class="icon-align-justify"></i>									
					</span>
					<h5><?=$g4[title]?></h5>
				</div>
				<div class="widget-content">
					<div class="row-fluid">
						<div class="span6">
							<div class="control-group">
								<label class="control-label">테이블 명 </label>
								<div class="controls">
									<input type=text class=ed name=bo_table size=30 maxlength=20 <?=$bo_table_attr?> itemname='TABLE' value='<?=$board[bo_table] ?>'>
							        <? 
							        if ($w == "") 
							            echo "영문자, 숫자, _ 만 가능 (공백없이 20자 이내)";
							        else 
							            echo "<a href='$g4[bbs_path]/board.php?bo_table=$board[bo_table]'><img src='$g4[admin_path]/img/icon_view.gif' border=0 align=absmiddle></a>";
							        ?>
									<span class="help-block">(테이블 명은 한번 저장되면 다시 바꿀 수 없음)</span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">서브 메뉴 명</label>
								<div class="controls">
		        					<input type=text class=ed name=bo_subject size=60 maxlength=120 required itemname='게시판 제목' value='<?=get_text($board[bo_subject])?>'>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">게시판 관리자</label>
								<div class="controls">
									<input type=text class=ed name=bo_admin maxlength=20 value='<?=$board[bo_admin]?>'>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">적용 스킨</label>
								<div class="controls">
									<select name=bo_skin required itemname="스킨 디렉토리">
							        <?
							        $arr = get_skin_dir("board");
							        for ($i=0; $i<count($arr); $i++) {
							            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
							        }
							        ?></select>
							        <script type="text/javascript">document.fboardform.bo_skin.value="<?=$board[bo_skin]?>";</script>
								</div>
							</div>
							<div class="control-group" style="margin-top: 20px">
								<label class="control-label">페이지당 게시판 글 수</label>
								<div class="controls">
									<input type=text class=ed name=bo_page_rows size=10 required itemname='페이지당 목록 수' value='<?=$board[bo_page_rows]?>'>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">관리자 암호</label>
								<div class="controls">
		        					<input class='ed' type='password' name='admin_password' itemname="관리자 패스워드" required>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="control-group">
								<label class="control-label">메인 메뉴</label>
								<div class="controls">
							        <?=get_group_select('gr_id', $board[gr_id], "required itemname='그룹'");?>
							        <? if ($w=='u') { ?><a href="javascript:location.href='./board_list.php?sfl=a.gr_id&stx='+document.fboardform.gr_id.value;">동일그룹게시판목록</a><?}?></td>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">컨텐츠 상단 이미지</label>
								<div class="controls">
							        <input type=file name=bo_image_head class=ed size=60>
							        <?
							        if ($board[bo_image_head])
							            echo "<br><a href='$g4[path]/data/file/{$board['bo_table']}/$board[bo_image_head]' target='_blank'>$board[bo_image_head]</a> <input type=checkbox name='bo_image_head_del' value='$board[bo_image_head]'> 삭제";
							        ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">컨텐츠 하단 이미지</label>
								<div class="controls">
							        <input type=file name=bo_image_tail class=ed size=60>
							        <? 
							        if ($board[bo_image_tail]) 
							            echo "<br><a href='$g4[path]/data/file/{$board['bo_table']}/$board[bo_image_tail]' target='_blank'>$board[bo_image_tail]</a> <input type=checkbox name='bo_image_tail_del' value='$board[bo_image_tail]'> 삭제";
							        ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">비밀글 사용</label>
								<div class="controls">
							        <select name=bo_use_secret id='bo_use_secret'>
							        <option value='0'>사용하지 않음
							        <option value='1'>체크박스
							        <option value='2'>무조건
							        </select>
							        <span class="help-block">
							        '체크박스'는 글작성시 비밀글 체크가 가능하도록 설정됩니다.<br/>
							        '무조건'은 작성되는 모든글을 비밀글로 작성합니다. (관리자는 체크박스로 출력합니다.)<br/>
							        스킨에 따라 적용되지 않을 수 있습니다.</span>
							        <script type='text/javascript'>document.getElementById('bo_use_secret').value='<?=$board[bo_use_secret]?>';</script>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">게시글 제목 길이 제한</label>
								<div class="controls">
									<input type=text class=ed name=bo_subject_len size=10 required itemname='제목 길이' value='<?=$board[bo_subject_len]?>'>
									<span class="help-block">목록에서의 제목 글자수. 잘리는 글은 … 로 표시</span>
								</div>
							</div>
						</div>
					</div>
					<div style="text-align:center">
						<button type="submit" class="btn btn-primary" accesskey='s'>확인</button>
						<button type="button" class="btn" onclick="document.location.href='./reno_SubMenu.php?<?=$qstr?>';">목록</button>
					</div>
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
</form>

<script type="text/javascript">
function board_copy(bo_table) {
    window.open("./board_copy.php?bo_table="+bo_table, "BoardCopy", "left=10,top=10,width=500,height=200");
}

function set_point(f) {
    if (f.chk_point.checked) {
        f.bo_read_point.value     = "<?=$config[cf_read_point]?>";
        f.bo_write_point.value    = "<?=$config[cf_write_point]?>";
        f.bo_comment_point.value  = "<?=$config[cf_comment_point]?>";
        f.bo_download_point.value = "<?=$config[cf_download_point]?>";
    } else {
        f.bo_read_point.value     = f.bo_read_point.defaultValue;
        f.bo_write_point.value    = f.bo_write_point.defaultValue;
        f.bo_comment_point.value  = f.bo_comment_point.defaultValue;
        f.bo_download_point.value = f.bo_download_point.defaultValue;
    }
}

function fboardform_submit(f) {
    var tmp_title;
    var tmp_image;

    tmp_title = "상단";
    tmp_image = f.bo_image_head;
    if (tmp_image.value) {
        if (!tmp_image.value.toLowerCase().match(/.(gif|jpg|png)$/i)) {
            alert(tmp_title + "이미지가 gif, jpg, png 파일이 아닙니다.");
            return false;
        }
    }

    tmp_title = "하단";
    tmp_image = f.bo_image_tail;
    if (tmp_image.value) {
        if (!tmp_image.value.toLowerCase().match(/.(gif|jpg|png)$/i)) {
            alert(tmp_title + "이미지가 gif, jpg, png 파일이 아닙니다.");
            return false;
        }
    }

    if (parseInt(f.bo_count_modify.value) < 1) {
        alert("원글 수정 불가 코멘트수는 1 이상 입력하셔야 합니다.");
        f.bo_count_modify.focus();
        return false;
    }

    if (parseInt(f.bo_count_delete.value) < 1) {
        alert("원글 삭제 불가 코멘트수는 1 이상 입력하셔야 합니다.");
        f.bo_count_delete.focus();
        return false;
    }

    f.action = "./board_form_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>
