<?php 
  $ns = $_GET['ns'];
  $v = $_GET['v'];
  $n = $_GET['n'];
  $f = $_GET['f'];

  global $redis;
  $redis = new Redis();
  $redis->connect('sqlstage01', 6379);
  $redis->select(13);


  if($f == 'set'){
    $redis->hset($ns, $n, $v);
    $data = $redis->hget($ns, $n);
    echo $data;
  }
  
?>