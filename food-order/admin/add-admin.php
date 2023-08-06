<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }


        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your password is"></td>
                </tr>
                <tr>
                    <td colspans="2"> </td>
                    <input type="Submit" name="Submit" value="Add Admin" class="btn-secondary">
                </tr>
            </table>


        </form>


    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php
//Process the data and save it in database

//check whether the submit button work or not

if (isset($_POST["Submit"])) {
    //Button Clicked
    //echo "Button Clicked";

    //1.Get the data from form

    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]); //password is Encrypted

    //2. write Sql Query to save data in database
    $sql = "INSERT INTO admin SET
full_name='$full_name',
Username='$username',
password='$password'
";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        //DATA IS INSERTED
        // echo "DATA IS INSERTED";
        $_SESSION['add'] = "ADMIN ADDED SUCCESSFULLY";
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //DATA IS NOT INSERTED
        // echo "FAIL TO INSERT DATA"; 
        $_SESSION['add'] = "PLEASE TRY AGAIN";
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
