<div class="container-fluid py-4">
<?php 
print $pages.":".$module.":".$menu.":".$submenu.":".$actions.":".$id.":".$id2;
if (file_exists($pages.".php")) {
    include $pages.".php";
} else if (file_exists($pages)) {
    include $pages;
} else { 			
    include "error_404.php";
}
?>