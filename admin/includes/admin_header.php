<?php 
ob_start(); 
// output buffering start.. buffers for function header() so everything can be sent together at the same time. 
session_start();

?> 
<?php include "functions.php"; ?>
<?php include "../includes/db.php"; ?>

<?php

/* updated for adding sessions
// checking the user role sent from the login session
    if(isset($_SESSION['user_role'])){

    // removed when adding $_SESSION requirement below this 
        if($_SESSION['user_role'] !== 'admin') {
            header("Location:  ../index.php");
        }
        
    } */

//updated to see if session is not set, checking the user role sent from the login session
    // if session is not set... redirect to index.php
    // example of preventing user that isn't authorized
    if(!isset($_SESSION['user_role'])){

            header("Location:  ../index.php");
        
        
    }



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- page loader css style sheet-->
    <link href="css/styles.css" rel="stylesheet">

    <!-- graph from google -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 

    <!-- tinymce.com -->
    
    <script src="http://cloud.tinymce.com/stable/tinymce.min.js"></script> <!-- imports it from the internet -->
    
</head>

<body>