<?php
require "vendor/autoload.php";
//$username="myUserAdmin";
$username = "";
$password = "";
//$password="abc123";
$client = new MongoDB\client('mongodb://' . $username . ':' . $password . '@localhost:27017');
$client = new MongoDB\client('mongodb://' . $username . ':' . $password . '@localhost:27017');
$db = $client->selectDatabase('admin');
if ($client->selectDatabase('admin')) {

} else {
    echo 'Database not Connected';
}
?>