<?php
$id=$_REQUEST['q'];
include "connection.php";
$categories=$db->selectCollection('categories');
echo $id."<br>";

$delete=$categories->deleteOne(['_id'=> new MongoDB\BSON\ObjectId($id)]);
echo $delete->getDeletedCount();

header("Location:view_categories.php");