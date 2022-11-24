<?php
try{
  $dev='mysql:host=localhost;port=3306;dbname=event_app;charset=utf8';
  $dsn = $dev;
  $username = 'simrs';
  $password = '2x2=4`';
  $db = new PDO($dsn, $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
}catch(PDOException $ex){
  echo $ex->getMessage();
}
?>