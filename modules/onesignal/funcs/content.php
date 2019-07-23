<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2019 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 19 Jul 2019 15:09:52 GMT
 */
if (!defined('NV_IS_MOD_ONESIGNAL')) die('Stop!!!');

if ($nv_Request->isset_request('submit', 'post')) {
    $row['app_id'] = $nv_Request->get_title('app_id', 'post', '');
    $row['content'] = $nv_Request->get_textarea('content', 'post');

    if (empty($row['app_id'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_appid']
        ));
    } elseif (empty($row['content'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_content']
        ));
    }

    if (nv_onesignaSendMessage($row)) {
        $_SESSION[$module_data]['app_id'] = $row['app_id'];
        nv_jsonOutput(array(
            'error' => 0,
            'redirect' => nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true)
        ));
    }
    nv_jsonOutput(array(
        'error' => 1,
        'msg' => $lang_module['error_unknow']
    ));
}

$app_id = $nv_Request->get_string($module_data . '_app_id', 'cookie', reset($array_list_apps)['id']);

$contents = nv_theme_onesignal_content($app_id);

$page_title = $lang_module['send_notification'];
$array_mod_title[] = array(
    'title' => $page_title
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
