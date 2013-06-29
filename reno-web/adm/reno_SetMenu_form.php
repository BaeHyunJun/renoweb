<?
$sub_menu = "100300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($is_admin != "super" && $w == "") alert("최고관리자만 접근 가능합니다.");

$html_title = "메뉴 추가하기";

$m = $_GET[m];

if($m == 'main') {
	$gr_1 = '메인 메뉴';
	$gr_2 = '999';
	$gr_3_1 = 'blog';
	$gr_3_2 = 'homepage';
} else if($m == 'user') {
	$gr_1 = '유저 메뉴';
	$gr_2 = '999';
	$gr_3_1 = 'login';
	$gr_3_2 = 'logout';
} else if($m == 'foot') {
	$gr_1 = '하단 메뉴';
	$gr_2 = '999';
} else {
    alert("제대로 된 값이 넘어오지 않았습니다.");
}

$sql_common = " from $g4[group_table] ";

$sql_search = " where (1) ";

$sql_search .= " and gr_1 = ''";

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

$sql = " select * 
          $sql_common 
          $sql_search
          $sql_order ";

$result = sql_query($sql);

$g4[title] = $html_title;
include_once("./admin.head.php");
?>
<style>
  #sortable1, #sortable2, #sortable3 {width: 100%; min-height: 100px}
  #sortable1 li, #sortable2 li, #sortable3 li { margin: 5px; padding: 5px; font-size: 1.2em; width: 90%; }
  #sortable1 li.selected, #sortable2 li.selected, #sortable3 li.selected {
 	  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#dddddd), color-stop(25%, #e6e6e6), to(#dddddd));
	  background-image: -webkit-linear-gradient(#dddddd, #e6e6e6 25%, #dddddd);
	  background-image: -moz-linear-gradient(top, #dddddd, #e6e6e6 25%, #dddddd);
	  background-image: -ms-linear-gradient(#dddddd, #e6e6e6 25%, #dddddd);
	  background-image: -o-linear-gradient(#dddddd, #e6e6e6 25%, #dddddd);
	  background-image: linear-gradient(#dddddd, #e6e6e6 25%, #dddddd);
	  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#dddddd', endColorstr='#e6e6e6', GradientType=0);
  }
</style>

<div id="breadcrumb">
	<a href="<?=$g4['admin_path']?>/" title="Go to Admin" class="tip-top"><i class="icon-home"></i> Admin</a>
	<a href="<?=$g4['admin_path']?>/" class="current"><?=$g4[title]?></a>
</div>
			<div class="container-fluid">
			
			
<div class="row-fluid">
	<div class="span12">
		<div class="alert">
			<storng>해당 메뉴들은 드래그&드롭으로 메뉴 등록이 가능합니다.</storng>
		</div>
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon">
					<i class="icon-align-justify"></i>									
				</span>
				<h5><?=$g4[title]?></h5>
				<div class="buttons">
					<a title="Icon Title" class="btn btn-mini" href="./reno_SetMenu_form.php?m=user"><i class="icon-ok"></i> 확인</a>
				</div>
			</div>
			<div class="widget-content">
<?
if($m != 'foot'){ 
?>
				<div class="row-fluid">
					<div class="span5">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5><?=$gr_3_1?> Menu</h5>
							</div>
							<div id="blog_M" class="widget-content">
								<ul id="sortable2">
								</ul>
							</div>
						</div>
					</div>
					<div class="span2">
						<div style="border: 1px solid red"></div>
					</div>
					<div class="span5">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5><?=$gr_3_2?> Menu</h5>
							</div>
							<div id="homepage_M" class="widget-content">
								<ul id="sortable3">
								</ul>
							</div>
						</div>
					</div>
				</div>	
<?
} else {
?>
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-align-justify"></i>									
						</span>
						<h5>footer Menu</h5>
					</div>
					<div id="homepage_M" class="widget-content">
						<ul id="sortable2">
						</ul>
					</div>
				</div>
<?
}
?>
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-align-justify"></i>									
						</span>
						<h5>Menu</h5>
					</div>
					<div id="homepage_M" class="widget-content">		
						<ul id="sortable1">
						<?
						for ($i=0; $row=sql_fetch_array($result); $i++) {
						?>
							  <li class="ui-state-default">
							  	<i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
							  	<?=get_text($row[gr_subject])?>
							  </li>
							  
						<? 
						}
						?>
						</ul>
					</div>
				</div>
			</div>
		</div>						
	</div>
</div>
<script>
  $(function() {
    $( "ul" ).on('click', 'li', function (e) {
        if (e.ctrlKey || e.metaKey) {
            $(this).toggleClass("selected");
        } else {
            $(this).addClass("selected").siblings().removeClass('selected');
        }
    }).sortable({
        connectWith: "ul",
        delay: 150, //Needed to prevent accidental drag when trying to select
        revert: 0,
        helper: function (e, item) {
            var helper = $('<li/>');
            if (!item.hasClass('selected')) {
                item.addClass('selected').siblings().removeClass('selected');
            }
            var elements = item.parent().children('.selected').clone();
            item.data('multidrag', elements).siblings('.selected').remove();
            return helper.append(elements);
        },
		start: function (event, ui) {
			if( ui.helper !== undefined ) {
				ui.helper.css('position','absolute').css('margin-top', $(window).scrollTop() );
			}
		},
        stop: function (e, info) {
            info.item.after(info.item.data('multidrag')).remove();
        },
		beforeStop: function (event, ui) {
			if( ui.offset !== undefined )
				ui.helper.css('margin-top', 0);
		},
		placeholder: "ui-state-highlight"
    });
    
  });
</script>
<?
include_once ("./admin.tail.php");
?>
