<?php include("partials-front/menu.php");
?>
<?php
//check wheather food id is set or not
if (isset($_GET['f_id'])) {
    //get the food idand details of selected food
    $f_id = $_GET['f_id'];
    //get the details of slected food
    $sql1 = "SELECT * FROM food WHERE f_id=$f_id";
    //execute the query
    $res1 = mysqli_query($conn, $sql1);
    //count the rows
    $count1 = mysqli_num_rows($res1);
    //check whether the data is avaliable or not
    if ($count1 == 1) {
        //we have data 
        //get the data from database
        $row = mysqli_fetch_assoc($res1);
        //get the details
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        //we have not data and redirect to homepage
        header('location:' . SITEURL);
    }
} else {
    //rediret to homepage
    header('location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    //check whether image is avaliable or not
                    if ($image_name == "") {
                        //image not avaliable
                        echo "<div class='error'>NO IMAGE FOUND.</div>";
                    } else {
                        //we have image
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                    }
                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price">RS: <?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Contact number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="e.g. abc@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
        <?php
        //check whether submit button is clicked or not
        if (isset($_POST['submit'])) {
            //get all the details from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty; //wqtye get total by price*

            $order_date = date("Y-m-d h:i:sa"); //set the format in which we gettting the current date

            $status = "Ordered"; //staus will be ordered,delivered,on delivered 

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];


            //save the order in database
            //create sql query
            $sql2 = "INSERT INTO tbl_order SET
            food='$food',
            price=$price,
            qty=$qty,
            total=$total,
            order_date='$order_date',
            status='$status',
            customer_name='$customer_name',
            customer_contact='$customer_contact',
            customer_email='$customer_email',
            customer_address='$customer_address'
            ";
            // echo $sql2;
            //die();
            //execute the sql query
            $res2 = mysqli_query($conn, $sql2);
            //check wheather the query executed or not
            if ($res2 == true) {
                //data is save in database
                $_SESSION['order'] = "<div class='success text-center'>YOUR ORDER IS PLACED.</div>";
                header('location:' . SITEURL);
            } else {
                //something is missing
                $_SESSION['order'] = "<div class='error text-center'>SERVER IS DOWN PLEASE TRY AGAIN LATER.</div>";
                header('location:' . SITEURL);
            }
        }

        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php include("partials-front/footer.php"); ?>