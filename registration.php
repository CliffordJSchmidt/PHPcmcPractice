<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php

if(isset($_POST['submit'])){
    // test to see if registration for is working 
   // echo "Registration was submitted";

    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];

            // checking to make sure comment form fields submitted are not empty
    if(!empty($username) && !empty($email) && !empty($password)){



        // data assigned to variables - and submitted
        // 'escaped' some values using mysqli_real_escape_string - used to help protect from sql injections 
        $username   = mysqli_real_escape_string($connection, $username) ;
        $email      = mysqli_real_escape_string($connection, $email) ;
        $password   = mysqli_real_escape_string($connection, $password) ;

            // test to check if data is assigned to variable and cleaned
                
            //echo $username;


        // bring salt value form database to  add to password_get_info
        $query ="SELECT randSalt FROM users" ;
        $select_randsalt_query = mysqli_query($connection, $query);

        if(!$select_randsalt_query){
            die("Query Failed" . mysqli_error($connection)) ;
        
        }

        // was used to test if randSalt value was returne from database 
       // while ($row = mysqli_fetch_array($select_randsalt_query)){
       //     $salt = $row['randSalt']; // can echo test to see if randSalt value was returned from database
        //    
      //  }

    // using the salt with crypt to protect password 
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $password = crypt($password, $salt);


        $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $query .= "VALUES ('{$username}','{$email}','{$password}', 'subscriber') ";

        $register_user_query = mysqli_query($connection, $query);

            if(!$register_user_query){
                die("QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection));

            } else {
                $message ="Your Registration has been submitted.";
                //header("Location: index.php");  // can use the message above using PHP  or redirect 
            }



    } else {

            $message = "Please fill out the form completly to Register"; // can use javascript message below or php $message to echo a message 
        //echo "<script>alert('Please fill in form completely to Register')</script>";
    }



} else {
     $message = ''; // in case form isn't submitted $message will be created and assigned no value so no error if page is refreshed 
}

?>






    <!-- Navigation -->
    
  <?php include "includes/nav.php";?> 
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                    <h6 class="text-center"><?php echo $message; ?></h6>

                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
