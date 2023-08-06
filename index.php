<?php include("partials-front/menu.php"); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>


        <?php
        //create sql query to display category
        $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 5";
        //execute sql query
        $res = mysqli_query($conn, $sql);
        //count rows to check wheather the categories avaliable or not
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //we have category
            while ($row = mysqli_fetch_assoc($res)) {
                //get the value from database
                $id = $row['c_id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            //display message
                            echo "<div class='error'>NO Image Found.</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //no category found
            echo "<div class='error'>NO CATEGORY ADDED.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //getting food from database where food are active
        $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 15";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);
        //count the rows
        $count2 = mysqli_num_rows($res2);
        //check whetaher we have food or not
        if ($count2 > 0) {
            //we have food
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['f_id'];
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

                        <a href="<?php echo SITEURL; ?>order.php?f_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <div class="clearfix"></div>
    </div>
<?php

            }
        } else {
            //no food
            echo "<div class='error'>No Food Added Yet.</div>";
        }
?>
<p class="text-center">
    <a href="#">See All Foods</a>
</p>
</section>
<!-- fOOD Menu Section Ends Here -->



<?php include("partials-front/footer.php"); ?>