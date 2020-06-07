<?php
    if(!$admin){
        header("Location:index.php?page=authorization");
    }
?>
<main>
    <section class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- <h1 class="text-center">Korisnički profil</h1> -->
                <ul class="nav nav-tabs nav-justified md-tabs" id="myTabJust" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#adminNav" role="tab">Navigacija</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#adminUser" role="tab">Korisnici</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="models/authorization/logout.php" role="tab"
                        >Odjavi se</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="container-fluid p-1 p-md-5 minHeight">
        <div class="row">
            <div class="col-12 text-center">
                <div class="tab-content card tabs" id="adminTabs">
                    <!--  -->
                    <div class="tab-pane fade show active py-0 py-md-3" id="adminNav" role="tabpanel">
                        <h1>Vesti</h1>
                        <div class="table-responsive">
                            <table class="table mt-2 table-hover">
                            <thead class="black white-text">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Naslov</th>
                                    <th scope="col">Kategorija</th>
                                    <th scope="col">Autor</th>
                                    <th scope="col">Datum</th>
                                    <th scope="col">Opcije</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                require_once "models/news/function.php";
                                $getTableContent=filterNews(1,[]);
                                $allNews=$getTableContent["news"];
                                foreach($allNews as $news):
                            ?>
                                <tr>
                                    <th scope="row"><?=$news["id"]?></th>
                                    <td><?=$news["naslov"]?></td>
                                    <td><?=$news["category"]?></td>
                                    <td><?=$news["author"]?></td>
                                    <td><?=$news["datum"]?></td>
                                    <td>
                                        <a href="index.php?page=addNews&updateid=<?=$news["id"]?>" class="updateNewsLink changeNewsLinks ml-2">Izmeni</a>
                                        <a href="#" class="deleteNewsLink changeNewsLinks ml-2" data-deleteid="<?=$news["id"]?>">Obriši</a>
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                            </tbody>
                            </table>
                            <ul class="pagination pg-amber justify-content-center my-5">
                                <?php
                                    $pageNumber=$getTableContent["pagesNumber"];
                                    for($i=1;$i<=$pageNumber;$i++):
                                        if($i==1):
                                ?>
                                <li class="page-item active"><a href="#" class="page-link linkAdmin"><?=$i?></a></li>
                                <?php
                                    else:
                                ?>
                                <li class="page-item"><a href="#" class="page-link linkAdmin"><?=$i?></a></li>
                                <?php
                                    endif;
                                endfor;
                                ?>
                            </ul>
                            <div class="text-left">
                                <a href="index.php?page=addNews" class="btn buttonCustom">Dodaj vest</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="adminUser" role="tabpanel">
                        Ovde menjam korisnike
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>