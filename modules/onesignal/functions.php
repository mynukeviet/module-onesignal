<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2019 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 19 Jul 2019 15:09:52 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_ONESIGNAL', true);

$notification_id = '';
$array_config = $module_config[$module_name];

$array_list_apps = nv_onesignalListApps();

$array_segments = array(
    'Subscribed Users' => $lang_module['subscribed_users'],
    'Engaged Users' => $lang_module['engaged_users'],
    'Active Users' => $lang_module['active_users'],
    'Inactive Users' => $lang_module['inactive_users']
);

if ($op == 'main') {
    if (sizeof($array_op) == 1) {
        if (preg_match('/^page\-([0-9]+)$/', $array_op[0], $m)) {
            $page = (int) $m[1];
        } elseif (preg_match('/^([a-z0-9\-]+)$/i', $array_op[0], $m)) {
            $op = 'detail';
            $notification_id = $m[1];
        }
    }
}

function nv_onesignalListApps()
{
    global $array_config, $module_name, $module_data, $nv_Cache;

    $array_data = array();

    $cache_file = $module_data . '_listapps_' . NV_CACHE_PREFIX . '.cache';
    if (($cache = $nv_Cache->getItem($module_name, $cache_file)) != false) {
        $array_data = unserialize($cache);
    }

    if (empty($array_data)) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://onesignal.com/api/v1/apps');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . $array_config['auth_key']
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        if (!empty($result)) {
            foreach ($result as $app) {
                $array_data[$app['id']] = array(
                    'id' => $app['id'],
                    'site_name' => $app['site_name'],
                    'basic_auth_key' => $app['basic_auth_key']
                );
            }
            $nv_Cache->setItem($module_name, $cache_file, serialize($array_data));
        }
    }
    return $array_data;
}

function nv_onesignaSendMessage($row)
{
    global $array_list_apps;

    $heading = array(
        "en" => $row['title']
    );

    $content = array(
        "en" => $row['content']
    );

    $fields = array(
        'app_id' => $row['app_id'],
        'included_segments' => array(
            $row['segments']
        ),
        'headings' => $heading,
        'contents' => $content,
        'url' => $row['url']
    );

    $fields = json_encode($fields);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic ' . $array_list_apps[$row['app_id']]['basic_auth_key']
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

function nv_onesignaListNotifications($app_id, $page, $limit = 10)
{
    global $array_list_apps;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://onesignal.com/api/v1/notifications?app_id=" . $app_id . "&limit=" . $limit . "&offset=" . ($page - 1),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Basic " . $array_list_apps[$app_id]['basic_auth_key']
        )
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

function nv_onesignaViewNotifications($app_id, $notification_id)
{
    global $array_list_apps;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications/" . $notification_id . "?app_id=" . $app_id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic ' . $array_list_apps[$app_id]['basic_auth_key']
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    $return["allresponses"] = $response;
    $return = json_encode($return);
    return json_decode($response, true);
}