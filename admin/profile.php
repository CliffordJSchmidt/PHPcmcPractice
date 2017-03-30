<?php include "includes/admin_header.php" /// header sent from header.php in admin includes folder ?>
<?php  
    if(isset($_SESSION['username'])){
        
        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '$username' ";

        $select_user_profile_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($select_user_profile_query)){
            $user_id = $row['user_id']; 
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];           $user_image = $row['user_image'];         
            $user_role = $row['user_role'];
            
        }


    }  
    

    if(isset($_POST['update_profile'])){
         // testing and displaying what is sent
        //var_dump($_POST);
   

        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
       
       
       
       
        $username = $_POST['username'];     
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // using superglobal $_FILES
        $user_image= $_FILES['image']['name']; 

        // saves image to temporary location to be used later by calling variable $post_image_temp
        $user_image_temp = $_FILES['image']['tmp_name']; 

        //function for date format to send day/month/year
        //$post_date = date('d-m-y');
        

    
        //function form images,  with two parameters.  moves image or file from the temporary location ($post_image_temp) to the location we want (images/...)
        move_uploaded_file($user_image_temp, "../images/$user_image");
                        // if error check and make sure the folder has read and write options, set properties security and permissions 
            if(empty($post_image)){
                $query = "SELECT * FROM users WHERE user_id = $user_id ";  // send query using session variable?
                $select_image_query = mysqli_query($connection, $query); // assign to variable

                while($row = mysqli_fetch_array($select_image_query)){ // while loop to pull out image
                    $user_image = $row['user_image'];
                }  

            }
                     

            //concatenating very long query string
                    $query = "UPDATE users SET ";
                    $query .="user_firstname ='{$user_firstname}', ";
                    $query .="user_lastname ='{$user_lastname}', ";
                    $query .="user_role = '{$user_role}', ";
                    $query .="username ='{$username}', ";
                    $query .="user_email ='{$user_email}', ";
                    $query .="user_password ='{$user_password}', ";
                    $query .="user_image ='{$user_image}' "; // last query line take out comma
                    $query .="WHERE username = '{$username}' "; // $username is the session variable that is being passed 


            $edit_user_query = mysqli_query($connection, $query);

            confirmQuery($edit_user_query);


}









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
                            <small> <?php echo $_SESSION['username']; ?></small>
                        </h1>


<?php /* this was a test to see if sessions were working
    if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
    }  
    */
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" required>
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname" required>
    </div>


    <div class="form-group">
        <label for="user_image">User Image</label></br>
            <img width = "100" src="../images/<?php echo $user_image; ?>" alt="">
            <input type="file" name="image">
    </div>

   
    <div class="form-group">
        <label for="user_role">Role</label></br>

  
            <select name="user_role" id="" required>
                <option value="subscriber"><?php echo $user_role; // default from database?></option> 
                
                <?php 
                        
                        if($user_role == 'admin'){
                            
                            echo "<option value='subscriber'>subscriber</option>";
                        } else {
                            echo "<option value='admin'>admin</option>";
                        }
                 
                ?> 
           </select>  

<!--   This is another way in case of multiple user roles 
            <select class="form-group" name="user_role" id="">
                <option value="<?php //echo $user_role; ?>"><?php// echo ucfirst($user_role); ?></option>
                
                    <?php /*  //www.pastebin.com/6xThExG
                    
                    $roles = ["admin", "moderator", "subscriber", "banned"];
                    
                    foreach ($roles as $role) {
                    
                        if ($role !== $user_role) {
                        echo "<option value='{$role}'>" . ucfirst($role) . "</option>";
                        }
                    
                    }
                    */
                    ?>
                
            </select>
-->

    </div>




    <div class="form-group">
        <label for="username">Username</label>
            <input type="text" value="<?php echo $username; ?>" class="form-control" name="username" required>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
            <input type="email"value="<?php echo $user_email; ?>"  class="form-control" name="user_email" required>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
            <input type="password" value="<?php echo $user_password; ?>"class="form-control" name="user_password" required>
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
    </div>

    </form>




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

