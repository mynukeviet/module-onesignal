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

if ($nv_Request->isset_request('submit', 'post')) {
    $row['app_id'] = $nv_Request->get_title('app_id', 'post', '');
    $row['title'] = $nv_Request->get_textarea('title', 'post');
    $row['content'] = $nv_Request->get_textarea('content', 'post');
    $row['image'] = $nv_Request->get_string('image', 'post');
    $row['url'] = $nv_Request->get_string('url', 'post');
    $row['segments'] = $nv_Request->get_title('segments', 'post');

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
    } elseif (empty($row['segments'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_segments']
        ));
    }

    if (nv_onesignaSendMessage($row)) {
        $nv_Request->set_Cookie($module_data . '_app_id', $row['app_id']);
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
