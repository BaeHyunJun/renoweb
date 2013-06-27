<?
$sub_menu = "400100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

$g4['title'] = "외부 서비스 연결";
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
				<div class="widget-content">
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon">
								<i class="icon-align-justify"></i>									
							</span>
							<h5>SNS 연결</h5>
						</div>
						<div class="widget-content">
							<div class="row-fluid">
								<div class="span4">
									<img id="facebook_connect" name="facebook" src="<?=$g4['admin_path']?>/img/facebook_on.png">
									<label for="facebook">연결되어 있지 않습니다.</label>
								</div>
								<div class="span4">
									<img id="twitter_connect" name="twitter" src="<?=$g4['admin_path']?>/img/facebook_off.png">
									<label for="twitter">연결되어 있지 않습니다.</label>
								</div>
								<div class="span4">
									<img id="me2day_connect" name="me2day" src="<?=$g4['admin_path']?>/img/facebook_off.png">
									<label for="me2day">연결되어 있지 않습니다.</label>
								</div>
							</div>
						</div>
					</div>
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon">
								<i class="icon-align-justify"></i>									
							</span>
							<h5>블로그 연결</h5>
						</div>
						<div class="widget-content">
							<div class="row-fluid">
								<div class="span4">
									<img id="naverblog_connect" name="naverblog" src="<?=$g4['admin_path']?>/img/facebook_off.png">
									<label for="naverblog">연결되어 있지 않습니다.</label>
								</div>
								<div class="span4">
									<img id="tistory_connect" name="tistory" src="<?=$g4['admin_path']?>/img/facebook_off.png">
									<label for="tistory">연결되어 있지 않습니다.</label>
								</div>
								<div class="span4">
									<img id="daumview_connect" name="daumview" src="<?=$g4['admin_path']?>/img/facebook_off.png">
									<label for="daumview">연결되어 있지 않습니다.</label>
								</div>
							</div>
						</div>
					</div>
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon">
								<i class="icon-align-justify"></i>									
							</span>
							<h5>기타 연결</h5>
						</div>
						<div class="widget-content">
							<div class="row-fluid">
								<div class="span6">
									<img id="youtube_connect" name="youtube" src="<?=$g4['admin_path']?>/img/facebook_off.png">
									<label for="youtube">연결되어 있지 않습니다.</label>
								</div>
								<div class="span6">
									<img id="google_connect" name="google" src="<?=$g4['admin_path']?>/img/facebook_off.png">
									<label for="google">연결되어 있지 않습니다.</label>
								</div>
							</div>
						</div>
					</div>						
				</div>
			</div>
		</div>
	</div>
<?
include_once ("./admin.tail.php");
?>
