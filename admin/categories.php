<?php include "includes/admin_header.php" /// header sent from header.php in admin includes folder 
?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php" /// header sent from nav.php in admin includes folder ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin page
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">



                        <form action="" method="post">
                                <div class="form-group"> 
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>


                        <?php 
                        insertCategories(); 
                        //calls the function insertCategories() from functions.php 
                        // functions.php included in the admin_header to be used in this page 


                        deleteCategories();
                        // calls the function deleteCategories() from functions.php
                        ?>
                        

                                <div class="form-group"> 
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            
                        </form>   
                            

                           
                            <?php
                            // calls the function updateAndIncludeQuery()  from functions.php
                            updateAndIncludeQuery();
                            ?>







                        </div> <!-- Add Category Form -->
                        <div class="col-xs-6">


                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                               
                        <?php // FIND ALL CATEGORIES QUERY calls the function findALLCategories() from functions.php
                            findALLCategories()

                        ?>




                                 </tbody>
                                </table>

                        </div>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
   

        <!-- /#page-wrapper -->
        <!-- header sent from admin_footer.php in admin includes folder -->
        <?php include "includes/admin_footer.php" ?>

