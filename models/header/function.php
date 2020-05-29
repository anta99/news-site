<?php
    $navQuery="SELECT * FROM navigacija ORDER BY prioritet";
    $catQuery="SELECT * FROM kategorije";
    $nav=executeQuery($navQuery);
    $categories=executeQuery($catQuery);
    function getMenuItems(){
        global $navQuery;
        return executeQuery($navQuery);
    }
    // function getCategories(){
    //     global $catQuery;
    //     return executeQuery($catQuery);
    // }
?>



