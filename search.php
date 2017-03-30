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
  

            if(isset($_POST['submit'])){
            
                $search = $_POST['search']; //data from search assigned to $search
                //echo $_POST['search']; //see and display data that is searched
            //$_POST['search']; //catch data that is posted

        //query to look for information from $search variable in database post tags
        // LIKE our search variable
            $query="SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";

            $search_query = mysqli_query($connection,$query);
                // if statement to check if query is working or not
                if(!$search_query){
                    die("Query FAILED" . mysqli_error($connection));
                }
                //testing to see if there is any results
                $count = mysqli_num_rows($search_query);
                    if($count == 0){
                        echo"<hr> No Result </h1>";
                    } else{

                       // echo"some results";   
                    
// next 4 lines removed to allow for only results to show of a search.. 3 lines were redundant from above, edited while loop to use variable $search_query from above
           // $query = "SELECT * FROM posts";
          //   $select_all_posts_query = mysqli_query($connection,$query);
                // this while loop is dynamically updating posts
              //  while($row = mysqli_fetch_assoc($select_all_posts_query)){


                while($row = mysqli_fetch_assoc($search_query)){
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
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>




            <?php  } 

                    }

            } ?>




            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>           

        </div>
        <!-- /.row -->

        <hr>
    <!-- Footer -->
    <?php include "includes/footer.php";?>  