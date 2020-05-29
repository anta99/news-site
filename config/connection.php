<?php
    require_once "config.php";
    try{
        $conn=new PDO("mysql:host=".HOST.";dbname=".DBNAME.";",USERNAME,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'"));
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Veza sa bazom nije moguca";
        exit;
    }
    function executeQuery($query){
        global $conn;
        $result=$conn->query($query)->fetchAll();
        return $result;
    }
    function getCategories(){
        $catQuery="SELECT * FROM kategorije";
        return executeQuery($catQuery);
    }
?>