<?php
    if($logged){
       header("Location:index.php?page=userProfile"); 
    }
?>
<main class="container-fluid p-3">
    <h1 class="text-center my-3">Prijava/Registracija</h1>
    <!-- Sign In Form -->
    <div class="row p-0 p-lg-2">
        <section class="col-12 col-md-6 signInForm">
            <?php
                if(isset($_SESSION["logInFail"])):
            ?>
            <div class="alert alert-danger text-center m-0">
               <p class="h5"><?=$_SESSION["logInFail"]?></p>
            </div>
            <?php
                endif;
                unset($_SESSION["logInFail"]);
            ?>
            <form class="text-center p-2 p-md-5" method="POST" action="models/authorization/signIn.php" id="logInForm" name="logInForm">
                <h2 class="h4 mb-4">Prijavi se</h2>
                <input type="text" id="logName" name="logName" class="form-control mt-2 clearFocus" placeholder="Korisničko ime" />
                <p class="text-danger"></p>
                <input type="password" id="logPass" name="logPass" class="form-control mt-4 clearFocus" placeholder="Lozinka" />
                <p class="text-danger"></p>
                <div class="text-center mt-2">
                    <button type="submit" name="signInBtn" class="btn btn-info buttonCustom logBtn">Prijavi se</button>
                </div>
            </form>
        </section>
        <!-- Register Form -->
        <section class="col-12 col-md-6 registerFrom">
            <form class="text-center p-2 p-md-5" method="POST" action="" id="regForm" name="regForm">
                <h2 class="h4 mb-4">Registruj se</h2>
                <input type="text" id="regFirstName" name="regFirstName" class="form-control my-2 clearFocus" placeholder="Ime" />
                <p class=" text-danger"></p>
                <input type="text" id="regLastName" name="regLastName" class="form-control my-2 clearFocus" placeholder="Prezime" />
                <p class=" text-danger"></p>
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
                <div class="text-center form-sm mt-2">
                    <button type="button" class="btn btn-info buttonCustom regBtn">Registruj se</button>
                </div>
            </form>
            <div>
                <ul class="list-group" id="registerMessage">
                   
                </ul>
            </div>
        </section>
    </div>
    
</main>