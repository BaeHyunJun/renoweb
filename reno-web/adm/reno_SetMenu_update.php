<?
include_once("./_common.php");

$sql = " update $g4[config_table] set cf_2 = '$_POST[cf_2]' ";

sql_query($sql);
?>