<?php 
$tahun=strtoupper(isset($_REQUEST["tahun"])?$_REQUEST["tahun"]:"");
// print $tahun;
if(empty($tahun)){ $tahun=date("Y"); }
if(empty($menu)){ $menu = 'TAHUN'; }
if($menu=='TAHUN'){ $disp_menu = "TAHUN ".$tahun; }
else { $disp_menu = $menu; }
?>
            <div class="container-fluid py-4">
<?php 
// print $pages.":".$module.":".$menu.":".$submenu.":".$actions.":".$id.":".$id2; 
if(empty($pages)){ $pages = 'lecturer/dashboard/index.php'; }

if (file_exists($pages.".php")) {
    include $pages.".php";
} else if (file_exists($pages)) {
    include $pages;
} else { 			
    include "error_404.php";
}
?>						
<?php //print $disp_pages; ?>


