<main>
    <section class="container">
        <article class="row">
            <div class="col-12 col-md-8 p-md-3 mx-auto signInPage">
                 <form class="text-center p-5" method="POST" action="" id="regForm" name="regForm">
                    <p class="h4 mb-4">Registruj se</p>
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
            </div>
        </article>
    </section>
</main>