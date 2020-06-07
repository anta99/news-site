<?php
    if(!$logged){
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
                        <a class="nav-link active" data-toggle="tab" href="#userInfo" role="tab">Podatci o korisniku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#passwordChange" role="tab">Promena lozinke</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="models/authorization/logout.php" role="tab"
                        >Odjavi se</a>
                    </li>
                </ul>
            </div>
        </div>
       
    </section>
    <section class="container p-5 minHeight">
        <div class="row">
            <div class="col-12 text-center">
                <div class="tab-content card tabs" id="userTabs">
                    <input type="hidden" name="userhidden" form="profileChange" id="userhidden" value="<?=$user["id"]?>" />
                    <!-- User info -->
                    <div class="tab-pane fade show active p-3" id="userInfo" role="tabpanel" aria-labelledby="home-tab-just">
                        <h2 class="mb-5">Profil</h2>
                        <form action="models/userProfile/changeInfo.php" method="POST" id="profileChange" name="profileChange">
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="firstName" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right font-weight-bold">Ime</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="text" class="form-control clearFocus" id="firstName" readonly="readonly" value="<?=$user["ime"]?>" />
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="lastName" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right font-weight-bold">Prezime</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="text" class="form-control clearFocus" id="lastName" readonly="readonly" value="<?=$user["prezime"]?>" />
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="username" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right font-weight-bold">Korisničko ime</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="text" class="form-control clearFocus" id="username" readonly="readonly" value="<?=$user["username"]?>" name="username" />
                                <p></p>
                                <span class="changeInfo mt-2 d-block">Izmeni</span>
                                <input type="hidden" id="changeUserName" name="originalName" value="<?=$user["username"]?>" />
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="mail" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right font-weight-bold">E-mail adresa</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="text" class="form-control clearFocus" id="mail" readonly="readonly" value="<?=$user["mail"]?>" />
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="mail" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right font-weight-bold">Aktivan od</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <p class="pt-3 text-left"><?=date("d/m/Y",strtotime($user["datum_registracije"]))?></p>
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-5 changeBtn d-none">
                                <button type="submit" class="btn buttonCustom" name="changeInfo">Izmeni</button>
                                <button type="reset" class="btn buttonCustom resetBtn">Ponisti</button>
                            </div>
                        </form>
                        <?php
                            if(isset($_SESSION["changeError"])):
                                $errors=$_SESSION["changeError"];
                                unset($_SESSION["changeError"]);
                        ?>
                        <div class="alert mx-auto alert-danger">
                            <?php
                                foreach($errors as $error):
                            ?>
                            <p><?=$error?></p>
                            <?php
                                endforeach;
                            ?>
                        </div>
                        <?php
                            
                            endif;
                            
                        ?>
                    </div>
                    <!-- Password change -->
                    <div class="tab-pane fade p-3" id="passwordChange" role="tabpanel" aria-labelledby="contact-tab-just">
                        <h2 class="mb-5">Promena lozinke</h2>
                        <form action="" method="POST" id="changePasswordForm" name="changePasswordForm">
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="oldPassword" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right font-weight-bold">Stara lozinka</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="password" class="form-control clearFocus" id="oldPassword" />
                                <p></p>
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="newPassword" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right font-weight-bold">Nova lozinka</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="password" class="form-control clearFocus" id="newPassword" />
                                <p class="text-muted">Lozinka mora imati najmanje 8 karaktera</p>
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="confirmPass" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right font-weight-bold">Potvrdite lozinku</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="password" class="form-control clearFocus" id="confirmPass" />
                                <p class="text-danger"></p>
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center mt-5 mb-0 changeBtn">
                                <button type="button" class="btn buttonCustom" name="changePass" id="changePass">Izmeni</button>
                                <button type="reset" class="btn buttonCustom resetPass">Ponisti</button>
                            </div>
                        </form>
                        <div class="alert d-none" id="passwordMessage">

                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="logout" role="tabpanel" aria-labelledby="profile-tab-just">
                        <p>Odjava ovde</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

