<?php add_categories(); ?>
<?php delete_categories(); ?>

                  <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $_SESSION['username'] ?>
                            <small>Welcome to the site!</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Posts
                            </li>
                        </ol>


                        <div class="col-xs-6">
                        <!--add categories form-->
                        <form action="categories.php" method="post">
                            <div class="form-group">
                               <label for="add_cat_title">Add Category</label>
                                <input type="text" class="form-control" name="add_cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary"  type="submit" name="add_cat_submit" value="Add Category">
                            </div>
                        </form>

                            <?php



                            //conditionla include  of edit form since only when pencil icon is clicked
                            if(isset($_GET['edit'])){
                                $edit_cat_id = $_GET['edit'];
                                include "edit_categories.php";
                            }

                            ?>

                        </div>

                       <!--list categories-->
                        <div class="col-xs-6">
                            <table class="table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>

                                        <th class="col-sm-2">Id</th>
                                        <th class="col-sm ">Category Title</th>
                                    </tr>
                                    <tbody>
                                       <?php list_categories();?>
                                    </tbody>
                                </thead>
                            </table>
                        </div>

                        </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div> <!-- /#page-wrapper -->
