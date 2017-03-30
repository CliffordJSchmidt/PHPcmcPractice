

                                <?php // $display_stats... may be able to be used to make form apear or disapear ?>

                            <form action="" method="post" style=display:<?php $display_status?>">
                                <div class="form-group"> 
                                    <label for="cat_title">Update Category</label>
                                <?php
                                // check if update was made, then assign update to a variable 
                                 if(isset($_GET['update'])){
                                    $update_cat_id = $_GET['update'];

                                    $query = "SELECT * FROM categories WHERE cat_id = {$update_cat_id}" ;
                                    $select_categories_id = mysqli_query($connection,$query);
                                        // query for update variable 

                                        while($row = mysqli_fetch_assoc($select_categories_id)){
                                        $cat_id = $row['cat_id']; // cat_id is the name of the column in database
                                        $cat_title = $row['cat_title'];
                                        
                                    }
                                
                                ?>

                                <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">  <!-- adds text field for update category if update button on the right is selected  -->



                              <?php }  ?>


                              <?php  // UPDATE QUERY
                              //updating so update functions instead of adding an additional category
                                if(isset($_POST['update_category'])){
                                $update_cat_title = $_POST['cat_title'];

                                    // makes sure something is entered when updating a cat_title
                                    if($update_cat_title == "" || empty($update_cat_title)){
                                        echo "This field should not be empty";
                                    }else{


                                $query = "UPDATE categories SET cat_title= '{$update_cat_title}' WHERE cat_id ={$cat_id}  ";
                                $update_query = mysqli_query($connection, $query);  
                                    // if update query fails kill the process
                                   
                                  //confirmQuery($update_query);
                                   // could use the  function confirmQuery(); to replace the full function below
                                    if(!$update_query){ 
                                        die("QUERY FAILED" . mysqli_error($connection));
                                    }else{
                                        
                                    header("Location: categories.php"); //  reset page after update
                                    }
                                    }
                                }

                              ?>

                                </div>
                                <div class="form-group"> 
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                </div>
                            
                            </form>