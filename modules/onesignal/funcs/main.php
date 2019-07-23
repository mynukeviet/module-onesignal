<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2019 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 19 Jul 2019 15:09:52 GMT
 */
if (!defined('NV_IS_MOD_ONESIGNAL')) die('Stop!!!');

if ($nv_Request->isset_request('change_app_id', 'post')) {
    $new_app_id = $nv_Request->get_string('new_app_id', 'post', '');
    if (!empty($new_app_id)) {
        $nv_Request->set_Cookie($module_data . '_app_id', $new_app_id);
        nv_jsonOutput(array(
            'error' => 0
        ));
    }
    nv_jsonOutput(array(
        'error' => 1
    ));
}

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name;
$page = $nv_Request->get_int('page', 'get', 1);
$app_id = $nv_Request->get_string($module_data . '_app_id', 'cookie', '');

$array_data = nv_onesignaListNotifications($app_id, $page);

$generate_page = nv_generate_page($base_url, $array_data['total_count'], $array_data['limit'], $page);

$contents = nv_theme_onesignal_main($app_id, $array_data, $generate_page);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
