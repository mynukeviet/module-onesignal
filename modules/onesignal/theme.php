<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2019 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 19 Jul 2019 15:09:52 GMT
 */
if (!defined('NV_IS_MOD_ONESIGNAL')) die('Stop!!!');

/**
 * nv_theme_onesignal_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_onesignal_main($app_id, $array_data, $page)
{
    global $global_config, $module_name, $module_file, $module_data, $lang_module, $module_config, $module_info, $op, $array_list_apps;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('ADDURL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=content');

    if (!empty($array_list_apps)) {
        foreach ($array_list_apps as $apps) {
            $apps['selected'] = $app_id == $apps['id'] ? 'selected="selected"' : '';
            $xtpl->assign('APPS', $apps);
            $xtpl->parse('main.apps');
        }
    }

    if (!empty($array_data['notifications'])) {
        foreach ($array_data['notifications'] as $notifications) {
            $notifications['title'] = $notifications['headings']['en'];
            $notifications['completed_at'] = nv_date('H:i d/m/Y', $notifications['completed_at']);
            $notifications['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $notifications['id'];
            $xtpl->assign('NOTIFICATIONS', $notifications);
            $xtpl->parse('main.notifications');
        }
    }

    if (!empty($page)) {
        $xtpl->assign('PAGE', $page);
        $xtpl->parse('main.page');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_onesignal_detail()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_onesignal_detail($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_onesignal_content()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_onesignal_content($app_id)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_list_apps, $array_segments;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    if (!empty($array_list_apps)) {
        foreach ($array_list_apps as $apps) {
            $apps['selected'] = $app_id == $apps['id'] ? 'selected="selected"' : '';
            $xtpl->assign('APPS', $apps);
            $xtpl->parse('main.apps');
        }
    }

    $i = 0;
    foreach ($array_segments as $index => $title) {
        $xtpl->assign('SEGMENTS', array(
            'index' => $index,
            'title' => $title,
            'checked' => $i == 0 ? 'checked="checked"' : ''
        ));
        $xtpl->parse('main.segments');
        $i++;
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}