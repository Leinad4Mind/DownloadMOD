<?php
/**
*
* @author oxpus (Karsten Ude) webmaster@oxpus.net
* @package download mod installation package based on umil (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'DOWNLOAD_MOD';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'dl_mod_version';

/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
* $mod_name
* 'INSTALL_' . $mod_name
* 'INSTALL_' . $mod_name . '_CONFIRM'
* 'UPDATE_' . $mod_name
* 'UPDATE_' . $mod_name . '_CONFIRM'
* 'UNINSTALL_' . $mod_name
* 'UNINSTALL_' . $mod_name . '_CONFIRM'
*/
$language_file = 'mods/dl_install';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	'6.3.4' => array(
		'table_add' => array(
			array('phpbb_downloads', array(
				'COLUMNS'		=> array(
					'id'					=> array('UINT:11', NULL, 'auto_increment'),
					'description'			=> array('MTEXT_UNI', ''),
					'file_name'				=> array('VCHAR', ''),
					'klicks'				=> array('INT:11', 0),
					'free'					=> array('BOOL', 0),
					'extern'				=> array('BOOL', 0),
					'long_desc'				=> array('MTEXT_UNI', ''),
					'sort'					=> array('INT:11', 0),
					'cat'					=> array('INT:11', 0),
					'hacklist'				=> array('BOOL', 0),
					'hack_author'			=> array('VCHAR', ''),
					'hack_author_email'		=> array('VCHAR', ''),
					'hack_author_website'	=> array('TEXT_UNI', ''),
					'hack_version'			=> array('VCHAR:32', ''),
					'hack_dl_url'			=> array('TEXT_UNI', ''),
					'test'					=> array('VCHAR:50', ''),
					'req'					=> array('MTEXT_UNI', ''),
					'todo'					=> array('MTEXT_UNI', ''),
					'warning'				=> array('MTEXT_UNI', ''),
					'mod_desc'				=> array('MTEXT_UNI', ''),
					'mod_list'				=> array('BOOL', 0),
					'file_size'				=> array('BINT', 0),
					'change_time'			=> array('TIMESTAMP', 0),
					'rating'				=> array('INT:5', 0),
					'file_traffic'			=> array('BINT', 0),
					'overall_klicks'		=> array('INT:11', 0),
					'approve'				=> array('BOOL', 0),
					'add_time'				=> array('TIMESTAMP', 0),
					'add_user'				=> array('UINT', 0),
					'change_user'			=> array('UINT', 0),
					'last_time'				=> array('TIMESTAMP', 0),
					'down_user'				=> array('UINT', 0),
					'thumbnail'				=> array('VCHAR', ''),
					'broken'				=> array('BOOL', 0),
					'mod_desc_uid'			=> array('CHAR:8', ''),
					'mod_desc_bitfield'		=> array('VCHAR', ''),
					'mod_desc_flags'		=> array('UINT:11', 0),
					'long_desc_uid'			=> array('CHAR:8', ''),
					'long_desc_bitfield'	=> array('VCHAR', ''),
					'long_desc_flags'		=> array('UINT:11', 0),
					'desc_uid'				=> array('CHAR:8', ''),
					'desc_bitfield'			=> array('VCHAR', ''),
					'desc_flags'			=> array('UINT:11', 0),
					'warn_uid'				=> array('CHAR:8', ''),
					'warn_bitfield'			=> array('VCHAR', ''),
					'warn_flags'			=> array('UINT:11', 0),
					'dl_topic'				=> array('UINT:11', 0),
					'real_file'				=> array('VCHAR', ''),
				),
				'PRIMARY_KEY'	=> 'id'
				),
			),

			array('phpbb_downloads_cat', array(
				'COLUMNS'		=> array(
					'id'				=> array('UINT:11', NULL, 'auto_increment'),
					'parent'			=> array('INT:11', 0),
					'path'				=> array('VCHAR', ''),
					'cat_name'			=> array('VCHAR', ''),
					'sort'				=> array('INT:11', 0),
					'description'		=> array('MTEXT_UNI', ''),
					'rules'				=> array('MTEXT_UNI', ''),
					'auth_view'			=> array('BOOL', 1),
					'auth_dl'			=> array('BOOL', 1),
					'auth_up'			=> array('BOOL', 0),
					'auth_mod'			=> array('BOOL', 0),
					'must_approve'		=> array('BOOL', 0),
					'allow_mod_desc'	=> array('BOOL', 0),
					'statistics'		=> array('BOOL', 1),
					'stats_prune'		=> array('UINT', 0),
					'comments'			=> array('BOOL', 1),
					'cat_traffic'		=> array('BINT', 0),
					'allow_thumbs'		=> array('BOOL', 0),
					'auth_cread'		=> array('BOOL', 0),
					'auth_cpost'		=> array('BOOL', 1),
					'approve_comments'	=> array('BOOL', 1),
					'bug_tracker'		=> array('BOOL', 0),
					'desc_uid'			=> array('CHAR:8', ''),
					'desc_bitfield'		=> array('VCHAR', ''),
					'desc_flags'		=> array('UINT:11', 0),
					'rules_uid'			=> array('CHAR:8', ''),
					'rules_bitfield'	=> array('VCHAR', ''),
					'rules_flags'		=> array('UINT:11', 0),
					'dl_topic_forum'	=> array('INT:11', 0),
					'dl_topic_text'		=> array('MTEXT_UNI', ''),
					'cat_icon'			=> array('VCHAR', ''),
				),
				'PRIMARY_KEY'	=> 'id'
				),
			),

			array('phpbb_dl_auth', array(
				'COLUMNS'		=> array(
					'cat_id'	=> array('INT:11', 0),
					'group_id'	=> array('INT:11', 0),
					'auth_view'	=> array('BOOL', 1),
					'auth_dl'	=> array('BOOL', 1),
					'auth_up'	=> array('BOOL', 1),
					'auth_mod'	=> array('BOOL', 0),
					),
				),
			),

			array('phpbb_dl_banlist', array(
				'COLUMNS'		=> array(
					'ban_id'		=> array('UINT:11', NULL, 'auto_increment'),
					'user_id'		=> array('UINT', 0),
					'user_ip'		=> array('VCHAR:40', ''),
					'user_agent'	=> array('VCHAR:50', ''),
					'username'		=> array('VCHAR:25', ''),
					'guests'		=> array('BOOL', 0),
				),
				'PRIMARY_KEY'	=> 'ban_id'
				),
			),

			array('phpbb_dl_bug_history', array(
				'COLUMNS'		=> array(
					'report_his_id'		=> array('UINT:11', NULL, 'auto_increment'),
					'df_id'				=> array('INT:11', 0),
					'report_id'			=> array('INT:11', 0),
					'report_his_type'	=> array('CHAR:10', ''),
					'report_his_date'	=> array('TIMESTAMP', 0),
					'report_his_value'	=> array('VCHAR', ''),
				),
				'PRIMARY_KEY'	=> 'report_his_id'
				)
			),

			array('phpbb_dl_bug_tracker', array(
				'COLUMNS'		=> array(
					'report_id'				=> array('UINT:11', NULL, 'auto_increment'),
					'df_id'					=> array('INT:11', 0),
					'report_title'			=> array('VCHAR', ''),
					'report_text'			=> array('MTEXT_UNI', ''),
					'report_file_ver'		=> array('VCHAR:50', ''),
					'report_date'			=> array('TIMESTAMP', 0),
					'report_author_id'		=> array('UINT', 0),
					'report_assign_id'		=> array('UINT', 0),
					'report_assign_date'	=> array('TIMESTAMP', 0),
					'report_status'			=> array('BOOL', 0),
					'report_status_date'	=> array('TIMESTAMP', 0),
					'report_php'			=> array('VCHAR:50', ''),
					'report_db'				=> array('VCHAR:50', ''),
					'report_forum'			=> array('VCHAR:50', ''),
					'bug_uid'				=> array('CHAR:8', ''),
					'bug_bitfield'			=> array('VCHAR', ''),
					'bug_flags'				=> array('UINT:11', 0),
				),
				'PRIMARY_KEY'	=> 'report_id'
				),
			),

			array('phpbb_dl_cat_traf', array(
				'COLUMNS'		=> array(
					'cat_id'			=> array('UINT:11', 0),
					'cat_traffic_use'	=> array('BINT', 0),
				),
				'PRIMARY_KEY'	=> 'cat_id'
				),
			),

			array('phpbb_dl_comments', array(
				'COLUMNS'		=> array(
					'dl_id'				=> array('BINT', NULL, 'auto_increment'),
					'id'				=> array('INT:11', 0),
					'cat_id'			=> array('INT:11', 0),
					'user_id'			=> array('UINT', 0),
					'username'			=> array('VCHAR:32', ''),
					'comment_time'		=> array('TIMESTAMP', 0),
					'comment_edit_time'	=> array('TIMESTAMP', 0),
					'comment_text'		=> array('MTEXT_UNI', ''),
					'approve'			=> array('BOOL', 0),
					'com_uid'			=> array('CHAR:8', ''),
					'com_bitfield'		=> array('VCHAR', ''),
					'com_flags'			=> array('UINT:11', 0),
				),
				'PRIMARY_KEY'	=> 'dl_id'
				),
			),

			array('phpbb_dl_ext_blacklist', array(
				'COLUMNS'		=> array(
					'extention'	=> array('CHAR:10', ''),
					),
				),
			),

			array('phpbb_dl_favorites', array(
				'COLUMNS'		=> array(
					'fav_id'		=> array('UINT:11', NULL, 'auto_increment'),
					'fav_dl_id'		=> array('INT:11', 0),
					'fav_dl_cat'	=> array('INT:11', 0),
					'fav_user_id'	=> array('UINT', 0),
				),
				'PRIMARY_KEY'	=> 'fav_id'
				),
			),

			array('phpbb_dl_hotlink', array(
				'COLUMNS'		=> array(
					'user_id'		=> array('UINT', 0),
					'session_id'	=> array('VCHAR:32', ''),
					'hotlink_id'	=> array('VCHAR:32', ''),
					'code'			=> array('VCHAR:10', '-'),
					),
				),
			),

			array('phpbb_dl_notraf', array(
				'COLUMNS'		=> array(
					'user_id'	=> array('UINT', 0),
					'dl_id'		=> array('INT:11', 0),
					),
				),
			),

			array('phpbb_dl_ratings', array(
				'COLUMNS'		=> array(
					'dl_id'			=> array('INT:11', 0),
					'user_id'		=> array('UINT', 0),
					'rate_point'	=> array('CHAR:10', ''),
					),
				),
			),

			array('phpbb_dl_rem_traf', array(
				'COLUMNS'		=> array(
					'config_name'	=> array('VCHAR', ''),
					'config_value'	=> array('VCHAR', ''),
				),
				'PRIMARY_KEY'	=> 'config_name'
				),
			),

			array('phpbb_dl_stats', array(
				'COLUMNS'		=> array(
					'dl_id'			=> array('BINT', NULL, 'auto_increment'),
					'id'			=> array('INT:11', 0),
					'cat_id'		=> array('INT:11', 0),
					'user_id'		=> array('UINT', 0),
					'username'		=> array('VCHAR:32', ''),
					'traffic'		=> array('BINT', 0),
					'direction'		=> array('BOOL', 0),
					'user_ip'		=> array('VCHAR:40', ''),
					'browser'		=> array('VCHAR:20', ''),
					'time_stamp'	=> array('INT:11', 0),
				),
				'PRIMARY_KEY'	=> 'dl_id'
				),
			),
		),

		'table_row_insert' => array(
			array('phpbb_dl_banlist', array(
				array('user_agent'	=> 'n/a'),
			)),

			array('phpbb_dl_ext_blacklist', array(
				array('extention'	=> 'asp'),
				array('extention'	=> 'cgi'),
				array('extention'	=> 'dhtm'),
				array('extention'	=> 'dhtml'),
				array('extention'	=> 'exe'),
				array('extention'	=> 'htm'),
				array('extention'	=> 'html'),
				array('extention'	=> 'jar'),
				array('extention'	=> 'js'),
				array('extention'	=> 'php'),
				array('extention'	=> 'php3'),
				array('extention'	=> 'pl'),
				array('extention'	=> 'sh'),
				array('extention'	=> 'shtm'),
				array('extention'	=> 'shtml'),
			)),

			array('phpbb_dl_rem_traf', array(
				array('config_name' => 'dl_remain_guest_traffic', 'config_value' => '0'),
				array('config_name' => 'dl_remain_traffic', 'config_value' => '0'),
			)),

			array('phpbb_config', array(
				array('config_name' => 'dl_cap_back_color', 'config_value' => '969696'),
				array('config_name' => 'dl_cap_carree_color', 'config_value' 	=> 'FFFFFF'),
				array('config_name' => 'dl_cap_carree_x', 'config_value' => '20'),
				array('config_name' => 'dl_cap_carree_y', 'config_value' => '20'),
				array('config_name' => 'dl_cap_char_trans', 'config_value' => '0'),
				array('config_name' => 'dl_cap_chess', 'config_value' => '1'),
				array('config_name' => 'dl_cap_contrast', 'config_value' => '0.8'),
				array('config_name' => 'dl_cap_jpeg_qual', 'config_value' => '75'),
				array('config_name' => 'dl_cap_lines', 'config_value' => '1'),
				array('config_name' => 'dl_cap_type', 'config_value' => 'j'),
				array('config_name' => 'dl_click_reset_time', 'config_value' => '0'),
				array('config_name' => 'dl_delay_auto_traffic', 'config_value' => '30'),
				array('config_name' => 'dl_delay_post_traffic', 'config_value' => '30'),
				array('config_name' => 'dl_disable_email', 'config_value' => '1'),
				array('config_name' => 'dl_disable_popup', 'config_value' => '0'),
				array('config_name' => 'dl_disable_popup_notify', 'config_value' => '0'),
				array('config_name' => 'dl_download_dir', 'config_value' => 'dl_mod/downloads/'),
				array('config_name' => 'dl_download_vc', 'config_value' => '1'),
				array('config_name' => 'dl_drop_traffic_postdel', 'config_value' => '0'),
				array('config_name' => 'dl_edit_own_downloads', 'config_value' => '1'),
				array('config_name' => 'dl_edit_time', 'config_value' => '3'),
				array('config_name' => 'dl_enable_dl_topic', 'config_value' => '0'),
				array('config_name' => 'dl_enable_post_dl_traffic', 'config_value' => '1'),
				array('config_name' => 'dl_ext_new_window', 'config_value' => '0'),
				array('config_name' => 'dl_guest_stats_show', 'config_value' => '1'),
				array('config_name' => 'dl_hotlink_action', 'config_value' => '1'),
				array('config_name' => 'dl_icon_free_for_reg', 'config_value' => '0'),
				array('config_name' => 'dl_latest_comments', 'config_value' => '1'),
				array('config_name' => 'dl_limit_desc_on_index', 'config_value' => '0'),
				array('config_name' => 'dl_links_per_page', 'config_value' => '10'),
				array('config_name' => 'dl_method', 'config_value' => '2'),
				array('config_name' => 'dl_method_quota', 'config_value' => '2097152'),
				array('config_name' => 'dl_new_time', 'config_value' => '3'),
				array('config_name' => 'dl_newtopic_traffic', 'config_value' => '524288'),
				array('config_name' => 'dl_overall_guest_traffic', 'config_value' => '0'),
				array('config_name' => 'dl_overall_traffic', 'config_value' => '104857600'),
				array('config_name' => 'dl_physical_quota', 'config_value' => '524288000'),
				array('config_name' => 'dl_posts', 'config_value' => '25'),
				array('config_name' => 'dl_prevent_hotlink', 'config_value' => '1'),
				array('config_name' => 'dl_recent_downloads', 'config_value' => '10'),
				array('config_name' => 'dl_reply_traffic', 'config_value' => '262144'),
				array('config_name' => 'dl_report_broken', 'config_value' => '1'),
				array('config_name' => 'dl_report_broken_lock', 'config_value' => '1'),
				array('config_name' => 'dl_report_broken_message', 'config_value' => '1'),
				array('config_name' => 'dl_report_broken_vc', 'config_value' => '1'),
				array('config_name' => 'dl_shorten_extern_links', 'config_value' => '10'),
				array('config_name' => 'dl_show_footer_legend', 'config_value' => '1'),
				array('config_name' => 'dl_show_footer_stat', 'config_value' => '1'),
				array('config_name' => 'dl_show_real_filetime', 'config_value' => '1'),
				array('config_name' => 'dl_sort_preform', 'config_value' => '0'),
				array('config_name' => 'dl_stats_perm', 'config_value' => '0'),
				array('config_name' => 'dl_stop_uploads', 'config_value' => '0'),
				array('config_name' => 'dl_thumb_fsize', 'config_value' => '0'),
				array('config_name' => 'dl_thumb_xsize', 'config_value' => '200'),
				array('config_name' => 'dl_thumb_ysize', 'config_value' => '150'),
				array('config_name' => 'dl_topic_forum', 'config_value' => ''),
				array('config_name' => 'dl_topic_text', 'config_value' => ''),
				array('config_name' => 'dl_traffic_retime', 'config_value' => '0'),
				array('config_name' => 'dl_upload_traffic_count', 'config_value' => '1'),
				array('config_name' => 'dl_use_ext_blacklist', 'config_value' => '1'),
				array('config_name' => 'dl_use_hacklist', 'config_value' => '1'),
				array('config_name' => 'dl_user_dl_auto_traffic', 'config_value' => '0'),
				array('config_name' => 'dl_user_traffic_once', 'config_value' => '0'),
			)),
		),

		'table_column_add' => array(
			array('phpbb_groups', 'group_dl_auto_traffic', array('BINT', 0)),
			array('phpbb_users', 'user_allow_fav_download_email', array('BOOL', 1)),
			array('phpbb_users', 'user_allow_fav_download_popup', array('BOOL', 1)),
			array('phpbb_users', 'user_allow_new_download_email', array('BOOL', 0)),
			array('phpbb_users', 'user_allow_new_download_popup', array('BOOL', 1)),
			array('phpbb_users', 'user_dl_note_type', array('BOOL', 1)),
			array('phpbb_users', 'user_dl_sort_dir', array('BOOL', 0)),
			array('phpbb_users', 'user_dl_sort_fix', array('BOOL', 0)),
			array('phpbb_users', 'user_dl_sort_opt', array('BOOL', 0)),
			array('phpbb_users', 'user_dl_sub_on_index', array('BOOL', 1)),
			array('phpbb_users', 'user_dl_update_time', array('TIMESTAMP', 0)),
			array('phpbb_users', 'user_new_download', array('BOOL', 0)),
			array('phpbb_users', 'user_traffic', array('BINT', 0)),
		),

		'module_add' => array(
			array('acp', 'ACP_CAT_DOT_MODS', 'DOWNLOADS'),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'ACP_USER_OVERVIEW',
				'module_mode' => 'overview',
				'module_auth' => 'acl_a_dl_overview')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_ACP_CONFIG_MANAGEMENT',
				'module_mode' => 'config',
				'module_auth' => 'acl_a_dl_config')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_ACP_TRAFFIC_MANAGEMENT',
				'module_mode' => 'traffic',
				'module_auth' => 'acl_a_dl_traffic')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname'=> 'DL_ACP_CATEGORIES_MANAGEMENT',
				'module_mode' => 'categories',
				'module_auth' => 'acl_a_dl_categories')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_ACP_FILES_MANAGEMENT',
				'module_mode' => 'files',
				'module_auth' => 'acl_a_dl_files')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_ACP_PERMISSIONS',
				'module_mode' => 'permissions',
				'module_auth' => 'acl_a_dl_permissions')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_ACP_STATS_MANAGEMENT',
				'module_mode' => 'stats',
				'module_auth' => 'acl_a_dl_stats')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_ACP_BANLIST',
				'module_mode' => 'banlist',
				'module_auth' => 'acl_a_dl_banlist')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_EXT_BLACKLIST',
				'module_mode' => 'ext_blacklist',
				'module_auth' => 'acl_a_dl_blacklist')
			),

			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_MANAGE',
				'module_mode' => 'toolbox',
				'module_auth' => 'acl_a_dl_toolbox')
			),

			array('ucp', false, 'DOWNLOADS'),

			array('ucp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_CONFIG',
				'module_mode' => 'config')
			),

			array('ucp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_FAVORITE',
				'module_mode' => 'favorite')
			),
		),

		'permission_add' => array(
			array('a_dl_overview', true),
			array('a_dl_config', true),
			array('a_dl_traffic', true),
			array('a_dl_categories', true),
			array('a_dl_files', true),
			array('a_dl_permissions', true),
			array('a_dl_stats', true),
			array('a_dl_banlist', true),
			array('a_dl_blacklist', true),
			array('a_dl_toolbox', true),
		),

		'permission_set' => array(
			array('ADMINISTRATORS', 'a_dl_overview', 'group'),
			array('ADMINISTRATORS', 'a_dl_config', 'group'),
			array('ADMINISTRATORS', 'a_dl_traffic', 'group'),
			array('ADMINISTRATORS', 'a_dl_categories', 'group'),
			array('ADMINISTRATORS', 'a_dl_files', 'group'),
			array('ADMINISTRATORS', 'a_dl_permissions', 'group'),
			array('ADMINISTRATORS', 'a_dl_stats', 'group'),
			array('ADMINISTRATORS', 'a_dl_banlist', 'group'),
			array('ADMINISTRATORS', 'a_dl_blacklist', 'group'),
			array('ADMINISTRATORS', 'a_dl_toolbox', 'group'),
		),
	),


	'6.3.5' => array(),
	'6.3.6' => array(),

	'6.3.7' => array(
		'table_add' => array(
			array('phpbb_dl_versions', array(
				'COLUMNS'		=> array(
					'ver_id'			=> array('UINT:11', NULL, 'auto_increment'),
					'dl_id'				=> array('UINT:11', 0),
					'ver_file_name'		=> array('VCHAR', ''),
					'ver_real_file'		=> array('VCHAR', ''),
					'ver_file_size'		=> array('BINT', 0),
					'ver_version'		=> array('VCHAR:32', ''),
					'ver_change_time'	=> array('TIMESTAMP', 0),
					'ver_add_time'		=> array('TIMESTAMP', 0),
					'ver_add_user'		=> array('UINT', 0),
					'ver_change_user'	=> array('UINT', 0),
				),
				'PRIMARY_KEY'	=> 'ver_id'
				),
			),
		),

		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_antispam_posts', 'config_value' => '50'),
				array('config_name' => 'dl_antispam_hours', 'config_value' => '24'),
			)),
		),
	),

	'6.3.8' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_traffic_off', 'config_value' => '0'),
			)),
		),
	),

	'6.4.0' => array(
		'table_column_add'	=> array(
			array('phpbb_downloads', 'todo_uid', array('CHAR:8', '')),
			array('phpbb_downloads', 'todo_bitfield', array('VCHAR', '')),
			array('phpbb_downloads', 'todo_flags', array('UINT:11', 0)),
			array('phpbb_downloads_cat', 'diff_topic_user', array('BOOL', 0)),
			array('phpbb_downloads_cat', 'topic_user', array('UINT:11', 0)),
		),

		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_diff_topic_user', 'config_value' => '0'),
				array('config_name' => 'dl_topic_user', 'config_value' => '0'),
			)),
		),

		'table_add' => array(
			array('phpbb_dl_fields', array(
				'COLUMNS'		=> array(
					'field_id'				=> array('UINT:8', NULL, 'auto_increment'),
					'field_name'			=> array('MTEXT_UNI', ''),
					'field_type'			=> array('INT:4', 0),
					'field_ident'			=> array('VCHAR:20', ''),
					'field_length'			=> array('VCHAR:20', ''),
					'field_minlen'			=> array('VCHAR', ''),
					'field_maxlen'			=> array('VCHAR', ''),
					'field_novalue'			=> array('MTEXT_UNI', ''),
					'field_default_value'	=> array('MTEXT_UNI', ''),
					'field_validation'		=> array('VCHAR:60', ''),
					'field_required'		=> array('BOOL', 0),
					'field_active'			=> array('BOOL', 0),
					'field_order'			=> array('UINT:8', 0),
				),
				'PRIMARY_KEY'	=> 'field_id'
				),
			),

			array('phpbb_dl_fields_data', array(
				'COLUMNS'		=> array(
					'df_id'			=> array('UINT:11', 0),
				),
				'PRIMARY_KEY'	=> 'df_id'
				),
			),

			array('phpbb_dl_fields_lang', array(
				'COLUMNS'		=> array(
					'field_id'		=> array('UINT:8', 0),
					'lang_id'		=> array('UINT:8', 0),
					'option_id'		=> array('UINT:8', 0),
					'field_type'	=> array('INT:4', 0),
					'lang_value'	=> array('MTEXT_UNI', ''),
				),
				'PRIMARY_KEY'	=> array('field_id', 'lang_id', 'option_id'),
				),
			),

			array('phpbb_dl_lang', array(
				'COLUMNS'		=> array(
					'field_id'				=> array('UINT:8', 0),
					'lang_id'				=> array('UINT:8', 0),
					'lang_name'				=> array('MTEXT_UNI', ''),
					'lang_explain'			=> array('MTEXT_UNI', ''),
					'lang_default_value'	=> array('MTEXT_UNI', ''),
				),
				'PRIMARY_KEY'	=> array('field_id', 'lang_id'),
				),
			),
		),

		'module_add' => array(
			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_ACP_FIELDS',
				'module_mode' => 'fields',
				'module_auth' => 'acl_a_dl_fields')
			),
		),

		'permission_add' => array(
			array('a_dl_fields', true),
		),

		'permission_set' => array(
			array('ADMINISTRATORS', 'a_dl_fields', 'group'),
		),
	),

	'6.4.1' => array(
		'table_column_add'	=> array(
			array('phpbb_downloads_cat', 'topic_more_details', array('BOOL', 1)),
		),

		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_todo_link_onoff', 'config_value' => '1'),
				array('config_name' => 'dl_uconf_link_onoff', 'config_value' => '1'),
				array('config_name' => 'dl_topic_more_details', 'config_value' => '1'),
			)),
		),
	),

	'6.4.2' => array(),
	'6.4.3' => array(),
	'6.4.4' => array(),
	'6.4.5' => array(),

	'6.4.6' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_active', 'config_value' => '1'),
				array('config_name' => 'dl_off_hide', 'config_value' => '1'),
				array('config_name' => 'dl_off_now_time', 'config_value' => '0'),
				array('config_name' => 'dl_off_from', 'config_value' => '00:00'),
				array('config_name' => 'dl_off_till', 'config_value' => '23:59'),
				array('config_name' => 'dl_on_admins', 'config_value' => '1'),
			)),
		),
	),

	'6.4.7' => array(),

	'6.4.8' => array(
		'module_add' => array(
			array('acp', 'DOWNLOADS', array(
				'module_basename' => 'downloads',
				'module_langname' => 'DL_ACP_BROWSER',
				'module_mode' => 'browser',
				'module_auth' => 'acl_a_dl_browser')
			),
		),

		'permission_add' => array(
			array('a_dl_browser', true),
		),

		'permission_set' => array(
			array('ADMINISTRATORS', 'a_dl_browser', 'group'),
		),
	),

	'6.4.9' => array(),

	'6.4.10' => array(
		'table_add' => array(
			array('phpbb_dl_images', array(
				'COLUMNS'		=> array(
					'img_id'				=> array('UINT:8', NULL, 'auto_increment'),
					'dl_id'					=> array('UINT:11', 0),
					'img_name'				=> array('VCHAR:255', ''),
					'img_title'				=> array('MTEXT_UNI', ''),
				),
				'PRIMARY_KEY'	=> 'img_id'
				),
			),
		),
	),

	'6.4.11' => array(),
	'6.4.11.1' => array(),
	'6.4.12' => array(),

	'6.4.13' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_enable_rate', 'config_value' => '1'),
				array('config_name' => 'dl_rate_points', 'config_value' => '5'),
				array('config_name' => 'dl_enable_jumpbox', 'config_value' => '1'),
			)),
		),
	),

	'6.4.14' => array(
		'table_column_update' => array(
			array('phpbb_dl_stats', 'browser', array('VCHAR:255', '')),
		),

		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_rss_enable', 'config_value' => '0'),
				array('config_name' => 'dl_rss_off_action', 'config_value' => '0'),
				array('config_name' => 'dl_rss_off_text', 'config_value' => 'Dieser Feed ist aktuell offline. / This feed is currently offline.'),
				array('config_name' => 'dl_rss_cats', 'config_value' => '0'),
				array('config_name' => 'dl_rss_cats_select', 'config_value' => '-'),
				array('config_name' => 'dl_rss_perms', 'config_value' => '1'),
				array('config_name' => 'dl_rss_number', 'config_value' => '10'),
				array('config_name' => 'dl_rss_select', 'config_value' => '0'),
				array('config_name' => 'dl_rss_desc_length', 'config_value' => '0'),
			)),
		),
	),

	'6.4.14.1' => array(),

	'6.4.15' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_rss_desc_shorten', 'config_value' => '150'),
				array('config_name' => 'dl_rss_new_update', 'config_value' => '0'),
			)),
		),
	),

	'6.4.16' => array(),

	'6.4.17' => array(
		'table_column_update' => array(
			array('phpbb_dl_bug_history', 'report_his_value', array('MTEXT_UNI', '')),
		),
	),

	'6.4.18' => array(),
	'6.4.18.1' => array(),
	'6.4.19' => array(),
	'6.4.20' => array(),
	'6.4.21' => array(),
	'6.4.22' => array(),
	'6.5.0' => array(
		'table_column_add'	=> array(
			array('phpbb_users', 'user_allow_fav_comment_email', array('BOOL', 1)),
		),

		'custom'	=> 'undynamic_config',
	),

	'6.5.1' => array(),
	'6.5.2' => array(),
	'6.5.3' => array(),
	'6.5.4' => array(),
	'6.5.5' => array(),

	'6.5.6' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_traffics_overall', 'config_value' => '1'),
				array('config_name' => 'dl_traffics_users', 'config_value' => '1'),
				array('config_name' => 'dl_traffics_guests', 'config_value' => '1'),
				array('config_name' => 'dl_traffics_founder', 'config_value' => '1'),
				array('config_name' => 'dl_traffics_overall_groups', 'config_value' => ''),
				array('config_name' => 'dl_traffics_users_groups', 'config_value' => ''),
			)),
		),
		'custom'	=> 'undynamic_config',
	),

	'6.5.7' => array(),
	'6.5.8' => array(),

	'6.5.9' => array(),

	'6.5.10' => array(
		'custom'	=> 'reset_vc_values',
	),

	'6.5.11' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_cat_edit', 'config_value' => '1', 'is_dynamic' => '0'),
				array('config_name' => 'dl_overview_link_onoff', 'config_value' => '1', 'is_dynamic' => '0'),
			)),
		),

		'custom'	=> 'remove_old_cap_values',
	),

	'6.5.12' => array(
		'table_column_add'	=> array(
			array('phpbb_dl_versions', 'ver_file_hash', array('VCHAR:255', '')),
			array('phpbb_downloads', 'file_hash', array('VCHAR:255', '')),
			array('phpbb_downloads_cat', 'show_file_hash', array('BOOL', 1)),
		),

		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_file_hash_algo', 'config_value' => 'md5', 'is_dynamic' => '0'),
			)),
		),
	),

	'6.5.13' => array(),
	'6.5.14' => array(),
	'6.5.15' => array(),
	'6.5.16' => array(),

	'6.5.17' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_similar_dl', 'config_value' => '1'),
				array('config_name' => 'dl_similar_limit', 'config_value' => '10'),
			)),
		),

		'custom'	=> 'add_fulltext_index',
	),

	'6.5.18' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_todo_onoff', 'config_value' => '1'),
			)),
		),
	),

	'6.5.19' => array(),
	'6.5.20' => array(),
	'6.5.21' => array(),
	'6.5.22' => array(),
	'6.5.23' => array(),
	'6.5.24' => array(),
	'6.5.25' => array(),
	'6.5.26' => array(),
	'6.5.27' => array(),
	'6.5.28' => array(),

	'6.5.29' => array(
		'table_row_insert' => array(
			array('phpbb_config', array(
				array('config_name' => 'dl_topic_title_catname', 'config_value' => '0'),
				array('config_name' => 'dl_topic_post_catname', 'config_value' => '0'),
			)),
		),
	),

	'6.5.30' => array(),
	'6.5.31' => array(),

	'6.5.32' => array(
		'cache_purge' => array(
			'imageset',
			'template',
			'theme',
			'auth'
		),
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

function undynamic_config()
{
	global $db, $table_prefix, $user, $cache;

	$sql = 'UPDATE ' . $table_prefix . "config SET is_dynamic = 0 WHERE config_name LIKE 'dl_%'";
	$db->sql_query($sql);

	$cache->destroy('config');

	return $user->lang['DL_CHANGE_CONFIG'];
}

function reset_vc_values()
{
	global $db, $table_prefix, $user, $cache, $config;

	if ($config['dl_download_vc'])
	{
		$sql = 'UPDATE ' . $table_prefix . "config SET config_value = '5' WHERE config_name = 'dl_download_vc'";
		$db->sql_query($sql);
	}

	if ($config['dl_report_broken_vc'])
	{
		$sql = 'UPDATE ' . $table_prefix . "config SET config_value = '5' WHERE config_name = 'dl_report_broken_vc'";
		$db->sql_query($sql);
	}

	$cache->destroy('config');

	return $user->lang['DL_RESET_VC_VALUES'];
}

function remove_old_cap_values()
{
	global $db, $table_prefix, $user, $cache;

	$sql = 'DELETE FROM ' . $table_prefix . "config WHERE config_name LIKE 'dl_cap_%'";
	$db->sql_query($sql);

	$cache->destroy('config');

	return $user->lang['DL_CHANGE_CONFIG'];
}

function add_fulltext_index()
{
	global $db, $table_prefix, $user, $cache, $dbms;

	switch ($dbms)
	{
		case 'firebird':
		case 'postgres':
		case 'oracle':
		case 'sqlite':
			$statement = 'CREATE FULLTEXT INDEX desc_search ON ' . $table_prefix . 'downloads(desc_search)';
		break;

		case 'mysql':
		case 'mysqli':
			$sql = 'ALTER TABLE ' . $table_prefix . 'downloads ENGINE = MyISAM';
			$db->sql_query($sql);

			$sql = 'ALTER TABLE ' . $table_prefix . 'downloads CHANGE COLUMN description description MEDIUMTEXT NOT NULL';
			$db->sql_query($sql);

			$statement = 'ALTER TABLE ' . $table_prefix . 'downloads ADD FULLTEXT INDEX desc_search(description)';
		break;

		case 'mssql':
		case 'mssql_odbc':
		case 'mssqlnative':
			$statement = 'CREATE FULLTEXT INDEX desc_search ON ' . $table_prefix . 'downloads(description) ON [PRIMARY]';
		break;
	}

	$db->sql_query($statement);

	return sprintf($user->lang['TABLE_KEY_ADD'], 'desc_search', $table_prefix . 'downloads');
}

?>