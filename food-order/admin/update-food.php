<?php include('partials/menu.php'); ?>

<?php
//check whether id is set or not
if (isset($_GET['id'])) {
    //get all the details
    $id = $_GET['id'];
    //sql query to get the selected value
    $sql2 = "SELECT * FROM food WHERE f_id=$id";
    //execute the query
    $res2 = mysqli_query($conn, $sql2);
    ///get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);
    //get the individual value of selected food
    $title = $row2['title'];
    $descrition = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $featured = $row2['featured'];
    $active = $row2['active'];
    $current_category = $row2['c_id'];
} else {
    //redirect to manage food
    header('location:' . SITEURL . 'admin/manage-food.php');
}

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="" cols="30" rows="5"><?php echo $descrition; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Display the image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                        <?php

                        } else {
                            //image not found

                        }

                        ?>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="File" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "Checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if ($featured == "No") {
                                    echo "Checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "Checked";
                                } ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if ($active == "No") {
                                    echo "Checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //create sql query
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            //execute sql query
                            $res = mysqli_query($conn, $sql);
                            //count the rows
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                //we have data in table
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['c_id'];

                                    //echo "<option value='$category_id'>$category_title</option>";
                            ?>

                                    <option <?php if ($current_category == $category_id) {
                                                echo "Selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                            <?php
                                }
                            } else {
                                //nothing to display
                                echo "<option value='0'>Category Not Avaliable.</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            //get all the details from form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $descrition = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            $category = $_POST['category'];
            //upload image if selected

            //check wheather image is selected
            if (isset($_FILES['image']['name'])) {
                //get the image detailes
                $image_name = $_FILES['image']['name'];

                //check wheather the image is avaliable or not
                if ($image_name != "") {
                    //iamge available
                    //upload the new image
                    $image_name = $_FILES['image']['name'];

                    $src_path = $_FILES['image']['tmp_name'];

                    $dest_path = "../images/food/" . $image_name;

                    //finally upload image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    //check image was uploaded or not
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'> Failed to Upload Image.</div>";
                        header('location: ' . SITEURL . 'admin/manage-food.php');
                        //stop the process
                        die();
                    }

                    //remove image if image uploaded
                    //remove the current image
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        //check wheather the image is removed or not
                        //if failed to remove display the message and stop the process
                        if ($remove == false) {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Image.</div>";
                            header('loaction:' . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                    }
                }
            } else {
                $image_name = $current_image;
            }

            //update the food in database
            $sql3 = "UPDATE food SET
               title='$title',
               description='$description',
               price=$price,
               image_name='$image_name',
               featured='$featured',
               active='$active',
               c_id='$category'
               WHERE f_id=$id
               ";
            //execute the sql query
            $res3 = mysqli_query($conn, $sql3);
            //check wheather the query was executed or not
            if ($res3 == true) {
                //Query executed
                $_SESSION['update'] = "<div class='success'>FOOD UPDATED SUCCESSFULLY.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //not executed
                $_SESSION['update'] = "<div class='error'>SOMETHING GOES WRONG.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
            //redirect to mange food with session message
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>