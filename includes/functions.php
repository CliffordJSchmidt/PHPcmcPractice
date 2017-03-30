<?php

    // function saved from add_post.php
function confirmQuery($result){

    global $connection;

    if(!$result){
                    die("QUERY FAILED ." . mysqli_error($connection));
                }
               
}






?>