<?php 
  $ns = $_GET['ns'];
  $v = $_GET['v'];
  $n = $_GET['n'];
  $f = $_GET['f'];

  // echo "Message recieved";

  global $redis;
  $redis = new Redis();
  $redis->connect('localhost', 6379);
  $redis->select(0);
  echo $redis.get('test');
?>