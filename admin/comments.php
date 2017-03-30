<?php include "includes/admin_header.php" /// header sent from header.php in admin includes folder 
?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php" /// header sent from nav.php in admin includes folder ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to Admin page
                            <small>Author</small>
                        </h1>


<?php                       
//switch statment, check if there is a value from $_GET,  set the value from $_GET to variable $source 
if(isset($_GET['source'])){
    $source = $_GET['source'];

} else {
    $source ='';
}
     //depending on value of $_GET that was assigned to the variable $source, will echo the matching case, if not will echo default. 
switch($source){

    case 'add_post';
        include "includes/add_comment.php";
    break;

    case 'edit_post';
        include "includes/edit_comment.php";
    break;

    case '300';
        echo "Nice 300";
    break;

    default:

    //include a default page
    include "includes/view_all_comments.php";

    break;
}

?>           







                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
   

        <!-- /#page-wrapper -->
        <!-- header sent from admin_footer.php in admin includes folder -->
        <?php include "includes/admin_footer.php" ?>

