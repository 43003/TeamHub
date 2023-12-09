        <?php
        if ($_SESSION['SESS_TYPE']=='P') {
            $dir='student';
        } else if($_SESSION['SESS_TYPE']=='S'){
            $dir='lecturer';
        }
        if(empty($pages)){ $pages = $dir.'/dashboard/index.php'; }
        // print $pages;
        ?>

        <script>
        function do_password(){
            $('.modal .modal-content').load('change_password.php')
        }
        </script>

        <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
            <div class="sidenav-header">
                <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
                <a class="navbar-brand m-0" href="index.php">
                    <img src="assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                    <span class="ms-1 font-weight-bold text-white">TeamHub</span>
                </a>
            </div>
            <hr class="horizontal light mt-0 mb-2">
            <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
                <ul class="navbar-nav">               
                    <li class="nav-item">
                        <a class="nav-link <?php if($pages==$dir.'/dashboard/index.php'){ print 'active';}?>" href="index.php">
                            <i class="material-icons-round">dashboard</i>
                            <span class="nav-link-text ms-2 ps-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">COURSE</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($pages==$dir.'/course/index.php'){ print 'active'; }?>" 
                            href="index.php?data=<?php print base64_encode($dir.'/course/index.php;;Courses;;;;'); ?>">
                            <i class="material-icons-round">bookmark</i>
                            <span class="nav-link-text ms-2 ps-1">Courses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($pages==$dir.'/assessment/index.php'){ print 'active'; }?>" 
                            href="index.php?data=<?php print base64_encode($dir.'/assessment/index.php;;Assessments;;;;'); ?>">
                            <i class="material-icons-round">analytics</i>
                            <span class="nav-link-text ms-2 ps-1">Assessments</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder text-white">STUDENT</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($pages==$dir.'/student/index.php'){ print 'active'; }?>" 
                            href="index.php?data=<?php print base64_encode($dir.'/student/index.php;;Students;;;;'); ?>">
                            <i class="material-icons-round">badge</i>
                            <span class="nav-link-text ms-2 ps-1">Students</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($pages==$dir.'/team/index.php'){ print 'active'; }?>" 
                            href="index.php?data=<?php print base64_encode($dir.'/team/index.php;;Teams;;;;'); ?>">
                            <i class="material-icons-round">groups</i>
                            <span class="nav-link-text ms-2 ps-1">Teams</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder text-white">REPORT</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($pages==$dir.'/report/index.php'){ print 'active'; }?>" 
                            href="index.php?data=<?php print base64_encode($dir.'/report/index.php;;Reports;;;;'); ?>">
                            <i class="material-icons-round">summarize</i>
                            <span class="nav-link-text ms-2 ps-1">Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <hr class="horizontal light" />
                        <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder text-white">SETTINGS</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($pages==$dir.'/profile/index.php'){ print 'active'; }?>" 
                            href="index.php?data=<?php print base64_encode($dir.'/profile/index.php;;Profile;;;;'); ?>">
                            <i class="material-icons-round">manage_accounts</i>
                            <span class="nav-link-text ms-2 ps-1">Manage Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;" data-bs-toggle="modal" data-bs-target="#myModal" onclick="do_password()">
                            <i class="material-icons-round">key</i>
                            <span class="nav-link-text ms-2 ps-1">Change Password</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="material-icons-round">logout</i>
                            <span class="nav-link-text ms-2 ps-1">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>