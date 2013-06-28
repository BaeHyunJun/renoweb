<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>jQuery UI Sortable - Connect lists</title>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <style>
  #sortable1, #sortable2 { list-style-type: none; margin: 0; padding: 0 0 2.5em; float: left; margin-right: 10px; }
  #sortable1 li, #sortable2 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
  </style>
  <script>
  $(function() {
    $( "#sortable1, #sortable2" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  });
  </script>
</head>
<body>
<?
$sql_common = " from $g4[group_table] ";

$sql_search = " where (1) ";

$sql_search .= " and gr_1 = '메인 메뉴'";

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

$main_menu = sql_query($sql);

$sql = str_replace("메인 메뉴", "유저 메뉴", $sql);

$user_menu = sql_query($sql);

$sql = str_replace("유저 메뉴", "하단 메뉴", $sql);

$footer_menu = sql_query($sql); 
?>
<ul id="sortable1" class="connectedSortable">
<?
for ($i=0; $row=sql_fetch_array($main_menu); $i++)
{
    echo "<li class='ui-state-default'>".get_text($row[gr_subject])."</li>";
}

if ($i == 0)
    echo "<li>설정된 메뉴가 없습니다.</li>"; 
?>
</ul>
</body>
</html>