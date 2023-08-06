<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        //check wheather the id is set or not
        if (isset($_GET['id'])) {
            //get the id and all other details
            //echo "getting the data";
            $c_id = $_GET['id'];
            //create the sql query
            $sql = "SELECT * FROM category WHERE c_id=$c_id";

            //excute the query
            $res = mysqli_query($conn, $sql);

            //count the rows check wheather the id is valid or not
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                //rediret to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'> CATEGORY NOT FOUND.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            //redirect it to manage category
            header('location:' . SITEURL . 'admin/manage-category.php');
        }

        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Display the image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php

                        } else {
                            //image not found

                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
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
                                } ?> type="radio" name="featured" value="No"> NO
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
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $c_id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            //echo "clicked";
            //get all the value from our form
            $c_id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //updating new image if selected

            //check wheather image is selected
            if (isset($_FILES['image']['name'])) {
                //get the image detailes
                $image_name = $_FILES['image']['name'];

                //check wheather the image is avaliable or not
                if ($image_name != "") {
                    //iamge available
                    //upload the new image
                    $image_name = $_FILES['image']['name'];

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    //finally upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //if image was not uploaded
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'> Failed to Upload Image.</div>";
                        header('location: ' . SITEURL . 'admin/manage-category.php');
                        //stop the process
                        die();
                    }
                    //remove the current image
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;

                        $remove = unlink($remove_path);

                        //check wheather the image is removed or not
                        //if failed to remove display the message and stop the process
                        if ($remove == false) {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Image.</div>";
                            header('loaction:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //update the database
            $sql2 = "UPDATE category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                where c_id=$c_id
                ";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);
            //redirect to manage category page

            //check wheater the query executed the query or not
            if ($res2 == true) {
                //category updated
                $_SESSION['update'] = "<div class='success'>CATEGORY UPDATED SUCCESSFULLY.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                //failed to update category
                $_SESSION['update'] = "<div class='error'>SOMETHING WRONG.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>
    </div>
</div>


<?php include("partials/footer.php"); ?>