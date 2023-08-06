<?php include("partials-front/menu.php"); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        //get the search keyword
        $search = $_POST['search'];
        ?>
        <h2>Foods on Your Search <a href="<?php echo SITEURL; ?>foods.php" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //create sql query based on serach keyword
        $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        //execute sql query
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);
        //chexk wheather we have data or not
        if ($count > 0) {
            //we have data
            while ($row = mysqli_fetch_assoc($res)) {
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //check wheather image avalibale orr not
                        if ($image_name == "") {
                            //display message
                            echo "<div class='error'>No Image Found.</div>";
                        } else {
                            //image avaliable
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">RS: <?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="order.php" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            //no data found
            echo "<div class='error'>NO FOOD FOUND.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- fOOD Menu Section Ends Here -->
<?php include("partials-front/footer.php"); ?>