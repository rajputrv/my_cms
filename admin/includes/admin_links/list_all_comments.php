
                       <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>In Response To</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php list_all_comments(); delete_comment(); unapprove_comment(); approve_comment();?>
                        </tbody>
                    </table>
