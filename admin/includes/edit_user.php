<?php

if(isset($_GET['edit_user'])){
    $the_user_id = $_GET['edit_user'];


                        $query = "SELECT * FROM users WHERE user_id = $the_user_id "; // users is the name of the table in database
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

                        }

}







        //  enctype will help be in charge of sending different form data
       
  
    if(isset($_POST['edit_user'])){
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
                $query = "SELECT * FROM users WHERE user_id = $the_user_id ";  // send query
                $select_image = mysqli_query($connection,$query); // assign to variable

                while($row = mysqli_fetch_array($select_image)){ // while loop to pull out image
                    $user_image = $row['user_image'];
                }  

            }

// ---------------    Salt and Crypt for passwords ---------------------

        // bring salt value from database 
        $query ="SELECT randSalt FROM users" ;
        $select_randsalt_query = mysqli_query($connection, $query);

        if(!$select_randsalt_query){
            die("Query Failed" . mysqli_error($connection)) ;
        
        }

        // Just needs one result back so did not need to be in while loop
        $row = mysqli_fetch_array($select_randsalt_query); //returns value from database
        $salt = $row['randSalt'];  // assigns randSalt value to $salt
        $hashed_password = crypt($user_password, $salt);  // use crypt and $salt to encrypt password, then assign to $hashed_password



            //concatenating very long query string
                    $query = "UPDATE users SET ";
                    $query .="user_firstname='{$user_firstname}', ";
                    $query .="user_lastname='{$user_lastname}', ";
                    $query .="user_role= '{$user_role}', ";
                    $query .="username='{$username}', ";
                    $query .="user_email='{$user_email}', ";
                    $query .="user_password='{$hashed_password}', ";
                    $query .="user_image='{$user_image}' "; // last query line take out comma
                    $query .="WHERE user_id={$the_user_id} ";

            $edit_user_query = mysqli_query($connection, $query);

            confirmQuery($edit_user_query);

    echo"User Updated: " . " " . "<a class='btn btn-primary' href='users.php'>View Users</a>";  






}

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
                <option value="<?php echo $user_role; ?>"><?php echo $user_role; // default from database?></option> 
                
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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>

    </form>