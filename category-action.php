<?php
include 'connection.php';
$category = $_REQUEST['category'];
$description = $_REQUEST['description'];
$categories = $db->selectCollection('categories');
$ar = array('category' => $category, 'description' => $description);

if (isset($_REQUEST['category_id'])) {
    $category_id = $_REQUEST['category_id'];
    //$cat_name = array(array('category' => $category), array('_id' => array('$ne' => new \MongoDB\BSON\ObjectID($category_id))));
    $cat_name = array('_id' => array('$ne'=>new \MongoDB\BSON\ObjectID($category_id)),'category'=>$category);
    //print_r($cat_name);
    $category_name = $categories->findOne($cat_name, array("_id" => 1));
    //print_r($category_name);
    if($category_name=='')
    {
        if ($categories->updateOne(array('_id'=> new MongoDB\BSON\ObjectId($category_id)),array('$set'=>$ar))) {
            echo 'Has been Inserted Successfully';
            header("Location:view_categories.php");
        } else {
            echo 'Unable to Insert';
            header("Location:index.php?er=2&q=".$category_id);
        }
    }
    else
    {
        header("Location:index.php?er=3&q=".$category_id);
    }
} else {
    $cat_name = array('category' => $category);
    $category_name = $categories->findOne($cat_name, array("_id" => 1));
    if ($category_name == '') {
        if ($categories->insertOne($ar)) {
            echo 'Has been Inserted Successfully';
            header("Location:index.php?er=1");
        } else {
            echo 'Unable to Insert';
            header("Location:index.php?er=2");
        }
    } else {
        // print_r($category_name);
        header("Location:index.php?er=3");
    }
}

