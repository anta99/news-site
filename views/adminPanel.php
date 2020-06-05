<?php
    if(!$admin){
        header("Location:index.php?page=authorization");
    }
    echo "Ovde ide admin panel";

?>
<main>
    <section class="container-fluid">
        <div class="row">
            
            <div class="col-12">
                <!-- <h1 class="text-center">Korisnički profil</h1> -->
                <ul class="nav nav-tabs nav-justified md-tabs" id="myTabJust" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="index.php?page=addNews" role="tab">Dodaj vest</a>
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
</main>