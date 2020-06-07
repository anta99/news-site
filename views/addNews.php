<?php
    $update=false;
    if(!$author && !$admin){
        header("Location:index.php?page=authorization");
    }
    else{
        if(isset($_GET["updateid"])){
            $updateId=$_GET["updateid"];
            $update=true;
        }
    }
?>
<main>
    <section class="container text-center p-5">
        <?php
            if($update):
        ?>
        <h1>Izmena vesti</h1>
        <?php
            else:
        ?>
        <h1>Dodavanje vesti</h1>
        <?php
            endif;
        ?>
        <div class="row p-1 p-md-5">
            <article class="col-12 col-md-8 mx-auto">
                <form action="" method="POST" id="addNews" name="addNews" enctype="multipart/form-data">
                    <div class="mt-4">
                        <label for="addNewsHeader" class="text-left">Naslov</label>
                        <input type="text" class="form-control clearFocus" id="newsHeader" name="newsHeader" />
                        <p></p>
                    </div>
                    <div class="mt-4">
                        <label for="">Kategorija</label>
                        <select name="newsCat" id="newsCat" class="browser-default custom-select clearFocus">
                            <option value="0">Izaberite kategoriju</option>
                            <?php
                                $categories=getCategories();
                                foreach($categories as $cat):
                            ?>
                            <option value="<?=$cat["id"]?>"><?=$cat["naziv"]?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        <p class="text-danger"></p>
                    </div>
                    <div class="mt-4">
                        <label for="">Autor</label>
                        <select name="newsAuthor" id="newsAuthor" class="browser-default custom-select clearFocus">
                            <option value="0">Izaberite autora</option>
                            <?php
                                require_once "models/admin/function.php";
                                $authors=getAllAuthors();
                                foreach($authors as $author):
                            ?>
                            <option value="<?=$author["id"]?>"><?=$author["name"]?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        <p class="text-danger"></p>
                    </div>
                    <div class="mt-4">
                        <label for="newsDesc">Kratki opis</label>
                        <textarea type="text" class="p-2 clearFocus textareaCustom" id="newsDesc" rows="5" name="newsDesc"></textarea>
                        <p></p>
                    </div>
                    <div class="mt-4">
                        <label for="newsText">Tekst vesti</label>
                        <textarea type="text" class="p-2 clearFocus textareaCustom" id="newsText" rows="10" name="newsText"></textarea>
                        <p></p>
                    </div>
                    <div class="mt-4" id="tagsDiv">
                        <div class="tagsDdlDiv">
                            <label for="" class="d-block">Tagovi</label>
                            <select name="tagsDdl" class="browser-default custom-select clearFocus tagsDdl">
                                <option value="0">Izaberite tag</option>
                                <?php
                                    $allTags=getAllTags();
                                    foreach($allTags as $tag):
                                ?>
                                <option value="<?=$tag["id"]?>"><?=$tag["naziv"]?></option>
                                <?php
                                    endforeach;
                                ?>
                            </select>
                        </div>
                        
                        <div id="newTags"></div>
                        <button type="button" id="moreTagsBtn" class="btn buttonCustom">Dodaj još</button>
                        <button type="button" id="newTagsBtn" class="btn buttonCustom">Napravi novi tag</button>
                        <p class="text-danger"></p>
                    </div>
                    <div class="mt-4">
                        <label for="" class="d-block">Slika</label>
                        <input type="file" name="newsImg" id="newsImg"  />
                        <p class="text-danger"></p>
                    </div>
                    <button type="button" id="addNewNews" name="addNewNews" class="btn buttonCustom mt-5">Dodaj vest</button>
                </form>
            </article>
        </div>
    </section>
</main>