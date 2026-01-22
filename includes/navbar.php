    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">My CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   <?php
                    
                    // get current url
                    $pageName= basename($_SERVER['PHP_SELF']);
                    global $connection;
                    $get_cat = "SELECT * FROM categories";
                    $selected_cat = mysqli_query($connection, $get_cat);
                    while($cat = mysqli_fetch_assoc($selected_cat)){
                        $cat_title = $cat['cat_title'];
                        $cat_id = $cat['id'];
                        $cat_class='';
                        if(isset($_GET['category']) && $_GET['category']== $cat_id ){
                            $cat_class ='active';
                        }
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='index.php?feed_source=by_category&category={$cat_id}'>$cat_title</a>
                        </li>"; 
                        
                        
                    }

                    ?>
                    <?php user_li_on_navbar();?>
                    <?php register_li_on_navbar();?>
                    <?php edit_post_li_on_navbar(); ?>
                    <li><a href="contact.php">Contact</a></li>
                 </ul>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>






