<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo.png">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    
    <title>TeamHub</title>
    
    <link rel="stylesheet" type="text/css" href="assets/css/font.css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    
    <link href="assets/css/icon.css?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="assets/css/material-dashboard.min.css?v=3.0.6" rel="stylesheet" />

    <script src="assets/js/42d5adcbca.js"></script>

    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/core/jquery.min.js"></script>
</head>
<body class="bg-gray-200">
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('assets/img/ftmk.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-2">Sign In</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form name="hub" id="form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="form-check form-check-info text-end ps-0">
                                        <input class="form-check-input" type="checkbox" id="showPassword" onclick="do_password()">
                                        <label class="form-check-label" for="showPassword">
                                            Show Password
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2 btn-sign-in" onclick="do_login()">Sign in</button>
                                    </div>
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
    function do_password() {
        var showPassword = $('#showPassword').is(':checked');
        var password = $("#password");
        // alert(showPassword);
        if(showPassword == true) {
            password.attr("type", "text");
        } else {
            password.attr("type", "password");
        }
    }
    function do_login(){
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
                            text: "You have successfully log in!",
                            icon: "success"
                        }).then(function(){
                            window.location.href="index.php";
                        });
                    } else if(data == 'XADA') {
                        Swal.fire({
                            title: "Warning!",
                            text: "Your email is not registered to the system",
                            icon: "warning"
                        });
                        $('.btn-sign-in').prop("disabled",false);
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Your password is incorrect!",
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