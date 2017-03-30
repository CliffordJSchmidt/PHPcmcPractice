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
// the $per_page variable can be used in admin to set the number of pages to display
// the variable is used to replace the value in the various locations for pagination 
    $per_page = 10; 

// capturing get request sent by clicking pagination link at bottom of page
    if(isset($_GET['page'])){

        

        // assign value to variable to use later
        $page = $_GET['page'];
    } else {
        // if no value is returned assigning it an empty string value so no errors 
        $page ="";
    }

        // to find the first page 
        // if $page value is either the empty string or 1  assign it to the $page_1 
        // $page_1  for the loop in the query below can be used as the starting LIMIT for the query 
    if($page == "" || $page ==1){
        $page_1 = 0;
    } else {
        $page_1 = ($page * $per_page) - $per_page;
    }


// to do pagination start with finding the count of items to display
// find out how many posts are on the database to use for pagination
    $post_query_count = "SELECT * FROM posts";
        $find_count = mysqli_query($connection,$post_query_count);
        // assign the value to a array/variable $count
        $count = mysqli_num_rows($find_count);

        // rounds the count number up so it can be displayed as a full integer to use for pagination links at bottom of page 
        $count = ceil($count / 10); 







                // the first line is a way to show a specific number of posts using LIMIT in the query
                //$query = "SELECT * FROM posts LIMIT 0, 10";
            $query = "SELECT * FROM posts LIMIT $page_1, $per_page" ;
             $select_all_posts_query = mysqli_query($connection,$query);
                // this while loop is dynamically updating posts
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title']; // row from database assigned to $post_title variable
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,100);
                    $post_status = $row['post_status'];


                    if($post_status == 'published'){
                       
                       //  if($post_status !== 'published'){
                      //  echo "<h1 class='text-center'> Sorry, no additional current posts. </h1>";
                      //  continue 1;
                    //} else {

    
                 ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                


                <h2>  <!-- a href is dynamically populating and sending to the $post_id -->
                    <a href="post.php?p_id= <?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id= <?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image;?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id= <?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>




            <?php } } ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>           

        </div>
        <!-- /.row -->

        <hr>
                <!-- this was a test to see number of posts for pagination -->
        <!-- <h1><?php //echo $count; ?> </h1>   -->

        <ul class="pager">

        <?php 


            if($page !=1){
                $prev_page = $page-1;
                echo "<li><a href='index.php?page={$prev_page}'>PREV</a><li>";

            }



// dynamically creating pagination links at the bottom of the page

            for($i=1; $i <= $count; $i++) {

                if($i == $page || ($i == 1 && $page ==1)){

                              // get request sent via link and number value of $i to determine what posts to display

                              // add class 'active_link' to style the link
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a><li>"; 

                }else {
                           // get request sent via link and number value of $i to determine what posts to display
                echo "<li><a href='index.php?page={$i}'>{$i}</a><li>";
                }
                 
            }

            if($page !=$count){
                $next_page = $page+1;
                echo "<li><a href='index.php?page={$next_page}'>NEXT</a><li>";

            }


        ?>
        </ul>
              


    <!-- Footer -->
    <?php include "includes/footer.php";?>  