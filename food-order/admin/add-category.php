<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <!-- Add Category Form Start-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
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
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Add Category Form Start-->
        <?php
        //check wheater the submit button is clicked or not
        if (isset($_POST['submit'])) {
            //echo "clicked";
            //get the value from form
            $title = $_POST['title'];

            //for radio input tag we need to check the button is selected or not
            if (isset($_POST['featured'])) {
                //get the value from form
                $featured = $_POST['featured'];
            } else {
                //set the default value
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                //get the value from form
                $active = $_POST['active'];
            } else {
                //set the default valued
                $active = "No";
            }
            //check weather the image is selected or not and set value for image
            if (isset($_FILES['image']['name'])) {
                //upload image
                //to upload imagew we need image name, source and destination path
                $image_name = $_FILES['image']['name'];

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/" . $image_name;

                //finally upload image
                $upload = move_uploaded_file($source_path, $destination_path);

                //if image was not uploaded
                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'> Failed to Upload Image.</div>";
                    header('location: ' . SITEURL . 'admin/add-category.php');
                    //stop the process
                    die();
                }
            } else {
                //don't upload the image and set the image name is  blank
                $image_name = "";
            }
            //to create SQL Query to insert the value
            $sql = "INSERT INTO category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'";

            //execute the query and safe it in database
            $res = mysqli_query($conn, $sql);


            //check wheather the query is executed or not and data is added or not
            if ($res == true) {
                //Query executed and Category added
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                //redired to manage category page
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                //failed to add category
                $_SESSION['add'] = "<div class='error'>Something is Wrong.</div>";
                //redired to manage category page
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>