<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br /> <br />
        <!-- Button To add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <table class="tbl-full">
            <br /> <br /><br />


            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            ?>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            // query to get all data from admin table
            $sql = "SELECT * FROM admin";
            $res = mysqli_query($conn, $sql);
            $sn = 1;
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $Username = $rows['Username'];

            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td> <?php echo $full_name; ?></td>
                            <td> <?php echo $Username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin</a>
                            </td>
                        <tr>

                <?php
                    }
                } else {
                    echo "<tr> <td colspan='4' class='error'>No Admin Added Yet.</td> </tr>";
                }
            }
                ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends  -->

<?php include('partials/footer.php'); ?>