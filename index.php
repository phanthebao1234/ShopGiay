<?php
    include 'Model/cart.php';
    set_include_path(get_include_path().PATH_SEPARATOR.'Model/');
    spl_autoload_extensions('.php');// phần mở rộng
    spl_autoload_register();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán Giày</title>
    <?php
        include 'View/link.php';
    ?>
    
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <div class="container-fluid">
    
        <!-- header -->
        <?php
            include "View/header2.php";
        ?>

        <!-- main -->
        <?php
            $ctrl = 'home';
            if(isset($_GET['action'])) {
                $ctrl = $_GET['action'];
            }
            include 'Controller/'. $ctrl. '.php';
        ?>

        <!-- footer -->
        <?php
            include 'View/footer.php';
        ?>
    </div>
    <script src="Content/js/owl.carousel.min.js"></script>
    <!-- <script src="node_modules/readmore-js/readmore.min.js"></script> -->
</body>
</html>