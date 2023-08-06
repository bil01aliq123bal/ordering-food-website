<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br /> <br /><br />

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>ID </th>
                <th>Food </th>
                <th>Price </th>
                <th>Qty </th>
                <th>Total </th>
                <th>Date </th>
                <th>Status </th>
                <th>C.Name</th>
                <th>Contact </th>
                <th>Email </th>
                <th>Address </th>
                <th>Actions </th>
            </tr>
            <?php
            //get all the data from database
            //cretae sql query
            $sql = "SELECT * FROM tbl_order ORDER BY o_id DESC";
            //execute sql query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);
            $sn = 1; //to create the variable that display the id to display data sequencly
            if ($count > 0) {
                //we have data
                while ($row = mysqli_fetch_assoc($res)) {
                    //get all the data from database
                    $id = $row['o_id'];
                    $food = $row['food'];
                    $price = $row['Price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address  = $row['customer_address'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td> <?php echo $food; ?></td>
                        <td> <?php echo $price; ?></td>
                        <td> <?php echo $qty; ?></td>
                        <td> <?php echo $total; ?></td>
                        <td> <?php echo $order_date; ?></td>


                        <td><?php echo $status; ?></td>


                        <td> <?php echo $customer_name; ?></td>
                        <td> <?php echo $customer_contact; ?></td>
                        <td> <?php echo $customer_email; ?></td>
                        <td> <?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Order</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                //no data avaliabale
                echo "<tr><td colspan='12' class='error'>NO ORDER AVALIABLE.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php'); ?>