<?php include "includes/db.php";?>

<?php include "includes/header.php";?>


    <!-- Navigation -->
<?php include "includes/nav.php";?> 

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

    if(isset($_GET['p_id'])){

        $the_post_id = $_GET['p_id'];
        $the_post_author = $_GET['author'];
    }

            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
            $select_all_posts_query = mysqli_query($connection,$query);
             
             while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    // this while loop is dynamically updating posts
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];        
                 
                 ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id= <?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    All posts by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>


                <hr>
                
   <?php } ?>
                
  
        <!-- Blog Comments -->

    <?php 

    if(isset($_POST['create_comment'])){
    
       // echo $_POST['comment_author'];

       $the_post_id = $_GET['p_id'];

       // data from form submission
       $comment_author = $_POST['comment_author'];
       $comment_email = $_POST['comment_email'];
       $comment_content = $_POST['comment_content'];
   
   

            // checking to make sure comment form fields submitted are not empty
        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                   // If the comment form fields have data, then prepare query for data to be sent to database
            $query = "INSERT INTO comments (comment_post_id, comment_author,comment_email, comment_content, comment_status, comment_date)" ;

            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())" ;

        
            $create_comment_query = mysqli_query($connection, $query);  

                 if(!$create_comment_query){
                     die("QUERY FAILED" . mysqli_error($connection));
                 }
                    // echo 'Your comment was submitted';

                // query to adjust post_comment_count as comments are added to specifi post ($the_post_id)
                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id = $the_post_id ";
                $update_comment_count = mysqli_query($connection, $query) ;
                 echo "<script>alert('Your comment was submitted!')</script>";

        } else {
            // if comment form fields are empty when submitted - altert user to enter date_add

            echo "<script>alert('Please fill in form completely to comment')</script>";

        }


    }

    ?>

            </div>





            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>           

        </div>
        <!-- /.row -->

        <hr>
    <!-- Footer -->
    <?php include "includes/footer.php";?>  

