<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2019 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 19 Jul 2019 15:09:52 GMT
 */
if (!defined('NV_IS_MOD_ONESIGNAL')) die('Stop!!!');

if (empty($array_config['auth_key'])) {
    $contents = nv_theme_alert($lang_module['error_required_auth_key_title'], $lang_module['error_required_auth_key_content'], 'danger');
    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme($contents);
    include NV_ROOTDIR . '/includes/footer.php';
}

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$array_data = array();

$app_id = 'b13e3623-03ed-48c1-b73b-86771057c3f8';
var_dump(nv_onesignaViewNotifications($app_id, $notification_id));
die();

$contents = nv_theme_onesignal_detail($array_data);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
