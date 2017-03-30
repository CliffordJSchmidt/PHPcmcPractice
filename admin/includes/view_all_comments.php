

                        <table class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                    
                                </tr>
                            </thead>

                            <tbody>

<?php 
                        $query = "SELECT * FROM comments"; // posts is the name of the table in database
                        $select_comments_query = mysqli_query($connection,$query);
                          

                        while($row = mysqli_fetch_assoc($select_comments_query)){
                            // ['xxxxx'] must be the name of the column in database
                         
                        $comment_id = $row['comment_id']; 
                        $comment_post_id = $row['comment_post_id'];
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_email = $row['comment_email'];                        
                        $comment_status = $row['comment_status'];
                        $comment_date = $row['comment_date'];
                       
                        
                        //$post_user = $row['post_user'];
                        //$post_content = $row['post_content'];
                        //$post_views_count = $row['post_views_count'];
                        //echo $post_date = $row['post_date'];
            
                                echo "<tr>";
                                    echo "<td>{$comment_id}</td>";
                                    echo "<td>{$comment_author}</td>";
                                    echo "<td>{$comment_content}</td>";
//
//                                     $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}" ;
//                                    $select_categories_id = mysqli_query($connection,$query);
//                                        // query for update variable 
//
//                                        while($row = mysqli_fetch_assoc($select_categories_id)){
//                                       $cat_id = $row['cat_id']; // cat_id is the name of the column in database
//                                        $cat_title = $row['cat_title'];
//
//                                    echo "<td>{$cat_title}</td>";
//                                        }
//



                                    echo "<td>{$comment_email}</td>";
                                    echo "<td>{$comment_status}</td>";

                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                        $select_post_id_query = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_post_id_query)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];

                                    echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                                    
                            }


                                    echo "<td>{$comment_date}</td>";

                                    echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                                    echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                                    
                                    echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                                    
                                echo "</tr>";
                                
                        }
?>                               
                            </tbody>
                        </table>

<?php

  // switch to a $_POST instead of $_GET 
if(isset($_GET['approve'])){


       // echo" approved???????";   testing if approve submits
                                                //comment_status from table 
       $the_comment_id = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
        $approve_comment_query = mysqli_query($connection, $query);
        if(!$approve_comment_query){ 
                die("QUERY FAILED" . mysqli_error($connection));
                }else{
                   
                   header("Location: comments.php"); //  reset page after delete                    
                               
                }
}

  // switch to a $_POST instead of $_GET 
if(isset($_GET['unapprove'])){


       // echo" Unapproved???????";   testing if unapprove submits
                                                //comment_status from table 
       $the_comment_id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
        $unapprove_comment_query = mysqli_query($connection, $query);
        if(!$unapprove_comment_query){ 
                die("QUERY FAILED" . mysqli_error($connection));
                }else{
                  
                   header("Location: comments.php"); //  reset page after delete                    
                               
                }
         
        
}





  // switch to a $_POST instead of $_GET 
if(isset($_GET['delete'])){

       // echo" Deleting??????";   testing if delete submits
                                                //comment_id from table 
       $the_comment_id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
        $delete_query = mysqli_query($connection, $query);
        if(!$delete_query){ 
                die("QUERY FAILED" . mysqli_error($connection));
                }else{
                   header("Location: comments.php"); //  reset page after delete                    
                               
                }
        
        // query to adjust post_comment_count as comments are deleted from a specifi post ($the_post_id)
      // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
      //  $query .= "WHERE post_id = $the_post_id ";
        
}


