<?php
    if(!isset($_GET["id"])){
        header("Location:index.php?page=notFound");
    }
    else{
        $newsId=$_GET["id"];
        //echo $newsId;
    }
?>
<section class="container-fluid">
    <div class="row">
            <?php
                require_once "models/singleNews/function.php";
                //$singleNews=getNews($newsId);
                $tags=getTags($newsId);
                //writeNews($newsId);
            ?>
        <article class="col-12 mx-auto">
        <img src="assets/images/<?=$news["src"]?>" alt="<?=$news["alt"]?>" class="img" />
        </article>
        <article class="container">
        <span class="cat badge badge-secondary mt-4 ml-3 text-right"><?=$news["category"]?></span>
        <div class="col-12">
            <h1 class="text-center"><?=$news["naslov"]?></h1>
            <div class="news-details my-2 text-black-50 text-center">
                <span><i class="fa fa-calendar">
                </i><?=date("d/m/Y",strtotime($news["datum"]))?></span>
                    <span><i class="fa fa-user mx-1"></i> <?=$news["author"]?></span>
            </div>
                <p><?=$news["tekst"]?></p>
                <span class="mt-5 d-inline-block">Tagovi:</span>
                <ul class="d-inline">
                <?php
                    foreach($tags as $tag):
                ?>
                <li class="cat d-inline mr-2"><a href="index.php?page=tagNews&tag=<?=$tag["id"]?>"><?=$tag["naziv"]?></a></li>

                <?php
                    endforeach;
                ?>
                </ul>
        </div>
            <!-- Komentari -->
            <div class="col-12 my-3 ">
                <input type="hidden" id="newsId" value="<?=$newsId?>" />
                <h2 class="border-bottom py-2">Komentari 
                <span class="comCount">
                    <?php
                        $count=countComments($newsId);
                    ?>
                    (<?=$count[0]["count"]?>)
                </span>
                
                </h2>
                
                <div id="newComment">
                    <button id="newCommentButton" class="buttonCustom btn" data-commtype="newComment" <?php if(!$logged){echo "disabled='disabled'";}?>>Dodaj komentar</button>
                    <?php
                        if(!$logged):
                    ?>
                    <span class="d-block text-muted font-italic">Morate biti prijavljeni da biste komentarisali</span>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
            <!-- Ispis komentara -->
            <div class="row" id="commentSection">
                <?php
                    $comments=getComments($newsId);
                    foreach($comments as $comment):
                ?>
                <div class="commentHolder col-12" data-parentid="<?=$comment["id"]?>">
                    <div class="position-relative p-3 mb-2 comment">
                        <span class="font-weight-bold"><?=$comment["username"]?></span>
                        <span class="comDate position-absolute"><?=date("d/m/Y H:i",strtotime($comment["datum"]))?></span>
                        <?php
                            if($admin):
                        ?>
                        <span class="deleteComm position-absolute" data-commentid="<?=$comment["id"]?>"><i class="fa fa-times"></i></span>
                        <?php
                            endif;
                        ?>
                        <p class="mt-3"><?=$comment["tekst"]?></p>
                        <button class="btn buttonCustom btnReply mb-3" <?php
                        if(!$logged){echo "disabled='disabled'";}?>>Odgovori</button>
                    </div>
                    <?php
                        if($comment["roditelj_id"]==NULL):
                            $replies=getReplies($comment["id"]);
                           
                    ?>
                     <div class="repliesHolder">
                        <?php
                             foreach($replies as $reply):
                        ?>
                        <div class="position-relative p-3 mb-2 comment reply">
                            <span class="font-weight-bold"><?=$reply["username"]?></span>
                            <span class="comDate position-absolute"><?=date("d/m/Y H:i",strtotime($reply["datum"]))?></span>
                            <?php
                                if($admin):
                            ?>
                            <span class="deleteComm position-absolute" data-commentid="<?=$comment["id"]?>"><i class="fa fa-times"></i></span>
                            <?php
                                endif;
                            ?>
                            <p class="mt-3"><?=$reply["tekst"]?></p>
                        </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
                <?php
                    endforeach;
                ?>
               
               <!-- Comment with replies -->
                <!-- <div class="commentHolder col-12">
                     <div class="position-relative p-3 mb-2 comment">
                        <span class="font-weight-bold">Korisnik</span>
                        <span class="comDate position-absolute">07-May-2020 12:00:00</span>
                        <p class="mt-3">Ovo je neki tamo komentar3</p>
                        <button class="btn buttonCustom btnReply">Odgovori</button>
                    </div>
                    <div class="repliessHolder">
                        <div class="position-relative p-3 mb-2 comment reply">
                            <span class="font-weight-bold">Korisnik</span>
                            <span class="comDate position-absolute">07-May-2020 12:00:00</span>
                            <p class="mt-3">Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometarOvo je neki tamo odgovor na kometar</p>
                        </div>
                        <div class="position-relative p-3 mb-2 comment reply">
                            <span class="font-weight-bold">Korisnik</span>
                            <span class="comDate position-absolute">07-May-2020 12:00:00</span>
                            <p class="mt-3">Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometarOvo je neki tamo odgovor na kometar</p>
                        </div>
                    </div>
                </div> -->
               
              
                
            </div>
            <!-- Kraj komentara -->
            <!-- Povezane vesti -->
            <div class="row relatedNews" id="relatedNews">
                <div class="col-12">
                    <h2>Procitajte i ovo</h2>
                </div>
                <div class="col-12 col-md-5 col-lg-3 p-3">
                    <img src="naslov.jpg" alt="" class="img" />
                    <h4><a href="#">Ovo je jos jedna vest povezana sa ovom</a></h4>
                </div>
                <div class="col-12 col-md-5 col-lg-3 p-3">
                    <img src="naslov.jpg" alt="" class="img" />
                    <h4><a href="#">Ovo je jos jedna vest povezana sa ovom</a></h4>
                </div>
                <div class="col-12 col-md-5 col-lg-3 p-3">
                    <img src="naslov.jpg" alt="" class="img" />
                    <h4><a href="#">Ovo je jos jedna vest povezana sa ovom</a></h4>
                </div>
                <div class="col-12 col-md-5 col-lg-3 p-3">
                    <img src="naslov.jpg" alt="" class="img" />
                    <h4><a href="#">Ovo je jos jedna vest povezana sa ovom</a></h4>
                </div>
            </div>
             <!-- Kraj povezanih vesti -->
        </article>
    </div>
</section>