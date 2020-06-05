<?php
    if(isset($_GET["code"])){
        $code=$_GET["code"];
    }
    else{
        header("Location:index.php?page=404");
    }
?>
<main>
    <section class="container-fluid">
        <div class="row">
            <article class="col-12 text-center minHeight">
                <h1 class="my-3">Verifikacija naloga</h1>
                <?php
                    require_once "models/authorization/function.php";
                    $verify=verification($code);
                    if($verify):
                ?>
                <img src="assets/images/correct.png" alt="Uspesna registracija" class="my-1 img-fluid" />
                <h2>Uspešno ste se registrovali!</h2>
                <h3><a href="index.php?page=authorization">Prijavite se</a></h3>
                <?php
                    else:
                ?>
                <img src="assets/images/incorrect.png" alt="Neuspesna registracija" class="my-1 img-fluid" />
                <h2 class="my-5">Došlo je do greške!</h2>
                <?php
                    endif;
                ?>
            </article>
        </div>
    </section>
</main>