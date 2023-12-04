<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    
    <title>TeamHub</title>
    
    <link rel="stylesheet" type="text/css" href="assets/css/font.css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="assets/js/42d5adcbca.js"></script>
    <link href="assets/css/icon.css?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="assets/css/material-dashboard.min.css?v=3.0.6" rel="stylesheet" />

    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/core/jquery.min.js"></script>
</head>
<body class="bg-gray-200">
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('assets/img/ftmk1.jpg');">
            <?php 
            session_start();
            session_destroy();
            $_SESSION['SESS_UID']='';
            ?>
        </div>
    </main>

    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/sweetalert.min.js"></script>

    <script>
    Swal.fire({
        title: 'Good job!',
        text: 'You successfully loged out from the system.',
        icon: 'success',
    }).then(function () {
        window.location.href = "index.php";
    });
    </script>

    <script src="assets/js/material-dashboard.min.js?v=3.0.6"></script>
</body>
</html>