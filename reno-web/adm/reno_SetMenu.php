<?
$sub_menu = "100300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$g4[title] = "메뉴 설정";
include_once("./admin.head.php");

$colspan = 8;
?>

<script type="text/javascript">
var list_update_php = "./boardgroup_list_update.php";
</script>

<script>
$(function() {
	$( "#main-sort" ).sortable({
		start: function (event, ui) {
			if( ui.helper !== undefined ) {
				ui.helper.css('position','absolute').css('margin-top', $(window).scrollTop() );
			}
		},
		beforeStop: function (event, ui) {
			if( ui.offset !== undefined )
				ui.helper.css('margin-top', 0);

		    index = $(ui.placeholder).index();
			if(index != $("#"+$(ui.item).attr('id')).attr('data-subj')){
			    param = {cf_2 : index}
			    if(confirm('메뉴 순서를 바꾸시겠습니까?')) {
			    	$.post("<?=$g4['admin_path']?>/reno_SetMenu_update.php", param, function(result){
			    		if(result)
			    		{
				    		alert(result);
				    		reflesh();
			    		}
			    		else
			    		{
			    			alert('error : 메뉴 설정이 취소 되었습니다. 고객센터에 문의해 주세요.');
				    		reflesh();
			    		}
			    	});
			    } else {
		    		reflesh();
			    }
			}
		}
	});
	$( "#main-sort" ).disableSelection();
});

function reflesh() {
	location.href="./reno_SetMenu.php";
}
</script>

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
							<i class="icon-th"></i>
						</span>
						<h5><?=$g4[title]?></h5>
					</div>
					<div class="widget-content">
<div class="widget-box">
	<div class="widget-title">
		<span class="icon">
			<i class="icon-th"></i>
		</span>
		<h5>메인 메뉴 순서</h5>
		<div class="buttons">
			<a title="Icon Title" class="btn btn-mini" href="#" onclick="add_menu_form();"><i class="icon-plus-sign"></i> 메뉴 추가하기</a>
		</div>
	</div>
	<div class="widget-content" >
		<div class="row-fluid">
			<div class="span6">
				<strong>블로그 메뉴</strong>
				<ul id="blog-sort" class="sort">
				<?
				for ($i=0; $row=sql_fetch_array($blogmenu); $i++)
				{
				    echo "<li class='ui-state-default'>".get_text($row[gr_subject])."</li>";
				}
				
				if ($i == 0)
				    echo "<li>설정된 메뉴가 없습니다.</li>"; 
				?>
				</ul>
			</div>
			<div class="span6">
				<strong>홈페이지 메뉴</strong>
				<ul id="main-sort" class="sort">
				<?
				for ($i=0; $row=sql_fetch_array($homepagemenu); $i++)
				{
				    echo "<li id='menu$i' class='ui-state-default' data-subj='$row[gr_2]'>".get_text($row[gr_subject])."</li>";
				}
				
				if ($i == 0)
				    echo "<li>설정된 메뉴가 없습니다.</li>"; 
				?>
				</ul>
			</div>
		</div>
	</div>
</div>			
<div class="widget-box">
	<div class="widget-title">
		<span class="icon">
			<i class="icon-th"></i>
		</span>
		<h5>유저 메뉴 순서</h5>
		<div class="buttons">
			<a title="Icon Title" class="btn btn-mini" href="#"><i class="icon-plus-sign"></i> 메뉴 추가하기</a>
		</div>
	</div>
	<div class="widget-content">
	
<ul id="user-sort" class="sort">
<?
for ($i=0; $row=sql_fetch_array($user); $i++)
{
    echo "<li class='ui-state-default'>".get_text($row[gr_subject])."</li>";
}

if ($i == 0)
    echo "<li>설정된 메뉴가 없습니다.</li>"; 
?>
</ul>
		
	</div>
</div>			
<div class="widget-box">
	<div class="widget-title">
		<span class="icon">
			<i class="icon-th"></i>
		</span>
		<h5>하단 메뉴 순서</h5>
		<div class="buttons">
			<a title="Icon Title" class="btn btn-mini" href="#"><i class="icon-plus-sign"></i> 메뉴 추가하기</a>
		</div>
	</div>
	<div class="widget-content">
	
<ul id="footer-sort" class="sort">
<?
for ($i=0; $row=sql_fetch_array($footer_menu); $i++)
{
    echo "<li>".get_text($row[gr_subject])."</li>";
}

if ($i == 0)
    echo "<li>설정된 메뉴가 없습니다.</li>"; 
?>
</ul>
		
	</div>
</div>			
					</div>
				</div>						
			</div>
		</div>

<div id="layer_pop">
	<div id="add_form">
		<form>		
			<div class="widget-box">
				<div id="top-radius" class="widget-title">
					<span class="icon">
						<i class="icon-th"></i>
					</span>
					<h5>메뉴 추가하기</h5>
					<div class="buttons">
						<a href="#" onclick="close_form();"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="widget-box">
					<div id="add_cont" class="widget-content">
					</div>
				</div>
			</div>
			<div>
				<a class="btn">선택 추가하기</a>
			</div>
		</form>
	</div>
</div>
<script>
function add_menu_form(){
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
function close_form(){
	$('#layer_pop').css('display','none');
}
</script>
<?
include_once("./admin.tail.php");
?>
