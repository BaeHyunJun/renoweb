<?
$sub_menu = "700100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

// 쪽지보낼시 차감 포인트 필드 추가 : 061218
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_memo_send_point` INT NOT NULL AFTER `cf_login_point` ", FALSE);

// 개인정보보호정책 필드 추가 : 061121
$sql = " ALTER TABLE `$g4[config_table]` ADD `cf_privacy` TEXT NOT NULL AFTER `cf_stipulation` ";
sql_query($sql, FALSE);
if (!trim($config[cf_privacy])) {
    $config[cf_privacy] = "해당 홈페이지에 맞는 개인정보취급방침을 입력합니다.";
}

$sql = "select count(*) as cnt from $g4[group_table] where gr_1 = 'main' and gr_3 = 'blog' order by gr_2 asc";
$row = sql_fetch($sql);
$count = $row[cnt];

$g4['title'] = "기본환경설정";
include_once ("./admin.head.php");
?>

<div id="breadcrumb">
	<a href="<?=$g4['admin_path']?>/" title="Go to Admin" class="tip-top"><i class="icon-home"></i> Admin</a>
	<a href="<?=$g4['admin_path']?>/" class="current"><?=$g4[title]?></a>
</div>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon">
						<i class="icon-align-justify"></i>									
					</span>
					<h5><?=$g4[title]?></h5>
				</div>
				<div class="widget-content nopadding">
<form name='fconfigform' method='post' onsubmit="return fconfigform_submit(this);" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
<input type=hidden name=token value='<?=$token?>'>
<input type='hidden' name='cf_use_point' value='0'>															<!-- 포인트 사용? -->
<input type='hidden' name='cf_login_point' value='0'>														<!-- 로그인시 지급 포인트 -->
<input type='hidden' name='cf_memo_send_point' value='0'>													<!-- 쪽지 보낼시 차감 포인트 -->
<input type='hidden' name='cf_cut_name' value='10'>															<!-- 이름(별명) 자릿수 -->
<input type='hidden' name='cf_nick_modify' value='7'>														<!-- 별명 변경 가능 일수 -->
<input type='hidden' name='cf_open_modify' value='7'>														<!-- 정보 공개 수정 가능 일수 -->
<input type='hidden' name='cf_new_del' value='30'>															<!-- 최신글 삭제 일 -->
<input type='hidden' name='cf_memo_del' value='30'>															<!-- 쪽지 삭제 일 -->
<input type='hidden' name='cf_visit_del' value='30'>														<!-- 접속자로그 삭제 일 -->
<input type='hidden' name='cf_popular_del' value='30'>														<!-- 인기 검색어 삭제 일 -->
<input type='hidden' name='cf_login_minutes' value='10'>													<!-- 현재 접속자 분류 시간(분) -->
<input type='hidden' name='cf_page_rows' value='10'>														<!-- 한페이지당 라인 수 -->
<input type='hidden' name='cf_new_skin' value='basic'>														<!-- 최근 게시물 스킨 -->
<input type='hidden' name='cf_new_rows' value='10'>															<!-- 최근 게시물 라인 수 -->
<input type='hidden' name='cf_search_skin' value='basic'>													<!-- 검색 스킨 -->
<input type='hidden' name='cf_connect_skin' value='basic'>													<!-- 접속자 스킨 -->
<input type='hidden' name='cf_use_copy_log' value='0'>														<!-- 복사, 이동 로그 -->
<input type='hidden' name='cf_possible_ip' value=''>														<!-- 접근 가능 IP -->
<input type='hidden' name='cf_intercept_ip' value=''>														<!-- 접근 차단 IP -->
<input type='hidden' name='cf_read_point' value='0'>														<!-- 글 읽기 시 포인트 -->
<input type='hidden' name='cf_write_point' value='0'>														<!-- 글 쓰기 시 포인트 -->
<input type='hidden' name='cf_comment_point' value='0'>														<!-- 코멘트 쓰기 시 포인트 -->
<input type='hidden' name='cf_download_point' value='0'>													<!-- 다운로드시 포인트 -->
<input type='hidden' name='cf_link_target' value='<?=$config[cf_link_target]?>'>							<!-- 링크 타겟 -->
<input type='hidden' name='cf_search_part' value='<?=$config[cf_search_part]?>'>							<!-- 검색 단위 -->
<input type='hidden' name='cf_search_bgcolor' value='<?=$config[cf_search_bgcolor]?>'>						<!-- 검색 배경 색상 -->
<input type='hidden' name='cf_search_color' value='<?=$config[cf_search_color]?>'>							<!-- 검색 글자 색상 -->
<input type='hidden' name='cf_delay_sec' value='10'>														<!-- 새로운 글쓰기 (초) -->
<input type='hidden' name='cf_write_pages' value='10'>														<!-- 페이지 표시 수 -->
<input type='hidden' name='cf_image_extension' value='<?=$config[cf_image_extension]?>'>					<!-- 이미지 업로드 확장자 -->
<input type='hidden' name='cf_flash_extension' value='<?=$config[cf_flash_extension]?>'>					<!-- 플래시 업로드 확장자 -->
<input type='hidden' name='cf_movie_extension' value='<?=$config[cf_movie_extension]?>'>					<!-- 동영상 업로드 확장자 -->
<input type='hidden' name='cf_filter' value='<?=$config[cf_filter]?>'>										<!-- 단어 필터링 -->
<input type='hidden' name='cf_member_skin' value='basic'>													<!-- 회원 스킨 -->
<input type='hidden' name='cf_use_homepage' value='0'>														<!-- 홈페이지 입력 보이기 -->
<input type='hidden' name='cf_req_homepage' value='0'>														<!-- 홈페이지 필수 입력 -->
<input type='hidden' name='cf_use_addr' value='0'>															<!-- 주소 입력 보이기 -->
<input type='hidden' name='cf_req_addr' value='0'>															<!-- 주소 필수 입력 -->
<input type='hidden' name='cf_use_tel' value='1'>															<!-- 전화번호 입력 보이기 -->
<input type='hidden' name='cf_req_tel' value='1'>															<!-- 전화번호 필수 입력 -->
<input type='hidden' name='cf_use_hp' value='0'>															<!-- 핸드폰 입력 보이기 -->
<input type='hidden' name='cf_req_hp' value='0'>															<!-- 핸드폰 필수 입력 -->
<input type='hidden' name='cf_use_signature' value='0'>														<!-- 서명 입력 보이기 -->
<input type='hidden' name='cf_req_signature' value='0'>														<!-- 서명 필수 입력 -->
<input type='hidden' name='cf_use_profile' value='0'>														<!-- 자기 소개 입력 보이기 -->
<input type='hidden' name='cf_req_profile' value='0'>														<!-- 자기 소개 필수 입력 -->
<input type='hidden' name='cf_register_level' value='2'>													<!-- 회원 가입 시 권한 -->
<input type='hidden' name='cf_register_point' value='0'>													<!-- 회원 가입 시 포인트 -->
<input type='hidden' name='cf_leave_day' value='0'>															<!-- 회원 탈퇴 후 삭제일 -->
<input type='hidden' name='cf_use_member_icon' value='0'>													<!-- 회원 아이콘 사용(0:미사용, 1:아이콘만 사용, 2:아이콘+이름 사용) -->
<input type='hidden' name='cf_icon_level' value='2'>														<!-- 아이콘 업로드 권한 -->
<input type='hidden' name='cf_member_icon_size' value='<?=$config[cf_member_icon_size]?>'>					<!-- 아이콘 용량 -->
<input type='hidden' name='cf_member_icon_width' value='<?=$config[cf_member_icon_width]?>'>				<!-- 아이콘 폭(px) -->
<input type='hidden' name='cf_member_icon_height' value='<?=$config[cf_member_icon_height]?>'>				<!-- 아이콘 높이(px) -->
<input type='hidden' name='cf_use_recommend' value='0'>														<!-- 추천인 제도 사용? -->
<input type='hidden' name='cf_recommend_point' value='0'>													<!-- 추천인 포인트 -->
<input type='hidden' name='cf_prohibit_id' value='<?=$config[cf_prohibit_id]?>'>							<!-- 아이디, 별명 금지 단어 -->
<input type='hidden' name='cf_prohibit_email' value='<?=$config[cf_prohibit_email]?>'>						<!-- 입력 금지 메일 -->
<input type='hidden' name='cf_email_use' value='1'>															<!-- 메일 발송 사용? -->
<input type='hidden' name='cf_use_email_certify' value='1'>													<!-- 메일 인증 사용? -->
<input type='hidden' name='cf_formmail_is_member' value='0'>												<!-- 폼 메일 사용? -->
<!-- 게시판 글 작성시 -->
<input type='hidden' name='cf_email_wr_super_admin' value='0'>												<!-- 최고 관리자에게 메일 발송 -->
<input type='hidden' name='cf_email_wr_group_admin' value='0'>												<!-- 메뉴 관리자에게 메일 발송 -->
<input type='hidden' name='cf_email_wr_board_admin' value='0'>												<!-- 게시판 관리자에게 메일 발송 -->
<input type='hidden' name='cf_email_wr_write' value='0'>													<!-- 글쓴이에게 메일 발송 -->
<input type='hidden' name='cf_email_wr_comment_all' value='0'>												<!-- 코멘트쓴 모든 사람에게 메일 발송(코멘트 작성시) -->
<!-- 회원 가입시 -->
<input type='hidden' name='cf_email_mb_super_admin' value='0'>												<!-- 최고관리자에게 메일 발송 -->
<input type='hidden' name='cf_email_mb_member' value='0'>													<!-- 가입한 회원에게 메일 발송 -->
<!-- 투표 기타의견 작성시 -->
<input type='hidden' name='cf_email_po_super_admin' value='0'>												<!-- 최고 관리자에게 메일 발송 -->


<input type='hidden' name='cf_1_subj' value='로고 용량'>														<!-- 여분 필드 -->
<input type='hidden' name='cf_2_subj' value='로고 width'>													<!-- 여분 필드 -->
<input type='hidden' name='cf_3_subj' value='로고 height'>													<!-- 여분 필드 -->
<input type='hidden' name='cf_4_subj' value='로고 경로'>														<!-- 여분 필드 -->
<input type='hidden' name='cf_5_subj' value='카피라이트'>														<!-- 여분 필드 -->
<input type='hidden' name='cf_6_subj' value='주소'>															<!-- 여분 필드 -->
<input type='hidden' name='cf_7_subj' value='기타'>															<!-- 여분 필드 -->
<input type='hidden' name='cf_8_subj' value='블로그 일체화 사용'>												<!-- 여분 필드 -->

<? for ($i=9; $i<=10; $i++) { ?>
	<input type='hidden' name='cf_<?=$i?>_subj' value='<?=get_text($config["cf_{$i}_subj"])?>'>
	<input type='hidden' name='cf_<?=$i?>' value='<?=$config["cf_$i"]?>'>
<? } ?>


						<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<label class="control-label">홈페이지 제목</label>
									<div class="controls">
        								<input type=text class=ed name='cf_title' size='30' required itemname='홈페이지 제목' value='<?=$config[cf_title]?>'>
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<label class="control-label">최고 관리자</label>
									<div class="controls">
										<?=get_member_id_select("cf_admin", 10, $config[cf_admin], "required itemname='최고 관리자'")?>
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span6">
								
								<div class="control-group">
									<label class="control-label">블로그 일체화 사용</label>
									<div class="controls">
										<?=get_Use_Blog_Menu("cf_8")?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">로고 사이즈</label>
									<div class="controls">
										폭 <input type=text class='ed' name='cf_2' size='5' value='<?=$config[cf_2]?>'> 픽셀 <br /> 
										높이 <input type=text class=ed name='cf_3' size='5' value='<?=$config[cf_3]?>'> 픽셀
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<label class="control-label">로고</label>
									<div class="controls">
								        <?
								        if (file_exists($logo_path)) {
								            echo "<br><img src='$logo_path' align=absmiddle>";
								            echo " <input type=checkbox name='del_cf_logo' value='1' class='csscheck'>삭제";
								        } else {
											echo "<input type=file name='cf_logo' class=ed><br />이미지 크기는 $config[cf_2] x $config[cf_3]으로 해주세요.";
										}
								        ?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">로고 용량</label>
									<div class="controls">
        								<input type=text class=ed name='cf_1' size='5' value='<?=$config[cf_1]?>'> 바이트 이하
									</div>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">메인 스킨</label>
							<div class="controls">
									<select name='cf_4' required itemname="스킨 디렉토리">
							        <?
							        $arr = get_skin_dir("page/main");
							        for ($i=0; $i<count($arr); $i++) {
							            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
							        }
							        ?></select>
							</div>
						</div>
								
						<div class="control-group">
							<label class="control-label">카피라이트</label>
							<div class="controls">
       							<input type=text class=ed name='cf_5' size='5' value='<?=$config[cf_5]?>'>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">주소</label>
							<div class="controls">
       							<input type=text class=ed name='cf_6' size='5' value='<?=$config[cf_6]?>'>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">기타</label>
							<div class="controls">
       							<input type=text class=ed name='cf_7' size='5' value='<?=$config[cf_7]?>'>
							</div>
						</div>
					
						<div class="control-group">
							<label class="control-label">회원가입약관</label>
							<div class="controls">
								<textarea class=ed name='cf_stipulation' rows='10' style='width:99%;'><?=$config[cf_stipulation]?> </textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">개인정보취급방침</label>
							<div class="controls">
								<textarea class=ed name='cf_privacy' rows='10' style='width:99%;'><?=$config[cf_privacy]?> </textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">관리자 패스워드</label>
							<div class="controls">
        						<input class='ed' type='password' name='admin_password' itemname="관리자 패스워드" required>
							</div>
						</div>
<p align=center>
    <input type=submit class=btn1 accesskey='s' value='  확    인  '>&nbsp;
					</form>
				</div>
			</div>						
		</div>
	</div>

<script type="text/javascript">
function check_Blog() {
	$num = <?=$count?>;
	if($num > 0) {
		if(document.getElementsByName('cf_8')[0].checked) {
			return false;
		}
		return true;
	} 
	return false;
}

function fconfigform_submit(f)
{
	if(check_Blog()) {
		alert('현재 블로그 메뉴가 존재 합니다. 메뉴를 제거 후 다시 설정해 주세요.');
		return false;
	}
	
    f.action = "./config_form_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>
