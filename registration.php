<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navbar.php"; ?>
<?php  registration(); ?>

    <!-- Page Content -->
    <div class="container">

<section id="registration">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-info">Register</h1>
                    <form role="form" action="registration.php" method="post" id="registration-form" autocomplete="off">
                        <div class="form-group">
                            <label for="reg_username" class="sr-only">username</label>
                            <input type="text" name="reg_username" id="reg_username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="reg_email" class="sr-only">Email</label>
                            <input type="email" name="reg_email" id="reg_email" class="form-control" placeholder="Enter Your Email">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="reg_password" id="key" class="form-control" placeholder="Set up a Password">
                        </div>

                        <input type="submit" name="reg_submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
