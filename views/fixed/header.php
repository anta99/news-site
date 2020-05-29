<header class="container-fluid p-0">
    <nav class="row">
        <div class="col-1 p-2">
            <img src="logo.png" alt="logo" />
            <!-- <h1>Ovde ide logo</h1> -->
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
                    <li class="position-relative"><a href="<?=$item["link"]?>"><?=$item["naziv"]?> <i class='fa fa-angle-down'></i></a>
                    <ul id='submenu'>
                    <?php
                        foreach($categories as $cat):
                    ?>
                    <li><a href="index.php?page=news&cat=<?=$cat["id"]?>"><?=$cat["naziv"]?></a></li>
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
                    ?>
                    <li><a href='#' id='closeBtn'><i class='fa fa-times'></i></a></li>
                </ul>
            </div>
            <div class="col-11 text-right d-block d-lg-none res">
                <i class="fas fa-search mr-2 searchBtn" aria-hidden="true"></i>
                <i class="fa fa-user mx-1" data-toggle="modal" data-target="#modalLRForm"></i>
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
    <!--Modal: Login / Register Form-->
<!-- <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
      <div class="modal-c-tabs">
        <ul class="nav nav-tabs md-tabs tabs-2" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
              Prijava</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
              Registracija</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
            <div class="modal-body mb-1">
                <form class="text-center p-5" method="POST" action="" id="logInForm" name="logInForm">
                    <p class="h4 mb-4">Prijavi se</p>
                    <input type="text" id="logMail" name="logMail" class="form-control mt-2 clearFocus" placeholder="E-mail" />
                    <p class="text-danger"></p>
                    <input type="password" id="logPass" name="logPass" class="form-control mt-4 clearFocus" placeholder="Lozinka" />
                    <p class="text-danger"></p>
              </form>
              <div class="text-center mt-2">
                <button class="btn btn-info buttonCustom logBtn">Prijavi se</button>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn waves-effect ml-auto closeBtn" data-dismiss="modal">Zatvori</button>
            </div>

          </div>
          <div class="tab-pane fade" id="panel8" role="tabpanel">
            <div class="modal-body">
             <form class="text-center p-5" method="POST" action="" id="regForm" name="regForm">
                    <p class="h4 mb-4">Registruj se</p>
                    <input type="text" id="regUserName" name="regUserName" class="form-control my-2 clearFocus" placeholder="Korisničko ime" />
                    <p class=" text-danger"></p>
                    <input type="text" id="regMail" name="regMail" class="form-control mt-2 clearFocus" placeholder="E-mail" />
                    <p class=" text-danger"></p>
                    <input type="password" id="regPass" name="regPass" class="form-control mt-4 clearFocus" placeholder="Lozinka" />
                    <p class=" text-muted">Lozinka mora imati najmanje 8 karaktera</p>
                    <input type="password" id="confPass" name="confPass" class="form-control mt-4 clearFocus" placeholder="Potvrdite lozinku" />
                    <p class=" text-danger"></p>
                    <label for="terms">Prihvatam uslove korišćenja</label>
                    <input type="checkbox" id="terms" name="terms" value="prihvatio"/>
                    <p class="text-danger"></p>
              </form>

              <div class="text-center form-sm mt-2">
                <button class="btn btn-info buttonCustom regBtn">Registruj se</button>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn closeBtn waves-effect ml-auto" data-dismiss="modal">Zatvori</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div> -->
</header>
