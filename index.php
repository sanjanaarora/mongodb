<html>
<head>
    <title>Mongo DB</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<?php
include 'header.php';
?>
<?php
if (isset($_REQUEST['q']))
{
    $categoryid=$_REQUEST['q'];
    include "connection.php";
    $categories=$db->selectCollection('categories');
    $result=$categories->findOne(['_id'=> new MongoDB\BSON\ObjectId($categoryid)],array("_id"=>1));
  //  print_r($result);

}
?>
<div class="container">
<h1 class="text-center"><?php if(isset($_REQUEST['q'])) {  echo 'Edit';  } else {   echo 'Add'; } ?> Category </h1>
<form class="form-horizontal" action="category-action.php" method="post">
    <input type="hidden" name="category_id" value="<?php if(isset($_REQUEST['q'])) {  echo $categoryid; } ?>">
    <div class="form-group">
        <label class="control-label col-sm-2" for="category">Category Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="category" name="category" value="<?php if(isset($_REQUEST['q'])) {  echo $result['category'];  } ?>" placeholder="Enter Category">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="description">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Description"><?php if(isset($_REQUEST['q'])) {  echo $result['description'];  } ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary"><?php if(isset($_REQUEST['q'])) {  echo 'Update';  } else {   echo 'Add'; } ?></button>
        </div>
    </div>
    <div class="text-center">
        <?php
        if(isset($_REQUEST['er']))
        {
            $val=$_REQUEST['er'];
            if($val==1)
            {
                echo '<span class="alert alert-success">Category Inserted Successfully</span>';
            }
            elseif ($val==3)
            {
                echo '<span class="alert alert-danger">Category Name already Exist</span>';
            }
                       else
            {
                echo '<span class="alert alert-danger">Please try again later</span>';
            }
        }
        ?>
    </div>
</form>
</div>
</body>
</html>
