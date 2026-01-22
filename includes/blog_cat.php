                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                               <?php
                               $get_cat = "SELECT * FROM categories";
                               $selected_cat = mysqli_query($connection, $get_cat);
                               $i = 1;
                               $n = mysqli_num_rows($selected_cat);
                               while (($cat = mysqli_fetch_assoc($selected_cat)) and $i++ <= $n / 2 +1) {
                                   $cat_id = $cat['id'];
                                   $cat_title = $cat['cat_title'];
                                   echo "<li>
                                        <a href='index.php?feed_source=by_category&category={$cat_id}'>$cat_title</a>
                                        </li>";
                               }
                               ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                                while (($cat) and $i++ <= $n+1) {
                                    $cat_id = $cat['id'];
                                    $cat_title = $cat['cat_title'];
                                   echo "<li>
                                        <a href='index.php?feed_source=by_category&category={$cat_id}'>$cat_title</a>
                                        </li>";
                                    $cat = mysqli_fetch_assoc($selected_cat);
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
