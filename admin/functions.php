<?php


function users_online(){
    if(isset($_GET['onlineusers'])){
        global $connection;
                // catch session id 
            if(!$connection){
                session_start();
                include("../includes/db.php");
            
            $session = session_id();

            // variable that holds time
            $time = time();

            // variable that sets amount of time until user is marked offline example 300 = 5 min 
            $time_out_in_seconds = 30;


            //  gives us the varialbe that can be used for time_out of the user 
            $time_out = $time - $time_out_in_seconds;


            // query to count the users that are online 
            $query = "SELECT * FROM users_online WHERE session ='$session'" ;
            // send the query
            $send_query = mysqli_query($connection, $query);
            // receive the data from query, count it, and set to variable 
            // to see if anyone is online 
            $count = mysqli_num_rows($send_query);


            //
            if($count == NULL){
                // if the new session id/user just logged in query to insert data to table 
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')") ;

            }else{
                    //when a user is not new/ then update 
                mysqli_query($connection,"UPDATE users_online SET time='time' WHERE session ='session'") ;

            }

        // show users that are not atcive 
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time < '$time_out'") ;
            return $count_user = mysqli_num_rows($users_online_query);

         } //$connection 
    } // get request isset onlineusers 
}   
// call the function 
users_online();




    // function saved from add_post.php
function confirmQuery($result){

    global $connection;

    if(!$result){
                    die("QUERY FAILED ." . mysqli_error($connection));
                }
               
}


function insertCategories(){

                        global $connection; // makes the $connection variable global so it can be used on other pages

                        /* test to see if form submits
                        if(isset($_POST['submit'])){
                            echo ' form was submitted';
                        }
                            */
                        
                        if(isset($_POST['submit'])){   // get info from form
                            $cat_title = $_POST['cat_title'];  // get cat_title and assigning to variable $cat_title
                                            // test if it is empty submission
                            if($cat_title == "" || empty($cat_title)){
                                echo "This field should not be empty";
                            }else{
                                // if not empty, insert into table categories
                                $query = "INSERT INTO categories(cat_title) ";
                                $query .= "VALUE('{$cat_title}') ";

                                $create_category_query = mysqli_query($connection, $query); // query sending the data to the table
                                
                                //testing to see if query submission was successful
                                if(!$create_category_query){
                                    die('QUERY FAILED' . mysqli_error($connection)); 
                                    //if not successful kill the query with die and display a message
                                }

                            }
                        }

}





function findALLCategories(){    //FIND ALL CATEGORIES FUNCTION



            global $connection;

                        $query = "SELECT * FROM categories";
                        $select_categories_query = mysqli_query($connection,$query);
                            // limit in this query allows 3 categories to display

                        while($row = mysqli_fetch_assoc($select_categories_query)){
                        $cat_id = $row['cat_id']; // cat_id is the name of the column in database
                        $cat_title = $row['cat_title'];

                        echo "<tr>";
                        echo "<td>{$cat_id}</td>";
                        echo "<td>{$cat_title}</td>";
                        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                        echo "<td><a href='categories.php?update={$cat_id}'>Update</a></td>";
                        echo "</tr>";
                        }
}

                        
function deleteCategories(){                       
                        //  DELETE QUERY to remove category on admin

             global $connection;
                        if(isset($_GET['delete'])){
                            $get_cat_id = $_GET['delete'];

                            $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id} ";
                                $delete_query = mysqli_query($connection, $query);
                            header("Location: categories.php"); // refreshes page 
                        }

}


function updateAndIncludeQuery(){

            global $connection;
                        // UPDATE AND INCLUDE QUERY
                             if(isset($_GET['update'])){
                                $cat_id = $_GET['update'];
                                include "includes/update_categories.php"; // update form 
                            }

}



?>