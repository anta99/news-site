<?php
    if(isset($_GET["tag"])){
        require_once "models/tagNews/function.php";
        $tag=$_GET["tag"];
        $news=getNewsByTags($tag);
    }
    else{
        header("Location:index.php?page=404");
    }
?>
<main class="container-fluid">
    <section class="row">
        <div class="col-12 p-0 p-md-3">
            <h1 class="text-center">Pretraga: <?=$news["tag"][0]["naziv"]?></h1>
            <h2 id="tagNewsCount" class="text-muted">Rezultati:<?=count($news["news"])?></h2>
        </div>
    </section>
    <section class="row">
        <?php
            if(!$news):
        ?>
        <article class="col-12 noNews text-center">
            <h3 class="">Došlo je do greške.</h3>
            <h3 class="">Molimo vas pokušajte kasnije</h3>
        </article>
        <?php
            else:
                foreach($news["news"] as $news):
        ?>
        <article class="col-12 col-sm-6 col-md-4 col-lg-3 p-1 p-lg-3 mb-2">
            <div class="card singleNewsContainer">
                <a href="index.php?page=singleNews&id=<?=$news["id"]?>">
                    <img class="card-img-top img" src="assets/images/<?=$news["src"]?>" alt="<?=$news["naslov"]?>" />
                </a>
                <span class="cat badge badge-secondary mt-4 ml-3"><?=$news["category"]?></span>
                <div class="card-body">
                    <h2 class="card-title"><a href="index.php?page=singleNews&id=<?=$news["id"]?>"><?=$news["naslov"]?></a></h2>
                    <div class="news-details my-2 text-black-50">
                        <span><i class="fa fa-calendar"></i>
                        <?=$news["datum"]?></span>
                        <span><i class="fa fa-user mx-1"></i> <?=$news["author"]?></span>
                    </div>
                    <p class="card-text text-truncate"><?=$news["tekst"]?></p>
                    <a href="index.php?page=singleNews&id=<?=$news["id"]?>" class="btn btn-primary d-block readNews">Pročitaj još</a>
                </div>
            </div>
        </article>
        <?php
            endforeach;
        endif;
        ?>
    </section>
</main>