<main>
    <section class="container signInPage">
        <article class="row">
            <div class="col-12 col-md-8 p-3 mx-auto">
                <form class="text-center p-5" method="POST" action="signIn.php" id="logInForm" name="logInForm">
                    <p class="h4 mb-4">Prijavi se</p>
                    <input type="text" id="logMail" name="logMail" class="form-control mt-2 clearFocus" placeholder="E-mail" />
                    <p class="text-danger"></p>
                    <input type="password" id="logPass" name="logPass" class="form-control mt-4 clearFocus" placeholder="Lozinka" />
                    <p class="text-danger"></p>
                    <div class="text-center mt-2">
                        <button class="btn btn-info buttonCustom logBtn">Prijavi se</button>
                    </div>
              </form>
            </div>
        </article>
    </section>
</main>