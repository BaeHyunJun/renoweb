<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$g4[title] = "메인 페이지 레이아웃 설정";
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
				<div class="widget-content">
					<div class="row-fluid nopadding" style="margin:0">
						<div class="span12">
							<div class="widget-box">
								<div class="widget-title">
									<span class="icon">
										<i class="icon-th"></i>
									</span>
									<h5>스킨 설정</h5>
								</div>
								<div class="widget-content">
									<table>
										<tr>
							        <?
							        $arr = get_skin_dir("main");
							        for ($i=0; $i<count($arr); $i++) {
										$path = "{$g4['path']}/skin/main/$arr[$i]";
							            echo "
											<td>
												<table>
													<tr><td>
														<input type='hidden' name='path$i' value='$path'>
														<img src='$path/main.jpg' width='200' height='200'>
													</td></tr>
													<tr><td align='center'>
														<input type='radio' name='cf_4' value='$arr[$i]' onclick='select_skin($i);'>
													</td></tr>
								            	</table>
											</td>";
							        }
							
									if ($i == 0)
									    echo "<tr><td colspan='6' align=center height=100 bgcolor=#ffffff>스킨이 없습니다.</td></tr>"; 
									
									?>
										</tr>
									</table>
								</div>
							</div>						
						</div>
					</div>
					<form name='flayoutform' method='post' action='./reno_Design_Main_update.php' enctype="multipart/form-data" autocomplete="off" class="form-horizontal" style="margin:0">
					<div class="row-fluid nopadding" style="margin:0">
						<div class="span12">
							<div class="widget-box">
								<div class="widget-title">
									<span class="icon">
										<i class="icon-th"></i>
									</span>
									<h5>레이아웃 설정</h5>
								</div>
								<div class="widget-content">
									<div id="preview">
										
									</div>
								</div>
							</div>						
						</div>
					</div>
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
<script>
function select_skin(num){
	skin_dir = document.getElementsByName('path'+num)[0].value;

	var param 	= {skin_dir:skin_dir};
	$.post("<?=$g4['admin_path']?>/ajax.select_skin.php", param, function(result){
		if(result)
		{
			alert('선택하신 스킨으로 설정되었습니다.');
			document.getElementById('preview').innerHTML = '<iframe src="'+result+'"></iframe>';
		}
		else
		{
			alert('error : 선택하신 스킨으로 설정되지 않았습니다. 고객센터에 문의해 주세요.');
		}			
	}); 
}
</script>
<?
include_once("./admin.tail.php");
?>
