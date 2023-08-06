<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD FOOD</h1>

        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter food Title">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Food Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //create PHP code to display categories from database
                            //create sql query to get all active categories from database
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            //Execute the sql query
                            $res = mysqli_query($conn, $sql);
                            //count check wheather we have categories or not
                            $count = mysqli_num_rows($res);
                            //if we have categories greather than zero, 
                            //so we have category otherwise we have no category
                            if ($count > 0) {
                                //we have category
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    //get the details
                                    $id = $rows['c_id'];
                                    $title = $rows['title'];
                            ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php
                                }
                            } else {
                                //we do not have category
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }

                            ?>


                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        //check wheather the button is clicked or not
        if (isset($_POST['submit'])) {
            //add the food in database

            //get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            //check wheather the featured and active button are checked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; //set the default value
            }
            //for active
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //same as featured
            }
            $category = $_POST['category'];
            //upload the image if selected
            //check wheather the select image is clicked or not and upload the image if the image is selected
            if (isset($_FILES['image']['name'])) {
                //get the detailed of the selected image
                $image_name = $_FILES['image']['name'];

                //check wheather the image is selected or not and upload image only if selected
                if ($image_name != "") {
                    //image is selected
                    //get the src path and destination path
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/" . $image_name;
                    //finally upload image
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image is uploaded or not
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header('loaction:' . SITEURL . 'admin/manage-food.php');
                        die();
                    }
                }
            } else {
                $image_name = ""; //setting default value as blank
            }
            //insert into database
            //create sql query to save or add food
            $sql2 = "INSERT INTO food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                featured='$featured',
                active='$active',
                c_id=$category
                ";
            //execute the sql query
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>FOOD IS ADDED SUCCESSFULLY.</div>";
                header('loaction:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>SOMETHING IS MISSING.</div>";
                header('loaction:' . SITEURL . 'admin/manage-food.php');
            }
            //redirect with message to manage food page
        }


        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>