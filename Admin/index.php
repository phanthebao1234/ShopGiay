<?php 
    set_include_path(get_include_path().PATH_SEPARATOR.'Model/');
    spl_autoload_extensions('.php');// phần mở rộng
    spl_autoload_register();
    session_start();
    include 'Model/uploadImage.php';
    // include 'Content/PHPExcel';
    // include 'Model/export.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Shop Bán Giày</title>
    <?php 
        include 'View/link.php';
    ?>
</head>
<body>
<!-- <i class="fas fa-wrench"></i> -->
    <?php 
        if(isset($_SESSION['id'])) {
            include 'View/header.php';
            $ctrl = 'customer';
            if(isset($_GET['action'])) {
                $ctrl = $_GET['action'];
            }
            include 'Controller/'. $ctrl. '.php';
        } else {
            $ctrl = 'auth';
            if(isset($_GET['action'])) {
                $ctrl = $_GET['action'];
            }
            include 'Controller/auth.php';
        }
        // include 'View/footer.php';
    ?> 
    <scirpt src="Content/js/main.js"></scirpt>
    <script src="Content/js/sb-admin-2.min.js"></script>
    <script src="Content/js/bootstrap.bundle.min.js"></script>
    <script src="Content/js/jquery.easing.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="Content/js/chart-bar-demo.js"></script>
    <script src="Content/js/chart-area-demo.js"></script> -->
    <!-- Page level plugins -->
    <script src="Content/js/Chart.min.js"></script>
    <script src="Content/js/charts-loader.js"></script>
    <script src="Content/js/jquery.tagsinput.js"></script>
    <script src="Content/js/bootstrap-tagsinput.min.js"></script>
    <script src="Content/js/bootstrap-tagsinput.min.js"></script>
    <script src="Content/js/datatables.min.js"></script>
    <!-- <script src="Content/js/tinymce.min.js"></script>
    <script src="Content/js/theme.min.js"></script>
    <script src="Content/js/model.min.js"></script>
    <script src="Content/js/icons.min.js"></script> -->
    <!-- Page level custom scripts -->
    <!-- <script src="Content/js/chart-area-demo.js"></script>
    <script src="Content/js/chart-pie-demo.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script> -->

</body>
</html>