<?php include "includes/header.php"; ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation_bar.php"; ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            All Posts
                            <!-- <small>Subheading</small> -->
                        </h1>
                        <?php 
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }
                            else{
                                $source = "";
                            }
                            switch($source){
                                case 'add_post':
                                include "includes/add_post.php";
                                    break;
                                default:
                                    include "includes/all_posts.php";
                                    break;
                            }
                        ?>
                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/footer.php"; ?>