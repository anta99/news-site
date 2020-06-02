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
    <section class="container p-5">
        <div class="row">
            <div class="col-12 text-center">
                <div class="tab-content card" id="userTabs">
                    <input type="hidden" name="userhidden" id="userhidden" value="<?=$user["id"]?>" />
                    <!-- User info -->
                    <div class="tab-pane fade show active p-3" id="userInfo" role="tabpanel" aria-labelledby="home-tab-just">
                        <h2 class="mb-5">Profil</h2>
                        <form action="" method="POST" id="profileChange" name="profileChange">
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="firstName" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right">Ime</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="text" class="form-control clearFocus" id="firstName" readonly="readonly" value="<?=$user["ime"]?>" />
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="lastName" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right">Prezime</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="text" class="form-control clearFocus" id="lastName" readonly="readonly" value="<?=$user["prezime"]?>" />
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="username" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right">Korisničko ime</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="text" class="form-control clearFocus" id="username" readonly="readonly" value="<?=$user["username"]?>" />
                                <span class="changeInfo mt-2 d-block">Izmeni</span>
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="mail" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right">E-mail adresa</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="text" class="form-control clearFocus" id="mail" readonly="readonly" value="<?=$user["mail"]?>" />
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-5 changeBtn d-none">
                                <button type="submit" class="btn buttonCustom" name="changeInfo">Izmeni</button>
                                <button type="reset" class="btn buttonCustom resetBtn">Ponisti</button>
                            </div>
                        </form>
                    </div>
                    <!-- Password change -->
                    <div class="tab-pane fade p-3" id="passwordChange" role="tabpanel" aria-labelledby="contact-tab-just">
                        <h2 class="mb-5">Promena lozinke</h2>
                        <form action="" method="POST" id="changePasswordForm" name="changePasswordForm">
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="oldPassword" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right">Stara lozinka</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="password" class="form-control clearFocus" id="oldPassword" />
                                <p></p>
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="newPassword" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right">Nova lozinka</label>
                                <div class="col-12 col-md-10 col-lg-5">
                                <input type="password" class="form-control clearFocus" id="newPassword" />
                                <p class="text-muted">Lozinka mora imati najmanje 8 karaktera</p>
                                </div>
                            </div>
                            <div class="form-group row mx-auto justify-content-center my-2">
                                <label for="confirmPass" class="col-sm-4 col-lg-2 col-form-label text-center text-lg-right">Potvrdite lozinku</label>
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

