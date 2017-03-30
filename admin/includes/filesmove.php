<?php

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 ){
                        // using superglobal $_FILES
                    $post_image= $_FILES['image']['name']; 
                    // saves image to temporary location to be used later by calling variable $post_image_temp
                    $post_image_temp = $_FILES['image']['tmp_name']; 

            } else{

                echo ' error in image file uploaded by create_post';
            }











if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 ){
                //function form images,  with two parameters.  moves image or file from the temporary location ($post_image_temp) to the location we want (images/...)
                move_uploaded_file($post_image_temp, "../images/$post_image");
                 // if error check and make sure the folder has read and write options, set properties security and permissions 

        } else{

            echo ' error in image moved by move_uploaded_file';
        }

        //var_dump($post_image_temp);