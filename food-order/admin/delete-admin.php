<?php
include('../config/constants.php');


$id = $_GET['id'];

$sql = "DELETE FROM admin WHERE id=$id";

$res = mysqli_query($conn, $sql);

if ($res == true) {
    //echo "ADMIN DELETED SUCCESSFULLY";
    $_SESSION['delete'] = "<div class='success'>ADMIN DELETED SUCCESSFULLY.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    //echo "FAILED TO DELETE ADMIN";

    $_SESSION['delete'] = "<div class='error'>TRY AGAIN LATER.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
}
