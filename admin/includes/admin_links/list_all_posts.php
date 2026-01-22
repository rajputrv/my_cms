                    <?php include "delete_post_modal.php"?>
                       <form action="" method="post">
                       <table class="table table-bordered table-hover">
                       <div style="padding: 0px" id="bulkOptionsContainer" class="col-xs-3">
                           <select class="form-control" name="bulk_option" >
                               <option value="published">Publish</option>
                               <option value="draft">Draft</option>
                               <option value="delete">Delete</option>
                               <option value="clone">Clone</option>
                           </select>
                       </div>
                       <div class="col-xs-4">
                          <input type="submit" name="submit" class="btn btn-success bulkOptionsSubmit" value="Apply">
                          <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>

                       </div>
                        <thead>
                            <tr>
                               <th><input type="checkbox" id="selectAllBoxes"></th>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th class='col-xs-3'>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php list_all_posts(); delete_post(); bulkOptionsonPosts(); reset_post_views();?>
                        </tbody>

                    </table>
                    </form>
<script>
     $(document).ready(function(){
         $(".delete_link").on('click',function(){
           var id= $(this).attr('rel');
            var delete_url = "posts.php?delete="+ id;
            $(".modal_delete_link").attr('href', delete_url);
            $("#deleteModal").modal("show");
         })
    })
</script>










                    
                
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
