<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navbar.php"; ?>
<?php  contact(); ?>

    <!-- Page Content -->
    <div class="container">

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-info">Contact Me</h1>
                    <form role="form" action="contact.php" method="post" id="contact-form" autocomplete="off">
                         <div class="form-group">
                            <label for="contact_email" class="sr-only">Email</label>
                            <input type="email" name="contact_email" id="contact_email" class="form-control" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Desired Subject">
                        </div>

                         <div class="form-group">
                            <label for="body" class="sr-only">Message</label>
                             <textarea name="body" id="body" class="form-control" rows="10" placeholder="Write Your message..."></textarea>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Contact">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>


</div>
<?php include "includes/footer.php";?>
