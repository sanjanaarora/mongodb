<head>
    <title>View Categories</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
include 'header.php';
?>
<?php
include "connection.php";
$categories = $db->selectCollection('categories');
$result = $categories->find();
//print_r($result);
?>

<br><br>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center"><h1>VIEW CATEGORIES</h1></div>
    </div>
    <table class="table table-responsive">
        <tr>
            <th class="text-center">Sr. No.</th>
            <th class="text-center">Category</th>
            <th class="text-center">Description</th>
            <th class="text-center" colspan="2">Delete</th>
        </tr>
        <?php
        $count = 0;
        foreach ($result as $row) {
            ?>
            <tr class="text-center">
                <td><?php echo ++$count ?></td>
                <td><?php echo ucwords(urldecode($row['category'])) ?></td>
                <td><?php echo ucwords(urldecode($row['description'])) ?></td>
                <td><a href="index.php?q=<?php echo $row['_id'] ?>"><span class="glyphicon glyphicon-pencil"></span>
                    </a></td>
                <td><a onclick="return confirm('Are you sure you want to delete?')"
                       href="delete_cat.php?q=<?php echo $row['_id'] ?>"><span
                                class="glyphicon glyphicon-remove-circle"></span> </a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
