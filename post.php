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

                    // updating post_views_count
        $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
        $send_query = mysqli_query($connection, $view_query);
                        // checking if sent, if not die  and error message 
                confirmQuery($send_query);



            $query = "SELECT * FROM posts WHERE  post_id = $the_post_id ";
             $select_all_posts_query = mysqli_query($connection,$query);
                // this while loop is dynamically updating posts
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title']; // row from database assigned to $post_title variable
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
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                

                <hr>
                <p><?php echo $post_content ?></p>
             

                <hr>




<?php  } 


} else {
    // redirects anyone that comes to the page that doesn't have the p_id .. or the $the_post_id
    header("Location: index.php");

}
?>


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

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">

                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" name="comment_author" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="Your Email">Email</label>
                            <input type="email" name="comment_email" class="form-control" placeholder="youremail@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3" placeholder="What is on your mind?" required></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
<?php

                // comment_post_id   (the name from the comlumn in the table in the database)
                // setting/assigning it to the $the_post_id  - the data being submitted by $_GET
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                //  selecting only approved status comments  
                $query .= "AND comment_status = 'approved' ";
                //  ording by decending comment_id
                $query .= "ORDER BY comment_id DESC ";

                //sending the query
                $select_comment_query = mysqli_query($connection, $query);
                // checking the information returned
                if(!$select_comment_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                // running a loop to pull out date, content, auther to display in comment
                while ($row = mysqli_fetch_array($select_comment_query)){
                    $comment_date       = $row['comment_date'];
                    $comment_content    = $row['comment_content'];
                    $comment_author     = $row['comment_author'];
?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

<?php  } ?>


            </div>





            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>           

        </div>
        <!-- /.row -->

        <hr>
    <!-- Footer -->
    <?php include "includes/footer.php";?>  