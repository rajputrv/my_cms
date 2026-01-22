<!-- Pager --><?php
                if($no_of_pages>0){
                echo "<ul class='pager'>
                    <li class='previous'>
                        <a href=''>&larr; Older</a>
                    </li>";

                    if(isset($show_feeds)){
                        $get_param = "&feed_source=".$show_feeds;

                        $show_feeds_param = substr($show_feeds,3);
                        //$feeds_param_value = $$_GET[$show_feeds_param];
                        $get_param .="&". $show_feeds_param. "=" .$feeds_param_value;
                        // made own logic because my get params are unique:
                        //
                        //show feed is defined above in blog_feed
                        // cut show feed which is like by_category to category
                        // or by_author to author so that this can be used as second param
                        // second param will be like category= cat_id or author = author id
                        // so $$_GET[$show_feeds_param] will be either $$_GET[$category] or  $$_GET[author]
                        // to get these values form Get global array

                    }
                    else {
                        $get_param = '';
                    }
                    for($i=1; $i<=$no_of_pages; $i++){
                        if ($i == $page){
                        echo "<li   >
                        <a style='background-color : #5da5e3; text-color:black;' href='index.php?page={$i}{$get_param}'>$i</a>
                        </li>";
                        }else {
                          echo "<li >
                        <a  href='index.php?page={$i}{$get_param}'>$i</a>
                        </li>";
                        }
                    }

                    echo "<li class='next'>
                        <a href=''>Newer &rarr;</a>
                    </li>
                </ul>";
                }
?>
</div>
