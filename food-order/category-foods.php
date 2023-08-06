<?php include("partials-front/menu.php"); ?>
<?php
//check whether id is pass or not
if (isset($_GET['id'])) {
    //id set and get the category food based on food
    $id = $_GET['id'];
    //get the category title
    $sql = "SELECT title FROM category WHERE c_id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //get the value from database
    $row = mysqli_fetch_assoc($res);
    //get the title
    $category_title = $row['title'];
} else {
    //redirect it to homepage
    header('loaction:' . SITEURL);
}

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //create sql query to get food based on category
        $sql2 = "SELECT * FROM food WHERE c_id=$id";
        //execute the sql query
        $res2 = mysqli_query($conn, $sql2);
        //count rows
        $count2 = mysqli_num_rows($res2);
        //check wheather the food is avaliable on the based of category selected
        if ($count2 > 0) {
            //we have food
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
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
        <?php
            }
        } else {
            ///no food found
            echo "<div class='error'>NO FOOD IN THIS CATEGORY.</div>";
        }
        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include("partials-front/footer.php"); ?>