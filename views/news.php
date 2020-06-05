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