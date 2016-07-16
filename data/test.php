<?php
require_once "../data/mysql.class.php";
$config = array(
    'host' => "localhost",
    'port' => "3306",
    'user' => "root",
    'passwd' => "1023747194",
    'charset' => "utf8",
    'dbname' => "shop"
);
$db = mysql::getInstance($config);
// $passwd = md5("Djoy");
// $sql = "insert coolshop_admin(username,password,email) values('Djoy','{$passwd}','1023747194@qq.com')";
// $db->exec($sql);
$sql = "select *from coolshop_admin;";
$result = $db->getRows($sql);
var_dump($result);
echo $result;
?>