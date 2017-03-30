<?php

        //  enctype will help be in charge of sending different form data
       
  
    if(isset($_POST['create_user'])){
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

                     

      //  print_r($_FILES);
      //  var_dump($_FILES);
    

$query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password, user_image) ";
    
$query .= "VALUES( '{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}', '{$user_image}' ) "; 


        $create_user_query = mysqli_query($connection, $query);  

                    // move to admin/functions.php 
                // if(!$create_user_query){
                //    die("QUERY FAILED" . mysqli_error($connection));
               //  } else {}
            
                     confirmQuery($create_user_query);
                    
    //var_dump($create_post_query);

    echo"User Created: " . " " . "<a class='btn btn-primary' href='users.php'>View Users</a>";

}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
            <input type="text" class="form-control" name="user_firstname" required>
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
            <input type="text" class="form-control" name="user_lastname" required>
    </div>


    <div class="form-group">
        <label for="user_image">User Image</label>
            <input type="file" name="image" required>
    </div>


    <div class="form-group">
        <label for="user_role">Role</label></br>
            <select name="user_role" id="" required>

                <option value="subscriber">Select Options</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
      
           </select>
    </div>



    <div class="form-group">
        <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
            <input type="email" class="form-control" name="user_email" required>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
            <input type="password" class="form-control" name="user_password" required>
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>

    </form>