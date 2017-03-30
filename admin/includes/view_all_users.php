

                        <table class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>User Image</th>
                                    <th>Change to Admin</th>
                                    <th>Change to Subscriber</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    
                                </tr>
                            </thead>

                            <tbody>

<?php 
                        $query = "SELECT * FROM users"; // users is the name of the table in database
                        $select_users_query = mysqli_query($connection,$query);
                          

                        while($row = mysqli_fetch_assoc($select_users_query)){
                            // ['xxxxx'] must be the name of the column in database
                         
                        $user_id = $row['user_id']; 
                        $username = $row['username'];
                        $user_password = $row['user_password'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];                     
                        $user_role = $row['user_role'];
                        $user_image = $row['user_image'];
                       
                      
            
                                echo "<tr>";
                                    echo "<td>{$user_id}</td>";
                                    echo "<td>{$username}</td>";
                                    echo "<td>{$user_firstname}</td>";
                                    echo "<td>{$user_lastname}</td>";
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



                                    echo "<td>{$user_email}</td>";
                                   //echo "<td>{$user_image}</td>";
                                    echo "<td>{$user_role}</td>";

//                       $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
//                       $select_post_id_query = mysqli_query($connection,$query);
//                           while($row = mysqli_fetch_assoc($select_post_id_query)){
//                                $post_id = $row['post_id'];
//                                $post_title = $row['post_title'];
//
//                                    echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
//                                    
//                            }
 

                                    echo "<td><img width='100' src='../images/{$user_image}' alt='user image'></td>";

                                    echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                                    echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";

                                                    //source edit_user is from switch statment from users.php, second parameter edit_user is from the submission of edit_user form
                                    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                                    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                                    
                                echo "</tr>";
                                
                        }
?>                               
                            </tbody>
                        </table>

<?php

  // switch to a $_POST instead of $_GET 
if(isset($_GET['change_to_admin'])){


       // echo" changed to admin???????";   testing if change to admin submits
                                                //comment_status from table 
       $the_user_id = $_GET['change_to_admin'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
        $change_to_admin_query = mysqli_query($connection, $query);
        if(!$change_to_admin_query){ 
                die("QUERY FAILED" . mysqli_error($connection));
                }else{
                   
                   header("Location: users.php"); //  reset page after delete                    
                               
                }
}

  // switch to a $_POST instead of $_GET 
if(isset($_GET['change_to_sub'])){


       // echo" changed to subscriber???????";   testing if change submits
                                                //comment_status from table 
       $the_user_id = $_GET['change_to_sub'];

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
        $change_to_sub_query = mysqli_query($connection, $query);
        if(!$change_to_sub_query){ 
                die("QUERY FAILED" . mysqli_error($connection));
                }else{
                  
                   header("Location: users.php"); //  reset page after delete                    
                               
                }
         
        
}





  // switch to a $_POST instead of $_GET 
if(isset($_GET['delete'])){

       // echo" Deleting??????";   testing if delete submits
                                                //comment_id from table 
       $the_user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_query = mysqli_query($connection, $query);
        if(!$delete_query){ 
                die("QUERY FAILED" . mysqli_error($connection));
                }else{
                   header("Location: users.php"); //  reset page after delete                    
                               
                }
        
        // query to adjust post_comment_count as comments are deleted from a specifi post ($the_post_id)
      // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
      //  $query .= "WHERE post_id = $the_post_id ";
        
}


