<?php
// load wp core to use authentication
require $_SERVER['DOCUMENT_ROOT'].'/wp-load.php';
// if not logged in - stop
if (!is_user_logged_in()) {
    echo "not logged in";
    die();
}
// if more or less than 3 parameters are passed - stop
if (count($_GET) != 3) {
    die();
}
include $_SERVER["DOCUMENT_ROOT"] . '/wp-content/plugins/offer_builder/admin/partials/include/class/config.php';

  $ns = $staging->vertical;
  $n = $_GET['n'];
  $f = $_GET['f'];

// get post object if it available
// removes second comma after domain set in config.php if it is a post request
if (isset($_POST['v'])) {
    $v = $_POST['v'];
    $pos = strpos($ns, ':');
    if ($pos !== false) {
        $ns = substr_replace($ns, '', $pos, strlen($ns));
    }
    $ns = $ns . ':' . $_GET['ns'];
} else {
    $ns = $ns . $_GET['ns'];
}
  $redis = new Redis();
  $redis2 = new Redis();
// change dev.staging to staging when using on production
if (strpos($_SERVER['SERVER_NAME'], 'dev.staging') !== false) {
    // staging connection
    $redis->connect($staging->host, $staging->port);
    $redis->select($staging->db);
    // prod connection
    $redis2->connect($prod->host, $prod->port);
    $redis2->select($prod->db);
} else {
    // staging connection
    $redis2->connect($staging->host, $staging->port);
    $redis2->select($staging->db);
    // prod connection
    $redis->connect($prod->host, $prod->port);
    $redis->select($prod->db);
}


if ($f == 'set') {
    $redis->hset($ns, $n, $v);
    $redis->hset($ns, $n . '_time', Date('c'));
    $data = $redis->hget($ns, $n);
    echo $data;
} elseif ($f == 'getall') {
    $dataContainer = new stdClass();
    $dataContainer->stage = $redis->hgetall($ns);
    $dataContainer->prod = $redis2->hgetall($ns);
    $data = json_encode($dataContainer);
    echo $data;
} elseif ($f == 'get') {
    $data = $redis->hget($ns, $n);
    echo $data;
} elseif ($f == 'export') {
    processHash($ns, $redis, $redis2);
} elseif ($f == 'import') {
    processHash($ns, $redis2, $redis);
}

function processHash($key, $redisStage, $redisProd)
{
    $del = true;
    if ($redisStage->HGETALL($key) == $redisProd->HGETALL($key)) {
    } else {
        $hash = $redisStage->hGetAll($key);
    // check to see if key exists in production
        if ($redisProd->exists($key)) {
              // write back up here
              $del = true;
        }
        if ($del) {
            foreach ($hash as $k => $value) {
                  echo $value;
                  $redisProd->hSet($key, $k, $value);
            }
        }
    }
}
