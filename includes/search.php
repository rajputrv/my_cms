               <?php
                if(isset($_POST['search_submit'])){
                   $search = $_POST['search'];

                    $db_query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    global $search_query;
                    $search_query= mysqli_query($connection, $db_query);

                    if(!$search_query){
                        die("No Search Results Found");
                    }else{
                        $count = mysqli_num_rows($search_query);
                        if($count===0) {
                            echo "<h2 classname='text-danger'>No Results Found!</h2>";
                        }
                    }

                }
            ?>
               <!-- Blog Search Well -->
               <div class="well">
                   <h4>Blog Search</h4>
                   <form action="./index.php" method="post">

                       <div class="input-group">
                           <input name="search" type="text" class="form-control">
                           <span class="input-group-btn">
                               <button name="search_submit" class="btn btn-default" type="submit">
                                   <span class="glyphicon glyphicon-search">

                                   </span>
                               </button>
                           </span>
                       </div>
                   </form>
                   <!-- /.input-group -->
               </div>
