<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        require_once "views/seo.php";
        if($page=="singleNews"):
            $newsId=$_GET["id"];
            $news=getNews($newsId);
    ?>
    <title><?=$news["naslov"]?> - Glasnik portal</title>
    <meta name="keywords" content="<?=$news["category"]?>,vest,glasnik,komentari" />
    <meta name="description" content="<?=$news["opis"]?>" />
    <?php
        else:
    ?>
    <title><?=$$page["title"]?></title>
    <meta name="keywords" content="<?=$$page["keywords"]?>" />
    <meta name="description" content="<?=$$page["description"]?>" />
    <?php
        endif;
    ?>
    <!-- Core Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>