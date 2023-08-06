<?php
include('../config/constants.php');
$f_id = $_GET['id'];

$sql = "DELETE FROM food WHERE f_id=$f_id";

$res = mysqli_query($conn, $sql);

if ($res == true) {
    //echo "food DELETED SUCCESSFULLY";
    $_SESSION['delete'] = "<div class='success'>FOOD DELETED SUCCESSFULLY.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
} else {
    //echo "FAILED TO DELETE food";

    $_SESSION['delete'] = "<div class='error'>TRY AGAIN LATER.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
