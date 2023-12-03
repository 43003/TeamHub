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
</head>
<body class="bg-gray-200">
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1650&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-2">Reset Password</h4>
                                </div>
                            </div>
                            <div class="card-body pb-3">
                                <form name="hub" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn bg-gradient-primary w-100 mt-4 mb-0" onclick="do_send()">Send</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        Already have an account?
                                        <a href="signin.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-center">
                        <div class="col-12 col-md-6 my-auto">
                            <div class="copyright text-center text-sm text-white">
                                TeamHub © <script> document.write(new Date().getFullYear()) </script>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/sweetalert.min.js"></script>

    <script>
    function do_send(){
        var email = $('#email').val();
        var password = $('#password').val();
        
        if (email.trim() == '' || password.trim() == '') {
            Swal.fire({
                title: "Warning!",
                text: "Please fill the signin form!",
                icon: "warning"
            });
        } else {
            $.ajax({
                url: 'system_sql.php?pro=LOGIN',
                type: 'POST',
                beforeSend: function () {
                    $('.btn-sign-in').prop("disabled",true);
                },
                data: {email: email, password: password},
                success: function(data) {
                    if(data == 'OK') {
                        Swal.fire({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success"
                        });
                    } else if(data == 'XADA') {
                        Swal.fire({
                            title: "Warning!",
                            text: "Your email or password is incorrect!",
                            icon: "warning"
                        });
                        $('.btn-sign-in').prop("disabled",false);
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "There is an error in the server side!",
                            icon: "error"
                        });
                        $('.btn-sign-in').prop("disabled",false);
                    }
                }
            });
        }
    }
    </script>

    <script src="assets/js/material-dashboard.min.js?v=3.0.6"></script>
</body>
</html>