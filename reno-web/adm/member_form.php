<?
$sub_menu = "200100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($w == "") 
{
    $required_mb_id = "required minlength=3 alphanumericunderline itemname='회원아이디'";
    $required_mb_password = "required itemname='패스워드'";

    $mb[mb_mailling] = 1;
    $mb[mb_open] = 1;
    $mb[mb_level] = $config[cf_register_level];
    $html_title = "등록";
}
else if ($w == "u") 
{
    $mb = get_member($mb_id);
    if (!$mb[mb_id])
        alert("존재하지 않는 회원자료입니다."); 

    if ($is_admin != 'super' && $mb[mb_level] >= $member[mb_level])
        alert("자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.");

    $required_mb_id = "readonly style='background-color:#dddddd;'";
    $required_mb_password = "";
    $html_title = "수정";

    $mb[mb_email]       = get_text($mb[mb_email]);
    $mb[mb_homepage]    = get_text($mb[mb_homepage]);
    $mb[mb_password_q]  = get_text($mb[mb_password_q]);
    $mb[mb_password_a]  = get_text($mb[mb_password_a]);
    $mb[mb_birth]       = get_text($mb[mb_birth]);
    $mb[mb_tel]         = get_text($mb[mb_tel]);
    $mb[mb_hp]          = get_text($mb[mb_hp]);
    $mb[mb_addr1]       = get_text($mb[mb_addr1]);
    $mb[mb_addr2]       = get_text($mb[mb_addr2]);
    $mb[mb_signature]   = get_text($mb[mb_signature]);
    $mb[mb_recommend]   = get_text($mb[mb_recommend]);
    $mb[mb_profile]     = get_text($mb[mb_profile]);
    $mb[mb_1]           = get_text($mb[mb_1]);
    $mb[mb_2]           = get_text($mb[mb_2]);
    $mb[mb_3]           = get_text($mb[mb_3]);
    $mb[mb_4]           = get_text($mb[mb_4]);
    $mb[mb_5]           = get_text($mb[mb_5]);
    $mb[mb_6]           = get_text($mb[mb_6]);
    $mb[mb_7]           = get_text($mb[mb_7]);
    $mb[mb_8]           = get_text($mb[mb_8]);
    $mb[mb_9]           = get_text($mb[mb_9]);
    $mb[mb_10]          = get_text($mb[mb_10]);
} 
else 
    alert("제대로 된 값이 넘어오지 않았습니다.");

if ($mb[mb_mailling]) $mailling_checked = "checked"; // 메일 수신
if ($mb[mb_sms])      $sms_checked = "checked"; // SMS 수신
if ($mb[mb_open])     $open_checked = "checked"; // 정보 공개

$g4[title] = "회원정보 " . $html_title;
include_once("./admin.head.php");
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
<form name=fmember method=post action="./member_form_update.php" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
<input type=hidden name=w     value='<?=$w?>'>
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>
						<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<label class="control-label">아이디</label>
									<div class="controls">
        								<input type=text class=ed name='mb_id' size=20 maxlength=20 minlength=2 <?=$required_mb_id?> itemname='아이디' value='<? echo $mb[mb_id] ?>'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">이름(실명)</label>
									<div class="controls">
										<input type=text class=ed name='mb_name' maxlength=20 minlength=2 required itemname='이름(실명)' value='<? echo $mb[mb_name] ?>'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">E-mail</label>
									<div class="controls">
										<input type=text class=ed name='mb_email' size=40 maxlength=100 required email itemname='e-mail' value='<? echo $mb[mb_email] ?>'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">생년월일</label>
									<div class="controls">
										<input type=text class=ed name=mb_birth size=9 maxlength=8 value='<? echo $mb[mb_birth] ?>'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">메일 수신</label>
									<div class="controls">
										<input type=checkbox name=mb_mailling value='1' <?=$mailling_checked?>> 정보 메일을 받음
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">정보 공개</label>
									<div class="controls">
										<input type=checkbox name=mb_open value='1' <?=$open_checked?>> 타인에게 자신의 정보를 공개
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">회원 가입 일자</label>
									<div class="controls">
										<?=$mb[mb_datetime]?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">최근 접속 일자</label>
									<div class="controls">
										<?=$mb[mb_today_login]?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">회원 탈퇴 일자</label>
									<div class="controls">
										<input type=text class=ed name=mb_leave_date size=9 maxlength=8 value='<? echo $mb[mb_leave_date] ?>'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">관리자 패스워드</label>
									<div class="controls">
										<input class='ed' type='password' name='admin_password' itemname="관리자 패스워드" required>
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<label class="control-label">패스워드</label>
									<div class="controls">
										<input type=password class=ed name='mb_password' size=20 maxlength=20 <?=$required_mb_password?> itemname='암호'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">별명</label>
									<div class="controls">
										<input type=text class=ed name='mb_nick' maxlength=20 minlength=2 required itemname='별명' value='<? echo $mb[mb_nick] ?>'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">전화 번호</label>
									<div class="controls">
										<input type=text class=ed name='mb_tel' maxlength=20 itemname='전화번호' value='<? echo $mb[mb_tel] ?>'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">성별</label>
									<div class="controls">
								        <select name=mb_sex><option value=''>----<option value='F'>여자<option value='M'>남자</select>
								        <script type="text/javascript"> document.fmember.mb_sex.value = "<?=$mb[mb_sex]?>"; </script>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">SMS 수신</label>
									<div class="controls">
										<input type=checkbox name=mb_sms value='1' <?=$sms_checked?>> 문자메세지를 받음
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">자기 소개</label>
									<div class="controls">
										<textarea class=ed name=mb_profile rows=6 style='width:99%; word-break:break-all;'><? echo $mb[mb_profile] ?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">회원 차단 일자</label>
									<div class="controls">
										<input type=text class=ed name=mb_intercept_date size=9 maxlength=8 value='<? echo $mb[mb_intercept_date] ?>'> <input type=checkbox value='<? echo date("Ymd"); ?>' onclick='if (this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else { this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; } '>오늘
									</div>
								</div>
							</div>
						</div>
<p align=center>
    <input type=submit class=btn1 accesskey='s' value='  확    인  '>&nbsp;
    <input type=button class=btn1 value='  목  록  ' onclick="document.location.href='./member_list.php?<?=$qstr?>';">&nbsp;
					</form>
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

<script type='text/javascript'>
if (document.fmember.w.value == "")
    document.fmember.mb_id.focus();
else if (document.fmember.w.value == "u")
    document.fmember.mb_password.focus();

if (typeof(document.fmember.mb_level) != "undefined") 
    document.fmember.mb_level.value   = "<?=$mb[mb_level]?>"; 
</script>

<?
include_once("./admin.tail.php");
?>
