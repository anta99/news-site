<?php
    require_once "models/news/function.php"; 
    $category=0;
    if(isset($_GET["cat"])){
        $predefineCat=true;
        $category=$_GET["cat"];
        $catArray[]=$category;
        $filteredNews=filterNews(1,$catArray);
    }
    else{
        $filteredNews=filterNews(1,[]);
    }   
?>
<main class="container-fluid">
    <h1 class="text-center p-3">Vesti</h1>
    <section class="container">
        <article class="row">
            <div class="col-12 p-3 ">
                <ul class="d-flex justify-content-center align-items-center flex-wrap" id="categoriesList">
                    <?php
                        $categories=getCategories();
                        foreach($categories as $cat):
                            if($cat["id"]==$category):
                    ?>
                    <li class="p-2 text-center categoryNews categoryActive m-1">
                        <a href="#" data-catid="<?=$cat["id"]?>"><?=$cat["naziv"]?></a>
                    </li>
                    <?php
                        else:
                    ?>
                    <li class="p-2 text-center categoryNews m-1">
                        <a href="#" data-catid="<?=$cat["id"]?>"><?=$cat["naziv"]?></a>
                    </li>
                    <?php
                        endif; 
                        endforeach;
                    ?>
                </ul>
            </div>
        </article>
    </section>
    <section class="row p-2" id="newsContainer">
        <!-- <?php
            if(!count($filteredNews["news"])):
        ?>
        <div class="col-12 noNews text-center">
            <h3 class="">Nažalost nema vest za izabrane kategorije</h3>
        </div>
        <?php
            else:
                foreach($filteredNews["news"] as $news):
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-1 p-lg-3 mb-2">
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
        </div>
        <?php
            endforeach;
        endif;
        ?> -->
    </section>
    <div class="row">
        <div class="col-12 my-3">
             <ul class="pagination pg-amber justify-content-center">
                <!-- <li class="page-item">
                <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
                <li class="page-item active"><a class="page-link">1</a></li>
                <li class="page-item"><a class="page-link">2</a></li>
                <li class="page-item"><a class="page-link">3</a></li>
                <li class="page-item">
                <a class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li> -->
                <!-- <?php
                    for($i=1;$i<=$filteredNews["pagesNumber"];$i++):
                        if($i==1):
                ?>
                <li class="page-item active"><a href="#categoriesList" class="page-link"><?=$i?></a></li>
                <?php
                    else:
                ?>
                <li class="page-item"><a href="#categoriesList" class="page-link"><?=$i?></a></li>
                <?php
                    endif;
                    endfor;
                ?> -->
            </ul>
        </div>
    </div>
   
</main>