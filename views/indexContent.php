<main class="mb-3">
    <!-- Slider -->
    <section class="container-fluid">
        <div class="row">
            <article class="col-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    
                </div>
                <a class="carousel-control-prev strelica" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span><i class="fa fa-angle-left"></i></span>
                </a>
                <a class="carousel-control-next strelica" href="#carouselExampleControls" role="button" data-slide="next">
                    <span><i class="fa fa-angle-right"></i></span>
                </a>
                </div>
            </article>
        </div>
    </section>
    <section id="indexNews" class="container-fluid p-2 p-md-3 p-lg-5">
        <h1 class="">Najnovije vesti</h1>
         <article class="row">
            <section class="col-12 col-md-8 col-lg-8 col-xl-9">
                <article class="row" id="freshNews">
                    <?php
                        require_once "models/mainPage/function.php";
                        $freshNews=getFreshNews();
                        foreach($freshNews as $news):
                            $date=date("d/m/Y",strtotime($news["datum"]));
                    ?>
                    <div class="col-12 col-sm-9 col-md-6 col-xl-4 p-3 my-2">
                        <div class="card singleNewsContainer">
                            <a href="index.php?page=singleNews&id=<?=$news["id"]?>">
                                <img class="card-img-top img" src="assets/images/<?=$news["src"]?>" alt="<?=$news["alt"]?>" />
                            </a>
                            <span class="cat badge badge-secondary mt-4 ml-3"><?=$news["category"]?></span>
                            <div class="card-body">
                                <h2 class="card-title"><a href="index.php?page=singleNews&id=<?=$news["id"]?>"><?=$news["naslov"]?></a></h2>
                                <div class="news-details my-2 text-black-50">
                                    <span><i class="fa fa-calendar"></i>
                                    <?=$date?></span>
                                    <span><i class="fa fa-user mx-1"></i> <?=$news["author"]?></span>
                                </div>
                                
                                <p class="card-text text-truncate"><?=$news["tekst"]?></p>
                                <a href="index.php?page=singleNews&id=<?=$news["id"]?>" class="btn btn-primary d-block readNews">Pročitaj još</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>
                </article>
                </section>
                <!-- Side panel -->
                <section class="col-12 col-md-4 col-lg-4 col-xl-3 p-3">
                <article class="row">
                    <section class="col-12 sidePanel p-3 my-2">
                        <h2>Popularno</h2>
                        <?php
                            $popularNews=popularNews();
                            foreach($popularNews as $popular):
                        ?>
                        <article>
                            <a href="index.php?page=singleNews&id=<?=$popular["id"]?>" class="popularLink"><?=$popular["naslov"]?></a>
                        </article>
                        <!-- <article>
                            <a href="#" class="popularLink">Neverotatna vest-Senzacija (FOTO/VIDEO)</a>
                        </article> -->
                        <?php
                            endforeach;
                        ?>
                    </section>
                    <section class="col-12 sidePanel p-3 my-2">
                        <h2>Društevene mreze</h2>
                        <article class="row ">
                            <div class="col-12 text-center socialMedia">
                                <a href="#" class=""><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                           
                                
                        </article>
                    </section>
                    <div class="col-12 sidePanel p-3 my-2">
                        <h2>Anketa</h2>
                        <div>
                            <h3>Vasa omlijena drustvena mreza?</h3>
                            <div>
                                <input type="checkbox" name="anketaOdg"/>
                                <label for="">Facebook</label>
                            </div>
                            <div>
                                <input type="checkbox" name="anketaOdg"/>
                                <label for="">Instagram</label>
                            </div>
                            <div>
                                <input type="checkbox" name="anketaOdg"/>
                                <label for="">Twitter</label>
                            </div>
                            <div>
                                <input type="checkbox" name="anketaOdg"/>
                                <label for="">Neka druga</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 sidePanel p-3 my-2">
                        <h2>Pišite nam</h2>
                    </div>
                </article>
            </section>
        </article>
    </section>
</main>