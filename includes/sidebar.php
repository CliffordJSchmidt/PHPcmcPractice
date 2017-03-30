

<div class="col-md-4">
 
   <?php /*  moved to search.php

    if(isset($_POST['submit'])){
    
        $search = $_POST['search']; //data from search assigned to $search
        //echo $_POST['search']; //see and display data that is searched
       //$_POST['search']; //catch data that is posted

//query to look for information from $search variable in database post tags
// LIKE our search variable
    $query="SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";

    $search_query = mysqli_query($connection,$query);
        // if statement to check if query is working or not
        if(!$search_query){
            die("Query FAILED" . mysqli_error($connection));
        }
        //testing to see if there is any results
        $count = mysqli_num_rows($search_query);
            if($count == 0){
                echo"<hr> No Result </h1>";
            } else{
                echo"some results"; 
            }

    } 

  */  ?> 

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form> <!--search form-->
                    <!-- /.input-group -->
                </div>


                <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">

                        <div class="form-group">
                            
                            <input name="username" type="text" class="form-control" placeholder="Enter Username" required>
                        </div>

                        <div class="input-group">
                            
                            <input name="password" type="password" class="form-control" placeholder="Enter Password" required>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" name="login" type="submit">Submit
                                </button>
                            </span>
                            
                        </div>

                    </form> <!--search form-->
                    <!-- /.input-group -->
                </div>







                <!-- Blog Categories Well -->
                <div class="well">
                            
                <?php
                $query = "SELECT * FROM categories LIMIT 12";
                $select_categories_sidebar_query = mysqli_query($connection,$query);
                            // limit in this query allows 3 categories to display
               
                ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                    <!--    <div class="col-lg-6"> adjusted to col-lg-12 below because of removal of categories column -->
                            <div class="col-lg-12">
                            <ul class="list-unstyled">

                            <?php
                             while($row = mysqli_fetch_assoc($select_categories_sidebar_query)){

                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];


                             echo"<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";


                }
                ?>

                              <!--  <li><a href="#">Category Name</a> -->
                               
                            </ul>
                        </div>


                        
                        <!-- /.col-lg-6 -->
                        <!--
                This following section is removed since didn't need so many categories displayed,  also above col            
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>

                        <!-- /.col-lg-6 -->
                       
                    </div>
                    <!-- /.row -->
                </div>








                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

                

</div>