<?php
include('../config/constants.php');
$c_id = $_GET['id'];

$sql = "DELETE FROM category WHERE c_id=$c_id";

$res = mysqli_query($conn, $sql);

if ($res == true) {
    //echo "category DELETED SUCCESSFULLY";
    $_SESSION['delete'] = "<div class='success'>CATEGORY DELETED SUCCESSFULLY.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
} else {
    //echo "FAILED TO DELETE category";

    $_SESSION['delete'] = "<div class='error'>TRY AGAIN LATER.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
}
