<?
$sub_menu = "700100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "w");

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

if ($member[mb_password] != sql_password($_POST['admin_password'])) {
    alert("패스워드가 다릅니다.");
}

$mb = get_member($cf_admin);
if (!$mb[mb_id])
    alert("최고관리자 회원아이디가 존재하지 않습니다.");

check_token();

$sql = " update $g4[config_table]
            set cf_title                = '$_POST[cf_title]',
                cf_admin                = '$_POST[cf_admin]',
                cf_use_point            = '$_POST[cf_use_point]',
                cf_use_norobot          = '$_POST[cf_use_norobot]',
                cf_use_copy_log         = '$_POST[cf_use_copy_log]',
                cf_use_email_certify    = '$_POST[cf_use_email_certify]',
                cf_login_point          = '$_POST[cf_login_point]',
                cf_cut_name             = '$_POST[cf_cut_name]',
                cf_nick_modify          = '$_POST[cf_nick_modify]',
                cf_new_skin             = '$_POST[cf_new_skin]',
                cf_new_rows             = '$_POST[cf_new_rows]',
                cf_search_skin          = '$_POST[cf_search_skin]',
                cf_connect_skin         = '$_POST[cf_connect_skin]',
                cf_read_point           = '$_POST[cf_read_point]',
                cf_write_point          = '$_POST[cf_write_point]',
                cf_comment_point        = '$_POST[cf_comment_point]',
                cf_download_point       = '$_POST[cf_download_point]',
                cf_search_bgcolor       = '$_POST[cf_search_bgcolor]',
                cf_search_color         = '$_POST[cf_search_color]',
                cf_write_pages          = '$_POST[cf_write_pages]',
                cf_link_target          = '$_POST[cf_link_target]',
                cf_delay_sec            = '$_POST[cf_delay_sec]',
                cf_filter               = '$_POST[cf_filter]',
                cf_possible_ip          = '".trim($_POST['cf_possible_ip'])."',
                cf_intercept_ip         = '".trim($_POST['cf_intercept_ip'])."',
                cf_member_skin          = '$_POST[cf_member_skin]',
                cf_use_homepage         = '$_POST[cf_use_homepage]',
                cf_req_homepage         = '$_POST[cf_req_homepage]',
                cf_use_tel              = '$_POST[cf_use_tel]',
                cf_req_tel              = '$_POST[cf_req_tel]',
                cf_use_hp               = '$_POST[cf_use_hp]',
                cf_req_hp               = '$_POST[cf_req_hp]',
                cf_use_addr             = '$_POST[cf_use_addr]',
                cf_req_addr             = '$_POST[cf_req_addr]',
                cf_use_signature        = '$_POST[cf_use_signature]',
                cf_req_signature        = '$_POST[cf_req_signature]',
                cf_use_profile          = '$_POST[cf_use_profile]',
                cf_req_profile          = '$_POST[cf_req_profile]',
                cf_register_level       = '$_POST[cf_register_level]',
                cf_register_point       = '$_POST[cf_register_point]',
                cf_icon_level           = '$_POST[cf_icon_level]',
                cf_use_recommend        = '$_POST[cf_use_recommend]',
                cf_recommend_point      = '$_POST[cf_recommend_point]',
                cf_leave_day            = '$_POST[cf_leave_day]',
                cf_search_part          = '$_POST[cf_search_part]',
                cf_email_use            = '$_POST[cf_email_use]',
                cf_email_wr_super_admin = '$_POST[cf_email_wr_super_admin]',
                cf_email_wr_group_admin = '$_POST[cf_email_wr_group_admin]',
                cf_email_wr_board_admin = '$_POST[cf_email_wr_board_admin]',
                cf_email_wr_write       = '$_POST[cf_email_wr_write]',
                cf_email_wr_comment_all = '$_POST[cf_email_wr_comment_all]',
                cf_email_mb_super_admin = '$_POST[cf_email_mb_super_admin]',
                cf_email_mb_member      = '$_POST[cf_email_mb_member]',
                cf_email_po_super_admin = '$_POST[cf_email_po_super_admin]',
                cf_prohibit_id          = '$_POST[cf_prohibit_id]',
                cf_prohibit_email       = '$_POST[cf_prohibit_email]',
                cf_new_del              = '$_POST[cf_new_del]',
                cf_memo_del             = '$_POST[cf_memo_del]',
                cf_visit_del            = '$_POST[cf_visit_del]',
                cf_popular_del          = '$_POST[cf_popular_del]',
                cf_use_jumin            = '$_POST[cf_use_jumin]',
                cf_use_member_icon      = '$_POST[cf_use_member_icon]',
                cf_member_icon_size     = '$_POST[cf_member_icon_size]',
                cf_member_icon_width    = '$_POST[cf_member_icon_width]',
                cf_member_icon_height   = '$_POST[cf_member_icon_height]',
                cf_login_minutes        = '$_POST[cf_login_minutes]',
                cf_image_extension      = '$_POST[cf_image_extension]',
                cf_flash_extension      = '$_POST[cf_flash_extension]',
                cf_movie_extension      = '$_POST[cf_movie_extension]',
                cf_formmail_is_member   = '$_POST[cf_formmail_is_member]',
                cf_page_rows            = '$_POST[cf_page_rows]',
                cf_stipulation          = '$_POST[cf_stipulation]',
                cf_privacy              = '$_POST[cf_privacy]',
                cf_open_modify          = '$_POST[cf_open_modify]',
                cf_memo_send_point      = '$_POST[cf_memo_send_point]',
                cf_1_subj               = '$_POST[cf_1_subj]',
                cf_2_subj               = '$_POST[cf_2_subj]',
                cf_3_subj               = '$_POST[cf_3_subj]',
                cf_4_subj               = '$_POST[cf_4_subj]',
                cf_5_subj               = '$_POST[cf_5_subj]',
                cf_6_subj               = '$_POST[cf_6_subj]',
                cf_7_subj               = '$_POST[cf_7_subj]',
                cf_8_subj               = '$_POST[cf_8_subj]',
                cf_9_subj               = '$_POST[cf_9_subj]',
                cf_10_subj              = '$_POST[cf_10_subj]',
                cf_1                    = '$_POST[cf_1]',
                cf_2                    = '$_POST[cf_2]',
                cf_3                    = '$_POST[cf_3]',
                cf_4                    = '$_POST[cf_4]',
                cf_5                    = '$_POST[cf_5]',
                cf_6                    = '$_POST[cf_6]',
                cf_7                    = '$_POST[cf_7]',
                cf_8                    = '$_POST[cf_8]',
                cf_9                    = '$_POST[cf_9]',
                cf_10                   = '$_POST[cf_10]' ";

// 로고 삭제
if ($del_cf_logo){
	@unlink($logo_path);
}
// 로고 업로드
if (is_uploaded_file($_FILES[cf_logo][tmp_name])) {
	if (!preg_match("/(\.png)$/i", $_FILES[cf_logo][name])) {
		alert($_FILES[cf_logo][name] . '은(는) png 파일이 아닙니다. 로고는 png파일로 등록해 주세요.');
	}

	if (preg_match("/(\.png)$/i", $_FILES[cf_logo][name])) {
		@mkdir("$g4[path]/data/logo", 0707);
		@chmod("$g4[path]/data/logo", 0707);

		move_uploaded_file($_FILES[cf_logo][tmp_name], $logo_path);
		chmod($logo_path, 0606);

		if (file_exists($logo_path)) {
			$size = getimagesize($logo_path);
			// 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
			if ($size[0] > $config[cf_2] || $size[1] > $config[cf_3]) {
				@unlink($dest_path);
			}
		}
	}
}

sql_query($sql);

//sql_query(" OPTIMIZE TABLE `$g4[config_table]` ");

goto_url("./config_form.php", false);
?>