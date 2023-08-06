<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>

        <br><br>
        <div class="col-4 text-center">
            <?php
            //sql query
            $sql = "SELECT * FROM category";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div>

        <div class="col-4 text-center">
            <?php
            //sql query
            $sql1 = "SELECT * FROM food";
            //execute the query
            $res1 = mysqli_query($conn, $sql1);
            //count the rows
            $count1 = mysqli_num_rows($res1);
            ?>
            <h1><?php echo $count1; ?></h1>
            <br>
            Foods
        </div>

        <div class="col-4 text-center">
            <?php
            //sql query
            $sql2 = "SELECT * FROM tbl_order";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count the rows
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Total Orders
        </div>

        <div class="col-4 text-center">
            <?php
            //create sql query to get total revenue
            $sql3 = "SELECT SUM(total) AS TOTAL FROM tbl_order";
            //execute the query
            $res3 = mysqli_query($conn, $sql3);
            //get the value
            $row3 = mysqli_fetch_assoc($res3);
            //get the total revenue
            $total_revenue = $row3['TOTAL'];
            ?>
            <h1>RS: <?php echo $total_revenue; ?></h1>
            <br>
            Revenue Generated
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section Ends  -->

<?php include('partials/footer.php'); ?>