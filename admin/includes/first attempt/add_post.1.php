Hello???? Is this on?
<?php

        //  enctype will help be in charge of sending different form data
       
  
    if(isset($_POST['create_post'])){
        //echo $_POST['title']; was used for testing to see if ['title'] can be echo'ed when submitted
       
        // testing if information is being submitted by create_post
       // echo 'The create_post submission is sending data';
        //var_dump($_POST['create_post']);
       // var_dump($_POST);
   


        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
            //var_dump($post_category_id);
        $post_status = $_POST['post_status'];

        // using superglobal $_FILES
        $post_image= $_FILES['image']['name']; 


        // saves image to temporary location to be used later by calling variable $post_image_temp
        $post_image_temp = $_FILES['image']['tmp_name']; 

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        //function for date format to send day/month/year
        $post_date = date('d-m-y'); 

        // currently assigned, but needs to be dynamic
        $post_comment_count = 4; 

    
    
        //function form images,  with two parameters.  moves image or file from the temporary location ($post_image_temp) to the location we want (images/...)
            move_uploaded_file($post_image_temp, "../images/$post_image");
                        // if error check and make sure the folder has read and write options, set properties security and permissions 

                        

      //  print_r($_FILES);
      //  var_dump($_FILES);
    

 $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    
$query .= "VALUES( '{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}' ) "; 


        $create_post_query = mysqli_query($connection, $query);  

                    // move to admin/functions.php 
                // if(!$create_post_query){
                //     die("QUERY FAILED" . mysqli_error($connection));
                // }
            
                     confirmQuery($create_post_query);
                    
    //var_dump($create_post_query);

}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category ID</label></br>
            <select name="post_category" id="">

                <?php
                    $query = "SELECT * FROM categories" ;
                        $select_categories = mysqli_query($connection,$query);
                                        // query for update variable 

                        confirmQuery($select_categories);

                        while($row = mysqli_fetch_assoc($select_categories)){
                            $cat_id = $row['cat_id']; // cat_id is the name of the column in database
                            $cat_title = $row['cat_title'];

                         echo "<option value='{$cat_id}'>{$cat_title}</option>";

                        }

                ?>

            </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
            <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
            <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
            <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags">
    </div>    

    <div class="form-group">
        <label for="post_content">Post content</label>
            <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>

    </form>