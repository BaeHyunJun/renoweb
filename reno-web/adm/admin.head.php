<?
if (!defined("_GNUBOARD_")) exit;

$begin_time = get_microtime();

include_once("$g4[path]/head.sub.php");

function print_menu($key)
{
    global $menu;
    
    $i = 0;
    $str = "<ul>";

//    for($i=0; $i<count($menu[$key]); $i++)
//    {
//    	if($menu[$key][1][1]){
    		foreach ($menu[$key] as $value)
    		{
    			if($i == 0 || $menu[$key][$i][1] == ''){
    			}else{
    				$str .= '<li>
    							<a href="'.$menu[$key][$i][2].'">
    								'.$menu[$key][$i][1].'
    							</a>
    						</li>';
    			}
    			$i++;
    		}
//    	}
//    }
    $str .= "</ul>";
    
    return $str;
}

function print_menu1($key, $no)
{
    global $menu;

    $str = "<table width=130 cellpadding=1 cellspacing=0 id='menu_{$key}' style='position:absolute; display:none; z-index:1;' onpropertychange=\"selectBoxHidden('menu_{$key}')\"><colgroup><colgroup><colgroup width=10><tr><td rowspan=2 colspan=2 bgcolor=#EFCA95><table width=127 cellpadding=0 cellspacing=0 bgcolor=#FEF8F0><colgroup style='padding-left:10px'>";
    $str .= print_menu2($key, $no);
    $str .= "</table></td><td></td></tr><tr><td bgcolor=#DDDAD5 height=40></td></tr><tr><td width=4></td><td height=3 width=127 bgcolor=#DDDAD5></td><td bgcolor=#DDDAD5></td></tr></table>\n";

    return $str;
}

function print_menu2($key, $no)
{
    global $menu, $auth_menu, $is_admin, $auth, $g4;

    $str = "";
    for($i=1; $i<count($menu[$key]); $i++)
    {
        if ($is_admin != "super" && (!array_key_exists($menu[$key][$i][0],$auth) || !strstr($auth[$menu[$key][$i][0]], "r")))
            continue;

        if ($menu[$key][$i][0] == "-")
            $str .= "<tr><td class=bg_line{$no}></td></tr>";
        else
        {
            $span1 = $span2 = "";
            if (isset($menu[$key][$i][3]))
            {
                $span1 = "<span style='{$menu[$key][$i][3]}'>";
                $span2 = "</span>";
            }
            $str .= "<tr><td class=bg_menu{$no}>";
            if ($no == 2)
                $str .= "&nbsp;&nbsp;<img src='{$g4[admin_path]}/img/icon.gif' align=absmiddle> ";
            $str .= "<a href='{$menu[$key][$i][2]}' style='color:#555500;'>{$span1}{$menu[$key][$i][1]}{$span2}</a></td></tr>";

            $auth_menu[$menu[$key][$i][0]] = $menu[$key][$i][1];
        }
    }

    return $str;
}
?>

<script type="text/javascript">
if (!g4_is_ie) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;
var prevdiv = null;
var timerID = null;

function getMouseXY(e) 
{
    if (g4_is_ie) { // grab the x-y pos.s if browser is IE
        tempX = event.clientX + document.body.scrollLeft;
        tempY = event.clientY + document.body.scrollTop;
    } else {  // grab the x-y pos.s if browser is NS
        tempX = e.pageX;
        tempY = e.pageY;
    }  

    if (tempX < 0) {tempX = 0;}
    if (tempY < 0) {tempY = 0;}  

    return true;
}

function imageview(id, w, h)
{

    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - ( w + 11 );
    submenu.top  = tempY - ( h / 2 );

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}

function help(id, left, top)
{
    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - 50 + left;
    submenu.top  = tempY + 15 + top;

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}

// TEXTAREA 사이즈 변경
function textarea_size(fld, size)
{
	var rows = parseInt(fld.rows);

	rows += parseInt(size);
	if (rows > 0) {
		fld.rows = rows;
	}
}
</script>

<script type="text/javascript" src="<?=$g4['path']?>/js/sideview.js"></script>
<script type="text/javascript">
var save_layer = null;
function layer_view(link_id, menu_id, opt, x, y)
{
    var link = document.getElementById(link_id);
    var menu = document.getElementById(menu_id);

    //for (i in link) { document.write(i + '<br/>'); } return;

    if (save_layer != null)
    {
        save_layer.style.display = "none";
        selectBoxVisible();
    }

    if (link_id == '')
        return;

    if (opt == 'hide')
    {
        menu.style.display = 'none';
        selectBoxVisible();
    }
    else
    {
        x = parseInt(x);
        y = parseInt(y);
        menu.style.left = get_left_pos(link) + x + 'px';
        menu.style.top  = get_top_pos(link) + link.offsetHeight + y + 'px';
        menu.style.display = 'block';
    }

    save_layer = menu;
}
</script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="<?=$g4['path']?>/css/EricMeyer-reset.css" />
<link rel="stylesheet" href="<?=$g4['admin_path']?>/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?=$g4['admin_path']?>/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?=$g4['admin_path']?>/css/uniform.css" />
<link rel="stylesheet" href="<?=$g4['admin_path']?>/css/select2.css" />		
<link rel="stylesheet" href="<?=$g4['admin_path']?>/css/unicorn.main.css" />
<link rel="stylesheet" href="<?=$g4['admin_path']?>/css/unicorn.blue.css" class="skin-color" />

<body leftmargin=0 topmargin=0>
<a name='gnuboard4_admin_head'></a>
		
		<div id="header">
			<h1><a href="<?=$g4['admin_path']?>/">Unicorn Admin</a></h1>		
		</div>
		
		<div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
                <li class="btn btn-inverse" >
	                <a title="HOME" href="<?=$g4['path']?>/">
		                <i class="icon icon-home"></i> 
		                <span class="text">HOME</span>
	                </a>
                </li>
                <li class="btn btn-inverse">
                	<a title="Admin" href="<?=$g4['admin_path']?>/">
                		<i class="icon icon-cog"></i> 
                		<span class="text">Admin</span>
                	</a>
                </li>
                <li class="btn btn-inverse">
                	<a title="Logout" href="<?=$g4['bbs_path']?>/logout.php">
                		<i class="icon icon-share-alt"></i> 
                		<span class="text">Logout</span>
                	</a>
                </li>
            </ul>
        </div>
            
		<div id="sidebar">
			<ul>
				<li id="admin_main" class="submenu">
					<a href="<?=$g4['admin_path']?>/">
						<i class="icon icon-book"></i> 
						<span>관리자 메인</span>
					</a>
				</li>
        <?
        foreach($amenu as $key=>$value)
        {
            $href1 = "<a href='#'>";
            $href2 = "</a>";            
					
            if ($menu["menu{$key}"][0][2])
            {
                $href1 = "<a href='".$menu["menu{$key}"][0][2]."'>";
            }
            
            if ($menu["menu{$key}"][0][3]){
            	echo "<li id='".$menu["menu{$key}"][0][3]."' class='submenu'>";
            } else {
				echo "<li class='submenu'>";
			}
            echo "
					{$href1}
						<i class='".$menu["menu{$key}"][0][4]."'></i> 
						<span>".$menu["menu{$key}"][0][1]."</span>
					{$href2}
				";
            echo print_menu("menu{$key}");
            echo "
				</li>
				";
        }
        ?>
			</ul>
		</div>
		
		<div id="content">
			<div id="content-header">
				<h1>관리자 페이지</h1>
			</div>