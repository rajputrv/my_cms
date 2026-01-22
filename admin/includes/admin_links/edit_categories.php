
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="edit_cat_title">Edit Category</label>
                                        <?php
                                   // To get name of id and put it inside input box for edit
                                if(isset($_GET['edit']) ){
                                $edit_cat_id = $_GET['edit'];
                                $get_edit_cat = "SELECT * FROM categories WHERE id = '{$edit_cat_id}'";
                                $edit_cat_row = mysqli_query($connection, $get_edit_cat);
                                if (!$edit_cat_row) {
                                    die("Database query failed: " . mysqli_error($connection));
                                }
                                while($edit_cat = mysqli_fetch_assoc($edit_cat_row)){
                                    $edit_cat_title = $edit_cat['cat_title'];
                                    ?>

                                        <input type="text" class="form-control" name="edit_cat_title" value="<?php if(isset($edit_cat_title)) {echo $edit_cat_title;}  ?>">

                                    <?php
                                }}
                                // to update the name on the db on clicking Edit category button
                                if (isset($_POST["edit_cat_submit"])) {
                                    $cat_title= $_POST["edit_cat_title"];
                                    $edit_cat_id = $_GET['edit'];
                                    if($cat_title==="" or empty($cat_title)){
                                        echo "This field should not be empty!";
                                    }else{
                                        $edit_cat_query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE id = '{$edit_cat_id}'";
                                        $update_category_result = mysqli_query($connection, $edit_cat_query);
                                        if(!$update_category_result){
                                            die("Can't Edit the Query: " . mysqli_error($connection));
                                        }
                                    }
                                    header("Location: categories.php");
                                    exit();
                               }
                                 ?>

                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="edit_cat_submit" value="Update Category">
                                    </div>
                                </form>
