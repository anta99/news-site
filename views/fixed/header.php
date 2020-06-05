<header class="container-fluid p-0">
    <nav class="row">
        <div class="col-1 p-2">
            <a href="index.php">
              <img src="assets/images/logoNovi.png" alt="Glasnik portal logo" />
            </a>
            </div>
            <div class="col-12 col-lg-7 p-3 d-none d-lg-block menu">
                <ul>
                    <?php
                        require_once "models/header/function.php";
                        $nav=getMenuItems();
                        $categories=getCategories();
                        foreach($nav as $item):
                          if($item["naziv"]=="Vesti"):
                    ?>
                    <li class="position-relative newsItem"><a href="<?=$item["link"]?>"><?=$item["naziv"]?> <i class='fa fa-angle-down'></i></a>
                    <ul id='submenu'>
                    <?php
                        foreach($categories as $cat):
                    ?>
                    <li><a href="index.php?page=news" data-catid="<?=$cat["id"]?>"><?=$cat["naziv"]?></a></li>
                    <?php
                        endforeach;
                    ?>
                    </ul></li>
                    <?php
                        else:
                    ?>
                    <li><a href="<?=$item["link"]?>"><?=$item["naziv"]?></a></li>
                    <?php
                        endif;
                    endforeach;
                    if($admin):
                    ?>
                    <li><a href="index.php?page=adminPanel">Admin panel</a></li>
                    <?php
                    elseif($author):
                    ?>
                    <li><a href="index.php?page=addNews">Dodaj vest</a></li>
                    <?php    
                    endif;
                    ?>
                    <li><a href='#' id='closeBtn'><i class='fa fa-times'></i></a></li>
                </ul>
            </div>
            <div class="col-11 text-right d-block d-lg-none res">
                <i class="fas fa-search mr-2 searchBtn" aria-hidden="true"></i>
                <!-- <i class="fa fa-user mx-1" data-toggle="modal" data-target="#modalLRForm"></i> -->
                <i class="fa fa-bars resMenu"></i>
            </div>
            <div class="col-12 col-lg-4 searchMenu text-right d-lg-block d-none px-md-5 px-0">
               <form class="" method="GET" action="" id="menuForm">
                    <input class="" id="menuSearch" type="text" placeholder="Pretraga" title="Unesite bar 3 slova za pretragu" />
                    <i class="fas fa-search ml-2" aria-hidden="true"></i>
                    <!-- <i class="fa fa-user ml-3 d-none d-lg-block" id="userIcon" data-toggle="modal" data-target="#modalLRForm"></i> -->
                    <div id="searchResult" class="d-none text-center">
                      <ul>
                        
                      </ul>
                    </div>
                </form>
            </div>     
    </nav>
</header>
