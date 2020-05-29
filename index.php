<?php
    ob_start();
    require_once "config/connection.php";
    require_once "views/fixed/head.php";
    require_once "views/fixed/header.php";
    if(isset($_GET["page"])){
        $page=$_GET["page"];
        require_once "views/$page.php";
    }
    else{
        require_once "views/indexContent.php";
    }
    
    require_once "views/fixed/footer.php";
?>
