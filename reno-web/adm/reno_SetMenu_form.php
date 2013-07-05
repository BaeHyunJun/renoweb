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
	$gr_3_2 = 'footer';
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
	<a href="<?=$g4['admin_path']?>/reno_SetMenu.php" class="current">메뉴 설정</a>
	<a href="#" class="current"><?=$g4[title]?></a>
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
					<button class="cfBtn btn btn-mini"><i class="icon-ok"></i> 확인</button>
				</div>
			</div>
			<div class="widget-content">
				<div class="row-fluid">
	<?
	if(($m != 'main' || $config[cf_8] == 1) && $m != 'foot') {
	?>
					<div class="span5">
						<div class="widget-box" style="margin: 0;">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5><?=$gr_3_1?> Menu</h5>
							</div>
							<div id="menu1" class="widget-content">
								<ul id="sortable2">
									<?
									for ($i=0; $row=sql_fetch_array(($m == 'main' ? $blog_M : $login_M)); $i++)
									{
										echo "<li class='ui-state-default' style='padding:8px' data-id='$row[gr_id]'>";
										echo get_text($row[gr_subject]);
										echo "<i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
												<div class='pull-right' style='margin-top:-4px'>
														<button class='btn upBtn' value='up' >Up</button>
														<button class='btn downBtn' value='down' >Down</button>
												</div>
											</li>";
									}
									?>
								</ul>
							</div>
						</div>
						<!-- 
						<div style="margin-top: 15px; text-align:center">
							<button class="btn">등록</button>
							<button class="btn">제거</button>
						</div>
						 -->
					</div>
					<div class="span2">
							<!-- 						
							<div style="margin: 0 auto; text-align: center; border: 1px solid red">
	 							<button><<이동</button>
	 						</div> 
	 						-->
					</div>
					<div class="span5">
	<?
	} else {
	?>
					<div class="span12">
	<?
	}
	?>
						<div class="widget-box" style="margin: 0;">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5><?=$gr_3_2?> Menu</h5>
							</div>
							<div id="menu2" class="widget-content">
								<ul id="sortable3">
									<?
									for ($i=0; $row=sql_fetch_array(($m != 'foot' ? ($m == 'main' ? $homepage_M : $logout_M) : $footer_M)); $i++)
									{
										echo "<li class='ui-state-default' style='padding:8px' data-id='$row[gr_id]'>";
										echo get_text($row[gr_subject]);
										echo "<i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
												<div class='pull-right' style='margin-top:-4px'>
														<button class='btn upBtn' value='up' >Up</button>
														<button class='btn downBtn' value='down' >Down</button>
												</div>
											</li>";
									}
									?>
								</ul>
							</div>
						</div>
						<!-- 
						<div style="margin-top: 15px; text-align:center">
							<button class="btn">등록</button>
							<button class="btn">제거</button>
						</div>
						 -->
					</div>
				</div>	
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-align-justify"></i>									
						</span>
						<h5>Menu</h5>
					</div>
					<div id="basic_M" class="widget-content">		
						<ul id="sortable1">
						<?
						for ($i=0; $row=sql_fetch_array($result); $i++) {
						?>
							  <li class="ui-state-default" style='padding: 8px' data-id='<?=$row[gr_id]?>'>
							  	<i class='icon-align-justify pull-left' style='margin-top: 4px;margin-right: 10px'></i>
							  	<?=get_text($row[gr_subject])?>
								<div class="pull-right" style='margin-top:-4px'>
										<button class='btn upBtn' value='up' >Up</button>
										<button class='btn downBtn' value='down' >Down</button>
								</div>
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
<form name="fpost" method=post class="fpost">
<input type='hidden' name='m'	  value='<?=$m?>'>
<input type='hidden' name='m1'	  value='<?=$gr_3_1?>'>
<input type='hidden' name='m2'	  value='<?=$gr_3_2?>'>
<input type='hidden' name='sst'   value='<?=$sst?>'>
<input type='hidden' name='sod'   value='<?=$sod?>'>
<input type='hidden' name='sfl'   value='<?=$sfl?>'>
<input type='hidden' name='stx'   value='<?=$stx?>'>
<input type='hidden' name='page'  value='<?=$page?>'>
<input type='hidden' name='token' value='<?=$token?>'>
</form>
<script>
  $(function() {
    $( "ul#sortable1, ul#sortable2, ul#sortable3" ).on('click', 'li', function (e) {
        if($(this).hasClass("selected")){
        	$(this).removeClass("selected");
        } else {
	        if (e.ctrlKey || e.metaKey) {
	            $(this).toggleClass("selected");
	        } else {
	            $(this).addClass("selected").siblings().removeClass('selected');
	        }
        }
    }).sortable({
    	items: ".ui-state-default", 
    	distance: 10,
        connectWith: "ul",
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
				ui.helper.css('position','absolute').css('margin-top', $(window).scrollTop());
			}
		},
		beforeStop: function (event, ui) {
			if(ui.offset !== undefined)
				ui.helper.css('margin-top', 0);

			ui.item.removeClass('selected');
		},
		placeholder: "ui-state-highlight"
    });
  });
  function moveUp(item) {
	    var prev = item.prev();
	    if (prev.length == 0)
	        return;
	    prev.css('z-index', 999).css('position','relative').animate({ top: item.height() }, 250);
	    item.css('z-index', 1000).css('position', 'relative').animate({ top: '-' + prev.height() }, 300, function () {
	        prev.css('z-index', '').css('top', '').css('position', '');
	        item.css('z-index', '').css('top', '').css('position', '');
	        item.insertBefore(prev);
	    });
	}
	function moveDown(item) {
	    var next = item.next();
	    if (next.length == 0)
	        return;
	    next.css('z-index', 999).css('position', 'relative').animate({ top: '-' + item.height() }, 250);
	    item.css('z-index', 1000).css('position', 'relative').animate({ top: next.height() }, 300, function () {
	        next.css('z-index', '').css('top', '').css('position', '');
	        item.css('z-index', '').css('top', '').css('position', '');
	        item.insertAfter(next);
	    });
	}
	$('.upBtn, .downBtn').on('click', function() {
	    var btn = $(this);
	    var val = btn.val();
	    if (val == 'up')
	        moveUp(btn.parents('.ui-state-default'));
	    else
	        moveDown(btn.parents('.ui-state-default'));
	});

	$('.cfBtn').on('click', function() {
		var f 	   	= document.fpost,
			str		= '',
			first  	= $("#sortable2"),
			second 	= $("#sortable3"),
			name 	= 'list1[]',
			current = null;
		
		if(confirm("선택하신 메뉴를 추가 하시겠습니까?")) {
			
			for(var i = 0, max = first.children().length; i < max ; i += 1) {
				str = getListTag(name, first.children().eq(i).attr('data-id'));
				$('.fpost').append(str);
			}
			
			name = 'list2[]';
			
			for(var i = 0, max = second.children().length; i < max ; i += 1) {
				str = getListTag(name, second.children().eq(i).attr('data-id'));
				$('.fpost').append(str);
			}
			
			f.action      = "<?=$g4['admin_path']?>/reno_SetMenu_form_update.php";
			f.submit();
		}
	});

	function getListTag(name, value) {
		//alert('a');
		return "<input type='hidden' name='"+name+"' value='"+value+"'>";
	}
</script>
<?
include_once ("./admin.tail.php");
?>
