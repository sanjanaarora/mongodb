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
include "connection.php";
$categories = $db->selectCollection('categories');
$result = $categories->find();
//print_r($result);
if (isset($_REQUEST['q'])) {
    $categoryid = $_REQUEST['q'];
    $categories = $db->selectCollection('categories');
    $result = $categories->findOne(['_id' => new MongoDB\BSON\ObjectId($categoryid)], array("_id" => 1));

}
?>
<div class="container">
    <h1 class="text-center"><?php if (isset($_REQUEST['q'])) {
            echo 'Edit';
        } else {
            echo 'Add';
        } ?> Products </h1>
    <form class="form-horizontal" action="product-action.php" method="post">
        <input type="hidden" name="category_id" value="<?php if (isset($_REQUEST['q'])) {
            echo $categoryid;
        } ?>">
        <div class="form-group">
            <label class="control-label col-sm-2" for="category">Category Name</label>
            <div class="col-sm-10">
                <select class="form-control" id="category" name="category">
                    <option value="">--Choose--</option>
                    <?php
                    foreach ($result as $row) {
                        ?>
                        <option value="<?php echo $row['_id'] ?>"><?php echo ucwords(urldecode($row['category'])) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pname">Product Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pname" name="pname"
                          placeholder="Enter Product Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="price">Price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="price" name="price"
                       placeholder="Enter Price">

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="stock">Stock</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="stock" name="stock"
                       placeholder="Enter Stock">

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="photo">Photo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="photo" name="photo">

            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><?php if (isset($_REQUEST['q'])) {
                        echo 'Update';
                    } else {
                        echo 'Add';
                    } ?></button>
            </div>
        </div>
        <div class="text-center">
            <?php
            if (isset($_REQUEST['er'])) {
                $val = $_REQUEST['er'];
                if ($val == 1) {
                    echo '<span class="alert alert-success">Category Inserted Successfully</span>';
                } elseif ($val == 3) {
                    echo '<span class="alert alert-danger">Category Name already Exist</span>';
                } else {
                    echo '<span class="alert alert-danger">Please try again later</span>';
                }
            }
            ?>
        </div>
    </form>
</div>
</body>
</html>
