<?php include "db.php"; ?>
<?php session_start();  // starting sessions so it can be used later?>
<?php include "functions.php"; ?>

<?php


// all information is recieved here from login form 
if(isset($_POST['login']))
{
        /* an example of how  you can cout numbers in a string 
            $password = "secret";
            $has_format = "$2y$10";
            $salt ="iusesomecrazystring22";
            echo strlen($salt);
            this is what is in the database for crypt($password, $has_format&$salt);
        */
    // echo to test 

    $username = $_POST['username'];
    $password = $_POST['password'];

    // used to help prevent sql injections
    $username = mysqli_real_escape_string($connection, $username );
    $password = mysqli_real_escape_string($connection, $password );

    //pulling username form users 
    $query = "SELECT * FROM users WHERE username ='{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    // check for error during submission 
    confirmQuery($select_user_query);



    // pulling informatoin out, putting into array,  and echo information from the information 
    while($row = mysqli_fetch_array($select_user_query)){
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];


    }

    
    // checking if the username and password submitted above through the form is valid
    if($username !== $db_username && $password !== $db_user_password) {
            
            header("Location: ../index.php"); // if not, redirected to index page
            
        } else if ($username == $db_username && $password == $db_user_password){
            //  if it matches information from database it is assigned to a $_SESSION 
            //using session
            // assigning right to left... $db_username to $_SESSION['username'] .. so it can be used somewhere else later
            
            $_SESSION['username']= $db_username;
            $_SESSION['user_password']= $db_user_password;
            $_SESSION['user_firstname']= $db_user_firstname;
            $_SESSION['user_lastname']= $db_user_lastname;
            $_SESSION['user_role']= $db_user_role;

            // user redirect to admin page 
            header("Location: ../admin");

        } else {

            header("Location: ../index.php"); // if any others, redirect to index page
        }
    



// ---------------------  updating password to add crypt and salt for login ---------------

     $password = crypt($password, $db_user_password);


        //  ------------- BELOW IS ANOTHER EXAMPLE LOGIN CHECKING and SESSION---------------

        // checking if it is exactly identical to ... more strict 
        if($username === $db_username && $password === $db_user_password) {
                
                $_SESSION['username']= $db_username;
                $_SESSION['user_password']= $db_user_password;
                $_SESSION['user_firstname']= $db_user_firstname;
                $_SESSION['user_lastname']= $db_user_lastname;
                $_SESSION['user_role']= $db_user_role;

                header("Location: ../admin"); // user redirect to admin page 
        
            } else {

                header("Location: ../index.php"); // if any others, redirect to index page
        }

}





?>
