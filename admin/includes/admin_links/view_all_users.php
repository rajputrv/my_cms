
                  <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php if(isset( $_SESSION['username'])) echo $_SESSION['username'] ?>
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


                    <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source='';
                        }
                            switch ($source){
                                case 'add_user':
                                    include "add_user.php";
                                    break;
                                case 'edit_user':
                                    include "edit_user.php";
                                    break;
                                default:
                                    include "list_all_users.php";
                            }
                        ?>
                    </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div> <!-- /#page-wrapper -->
