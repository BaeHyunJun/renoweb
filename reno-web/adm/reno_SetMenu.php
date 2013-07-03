<?
$sub_menu = "100300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$g4[title] = "메뉴 설정";
include_once("./admin.head.php");

$colspan = 8;
?>

<div id="breadcrumb">
	<a href="<?=$g4['admin_path']?>/" title="Go to Admin" class="tip-top"><i class="icon-home"></i> Admin</a>
	<a href="<?=$g4['admin_path']?>/" class="current"><?=$g4[title]?></a>
</div>

<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="alert">
					<storng>해당 메뉴들은 드래그&드롭으로 순서 변경이 가능합니다.</storng>
				</div>
<div class="widget-box">
	<div class="widget-title">
		<span class="icon">
			<i class="icon-th"></i>
		</span>
		<h5>메인 <?=$g4[title]?></h5>
		<div class="buttons">
			<a title="Icon Title" class="btn btn-mini" href="./reno_SetMenu_form.php?m=main"><i class="icon-plus-sign"></i> 추가하기</a>
		</div>
	</div>
	<div class="widget-content" >
		<div class="row-fluid">
<?
if($config[cf_8] == 1) {
?>
			<div class="span6">
				<div class="widget-box" style="margin: 0;">
					<div class="widget-title">
						<h5>블로그 메뉴</h5>
					</div>
					<div class="widget-content" >
						<ul id="blog-sort" class="sort">
						<?
						for ($i=0; $row=sql_fetch_array($blog_M); $i++)
						{
						    echo "<li id='blog$i' class='ui-state-default' data-id='$row[gr_id]' data-1='$row[gr_1]' data-2='$row[gr_2]' data-3='$row[gr_3]'>";
						    echo get_text($row[gr_subject]);
						    echo "<a href=\"javascript:remove_menu('blog$i');\" class='pull-right'><i class='icon-remove' style='margin-top: 4px'></i></a>
								  <i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
								  </li>";
						}
						?>
						</ul>
						<?
						if ($i == 0)
						    echo "<h3>설정된 메뉴가 없습니다.</h3>"; 
						?>
					</div>
				</div>
			</div>
			<div class="span6">
<?
} else {
?>
			<div class="span12">
<?
}
?>
				<div class="widget-box" style="margin: 0;">
					<div class="widget-title">
						<h5>홈페이지 메뉴</h5>
					</div>
					<div class="widget-content" >
						<ul id="main-sort" class="sort">
						<?
						for ($i=0; $row=sql_fetch_array($homepage_M); $i++)
						{
						    echo "<li id='home$i' class='ui-state-default' data-id='$row[gr_id]' data-1='$row[gr_1]' data-2='$row[gr_2]' data-3='$row[gr_3]'>";
						    echo get_text($row[gr_subject]);
						    echo "<a href=\"javascript:remove_menu('home$i');\" class='pull-right'><i class='icon-remove' style='margin-top: 4px'></i></a>
								  <i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
								  </li>";
						}
						?>
						</ul>
						<?
						if ($i == 0)
						    echo "<h3>설정된 메뉴가 없습니다.</h3>"; 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>			
<div class="widget-box">
	<div class="widget-title">
		<span class="icon">
			<i class="icon-th"></i>
		</span>
		<h5>유저 <?=$g4[title]?></h5>
		<div class="buttons">
			<a title="Icon Title" class="btn btn-mini" href="./reno_SetMenu_form.php?m=user"><i class="icon-plus-sign"></i> 추가하기</a>
		</div>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<div class="span6">
				<div class="widget-box" style="margin: 0;">
					<div class="widget-title">
						<h5>로그인시 메뉴</h5>
					</div>
					<div class="widget-content" >
<ul id="login-sort" class="sort">
<?
for ($i=0; $row=sql_fetch_array($login_M); $i++)
{
    echo "<li id='login$i' class='ui-state-default' data-id='$row[gr_id]' data-1='$row[gr_1]' data-2='$row[gr_2]' data-3='$row[gr_3]'>";
    echo get_text($row[gr_subject]);
    echo "<a href=\"javascript:remove_menu('login$i');\" class='pull-right'><i class='icon-remove' style='margin-top: 4px'></i></a>
		  <i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
		  </li>";
}
?>
</ul>
<?
if ($i == 0)
    echo "<h3>설정된 메뉴가 없습니다.</h3>"; 
?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="widget-box" style="margin: 0;">
					<div class="widget-title">
						<h5>로그아웃시 메뉴</h5>
					</div>
					<div class="widget-content" >
<ul id="logout-sort" class="sort">
<?
for ($i=0; $row=sql_fetch_array($logout_M); $i++)
{
    echo "<li id='logout$i' class='ui-state-default' data-id='$row[gr_id]' data-1='$row[gr_1]' data-2='$row[gr_2]' data-3='$row[gr_3]'>";
    echo get_text($row[gr_subject]);
    echo "<a href=\"javascript:remove_menu('logout$i');\" class='pull-right'><i class='icon-remove' style='margin-top: 4px'></i></a>
		  <i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
		  </li>";
}
?>
</ul>
<?
if ($i == 0)
    echo "<h3>설정된 메뉴가 없습니다.</h3>"; 
?>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>			
<div class="widget-box">
	<div class="widget-title">
		<span class="icon">
			<i class="icon-th"></i>
		</span>
		<h5>하단 <?=$g4[title]?></h5>
		<div class="buttons">
			<a title="Icon Title" class="btn btn-mini" href="./reno_SetMenu_form.php?m=foot"><i class="icon-plus-sign"></i> 추가하기</a>
		</div>
	</div>
	<div class="widget-content">
	
<ul id="foot-sort" class="sort">
<?
for ($i=0; $row=sql_fetch_array($footer_M); $i++)
{
    echo "<li id='foot$i' class='ui-state-default' data-id='$row[gr_id]' data-1='$row[gr_1]' data-2='$row[gr_2]' data-3='$row[gr_3]'>";
    echo get_text($row[gr_subject]);
    echo "<a href=\"javascript:remove_menu('foot$i');\" class='pull-right'><i class='icon-remove' style='margin-top: 4px'></i></a>
		  <i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
		  </li>";
}
?>
</ul>
<?
if ($i == 0)
    echo "<h3>설정된 메뉴가 없습니다.</h3>"; 
?>
		
	</div>
</div>								
			</div>
		</div>

<form name='fpost' method='post'>
<input type='hidden' name='sst'   value='<?=$sst?>'>
<input type='hidden' name='sod'   value='<?=$sod?>'>
<input type='hidden' name='sfl'   value='<?=$sfl?>'>
<input type='hidden' name='stx'   value='<?=$stx?>'>
<input type='hidden' name='page'  value='<?=$page?>'>
<input type='hidden' name='token' value='<?=$token?>'>
<input type='hidden' name='gr_id'>
<input type='hidden' name='gr_1'>
<input type='hidden' name='gr_2'>
<input type='hidden' name='gr_3'>
<input type='hidden' name='current'>
</form>
<script>
function add_menu_form() {
	$.post("<?=$g4['admin_path']?>/reno_SetMenu_form.php", function(result){
		if(result)
		{
			$('#add_cont')[0].innerHTML = result;
			$('#layer_pop').css('display','block');
		}
		else
		{
			alert('error : 선택하신 스킨으로 설정되지 않았습니다. 고객센터에 문의해 주세요.');
		}
	});
}

function close_form() {
	$('#layer_pop').css('display','none');
}

$(function() {
	$("#blog-sort, #main-sort, #login-sort, #logout-sort, #foot-sort").sortable({
		start: function (event, ui) {
			if( ui.helper !== undefined ) {
				ui.helper.css('position','absolute').css('margin-top', $(window).scrollTop() );
			}
		},
		beforeStop: function (event, ui) {
			if( ui.offset !== undefined )
				ui.helper.css('margin-top', 0);
			
		    var f		= document.fpost,
		    	index 	= $(ui.placeholder).index();
		    
			if(index != $("#"+$(ui.item).attr('id')).attr('data-2')){
			    if(confirm('메뉴 순서를 바꾸시겠습니까?')) {
			        f.gr_id.value 	= $("#"+$(ui.item).attr('id')).attr('data-id');
			    	f.gr_1.value	= $("#"+$(ui.item).attr('id')).attr('data-1');
			    	f.gr_2.value	= $(ui.placeholder).index();
			    	f.gr_3.value	= $("#"+$(ui.item).attr('id')).attr('data-3');
			    	f.current.value	= $("#"+$(ui.item).attr('id')).attr('data-2');
					f.action      	= "<?=$g4['admin_path']?>/reno_SetMenu_update.php";
					f.submit();
			    } else {
		    		reflesh();
			    }
			}
		},
		placeholder: "ui-state-highlight"
	}).disableSelection();
});

function reflesh() {
	location.href="./reno_SetMenu.php";
}

function remove_menu(id) {
	var f = document.fpost;

	if(confirm("선택하신 메뉴를 제거 하시겠습니까?")) {
        f.gr_id.value 	= $("#"+id).attr('data-id');
		f.action      = "<?=$g4['admin_path']?>/reno_SetMenu_delete.php";
		f.submit();
	}
}
</script>
<?
include_once("./admin.tail.php");
?>
'