            <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

                <?php include "search.php"?>
                <?php
                if(!isset($_SESSION['username'])){
                        include "login_form.php";
                }else{
                        $username = $_SESSION['username'];
                        echo "
                        <div class='well'>
                        <h4>Logged in as '$username'</h4>
                        <a class='btn btn-info' href='includes/logout.php'>Log Out</a>
                        </div>
                        ";
                }
                ?>
                <?php include "blog_cat.php"?>
                <?php include "widgets.php"?>
        </div>

