<?php
include $_SERVER["DOCUMENT_ROOT"] . '/wp-content/plugins/offer_builder/admin/partials/include/class/config.php';
function getPageData($page)
{
    global $staging, $redis;
    return $redis->hgetall($staging->vertical . 'pages:' . wp_get_theme() . '_' . $page);
}