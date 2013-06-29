<?
$sub_menu = "100100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($is_admin != "super" && $w == "") alert("최고관리자만 접근 가능합니다.");

$html_title = "메인 메뉴";
if ($w == "") 
{
    $gr_id_attr = "required";
    $gr[gr_use_access] = 0;
    $html_title .= " 생성";
} 
else if ($w == "u") 
{
    $gr_id_attr = "readonly style='background-color:#dddddd'";
    $gr = sql_fetch(" select * from $g4[group_table] where gr_id = '$gr_id' ");
    $html_title .= " 수정";
} 
else
    alert("제대로 된 값이 넘어오지 않았습니다.");

$g4[title] = $html_title;
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
								<form class="form-horizontal" name=fboardgroup method=post onsubmit="return fboardgroup_check(this);" autocomplete="off">
								<input type=hidden name=w     value='<?=$w?>'>
								<input type=hidden name=sfl   value='<?=$sfl?>'>
								<input type=hidden name=stx   value='<?=$stx?>'>
								<input type=hidden name=sst   value='<?=$sst?>'>
								<input type=hidden name=sod   value='<?=$sod?>'>
								<input type=hidden name=page  value='<?=$page?>'>
								<input type=hidden name=token value='<?=$token?>'>
									<div class="control-group">
										<label class="control-label">테이블 명</label>
										<div class="controls">
											<input type="text" style="height:30px;" class=ed name=gr_id size=11 maxlength=10 <?=$gr_id_attr?> alphanumericunderline itemname='그룹 아이디' value='<?=$group[gr_id]?>'/>
											<span class="help-block">영문자, 숫자, _ 만 가능 (공백없이)</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">메뉴 명</label>
										<div class="controls">
											<input type="text" style="height:30px;" class=ed name=gr_subject size=40 required itemname='그룹 제목' value='<?=get_text($group[gr_subject])?>' />
									        <? 
									        if ($w == 'u')
									            echo "<input type=button class='btn btn1' value='서브 메뉴 생성' onclick=\"location.href='./board_form.php?gr_id=$gr_id';\">";
									        ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">메뉴 관리자</label>
										<div class="controls">
								        <?
								        if ($is_admin == "super")
								            //echo get_member_id_select("gr_admin", 9, $row[gr_admin]);
								            echo "<input style='height:30px;' type='text' class=ed name='gr_admin' value='$gr[gr_admin]' maxlength=20>";
								        else
								            echo "<input style='height:30px;' type=hidden name='gr_admin' value='$gr[gr_admin]' size=40>$gr[gr_admin]";
								        ?>
										</div>
									</div>
									<div class="form-actions" style="text-align: center">
										<button type="submit" class="btn btn-primary">확인</button>
										<button type="button" class="btn btn1" onclick="document.location.href='./reno_MainMenu.php?<?=$qstr?>';">목록</button>
									</div>
								</form>
							</div>
						</div>						
					</div>
				</div>

<script type='text/javascript'>
if (document.fboardgroup.w.value == '')
    document.fboardgroup.gr_id.focus();
else
    document.fboardgroup.gr_subject.focus();

function fboardgroup_check(f)
{
    f.action = "./boardgroup_form_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>
