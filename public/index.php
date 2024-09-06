<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../assets/img/favicon.png" type="image/png" />
    <title>Weather App</title>

    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/fonts/font.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/jquery-confirm.css" rel="stylesheet">
    <link href="../assets/datatables/datatables.min.css" rel="stylesheet" type="text/css">

    <link rel="icon" href="img/logo/icon.jpg">

</head>

<body id="main">

    <div id="login_container">
        <?php 
        $operation = ISSET($_REQUEST['l']) ? $_REQUEST['l'] : 0;
        if($operation == 0){
            include('../app/views/login/login.view.php');
        } else {
            include('../app/views/register/register.view.php');
        }
        ?>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->

    <script src="../assets/js/scripts.global.js"></script>
    <script src="../assets/js/jquery-confirm.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!--Bootstrap-->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <!--DataTable-->
    <script type="text/javascript" src="../assets/datatables/datatables.min.js"></script>

</body>

</html>