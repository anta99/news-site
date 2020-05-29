<?php
    require_once "views/fixed/head.php";
    require_once "views/fixed/header.php";
?>
<section class="container-fluid">
    <div class="row">
         <article class="col-12 mx-auto">
        <img src="naslov.jpg" alt="naslovna" class="img" />
        </article>
        <article class="container">
            <span class="cat badge badge-secondary mt-4 ml-3 text-right">categorija</span>
            <div class="col-12">
                <h1 class="text-center">Naslov vesti</h1>
                <div class="news-details my-2 text-black-50 text-center">
                    <span><i class="fa fa-calendar"></i>
                    29/02/2020</span>
                    <span><i class="fa fa-user mx-1"></i> Djordje Antanaskovic</span>
                </div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi arcu ligula, dapibus in fermentum quis, commodo in ex. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam eget ligula lorem. Maecenas at convallis nibh. Aliquam sagittis diam vitae massa tempor, ut rutrum purus consequat. Nulla auctor neque sed purus hendrerit, at congue mauris porta. Phasellus suscipit dolor leo, vitae lobortis mi suscipit in. Nulla malesuada libero leo, vel elementum metus faucibus a. Nunc interdum elementum libero a tincidunt. Cras eget nisi mauris. Donec scelerisque nibh nec magna imperdiet, et finibus erat commodo. Nunc semper convallis nisi sed porttitor. Fusce sed odio eu dui consectetur sagittis. Suspendisse euismod posuere rutrum. Aenean pharetra ex quis arcu congue ullamcorper.

                    Donec elementum vitae ex non commodo. Morbi quis enim rutrum, auctor felis non, pellentesque metus. Suspendisse a neque tincidunt, lobortis ipsum vel, laoreet nulla. Suspendisse at nulla mauris. Praesent hendrerit velit in ipsum pellentesque, ac consequat lorem vestibulum. Praesent dignissim at turpis nec efficitur. Donec gravida ipsum est, sit amet scelerisque neque maximus nec. Sed vitae lorem nulla. Suspendisse finibus odio ipsum, tempor ultricies odio commodo ac. Nulla ut volutpat lacus. Vestibulum et nibh nec neque accumsan eleifend. Nullam sodales orci mi, consectetur eleifend urna fermentum eu. Vivamus et iaculis ipsum. In hac habitasse platea dictumst. Ut tempor, arcu sit amet porttitor blandit, lacus nisl convallis enim, at sollicitudin metus massa eget sapien.

                    Morbi ut ante at turpis blandit auctor quis at erat. Integer dignissim massa nec magna ultrices varius. Aenean luctus augue sed purus porttitor dignissim. Phasellus maximus magna vitae nulla aliquam varius. Vestibulum in lorem quam. Integer viverra dictum justo nec aliquam. Vivamus lacinia porttitor tellus non consequat. Nulla sit amet dui venenatis, congue felis vitae, commodo mauris. Proin arcu felis, porttitor vitae turpis ac, fringilla vulputate felis. In suscipit tortor et quam facilisis, vel efficitur erat rhoncus. Mauris ornare, ante sollicitudin porttitor commodo, lorem nibh malesuada nisi, et sagittis tortor diam in dui. Sed placerat iaculis euismod. Donec mauris justo, ullamcorper quis ipsum ut, venenatis luctus magna.

                    Phasellus eget cursus eros, at consectetur mauris. Sed et leo ultricies, sagittis enim eget, varius ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean neque ex, egestas a diam sit amet, interdum sagittis ex. Aliquam mollis nibh sed aliquet malesuada. Maecenas libero ipsum, blandit id nisl quis, congue scelerisque turpis. Nam aliquam ex sit amet laoreet dictum. Donec viverra, elit quis suscipit interdum, odio augue porttitor ex, nec ullamcorper erat purus vel dui.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque consectetur sit amet turpis in mattis. Quisque ut porta arcu, sit amet lobortis risus. Sed consequat lorem eleifend, accumsan nisi vitae, vulputate nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce suscipit orci odio, a ultricies dolor feugiat a. Phasellus tortor risus, dictum eget augue sed, tempor pretium felis. 
                </p>
                <span class="mt-5 d-inline-block">Tagovi:</span>
                <ul class="d-inline">
                    <li class="cat d-inline">Tag1</li>
                    <li class="cat d-inline">Tag1</li>
                    <li class="cat d-inline">Tag1</li>
                    <li class="cat d-inline">Tag1</li>
                    <li class="cat d-inline">Tag1</li>
                    <li class="cat d-inline">Tag1</li>
                </ul>    
                
            </div>
            <!-- Komentari -->
            <div class="col-12 my-3 ">
                <h2 class="border-bottom py-2">Komentari 
                <span class="comCount">
                    (0)
                </span>
                </h2>
                <!-- <form action="" id="komntarVest" name="komntarVest" method="POST">
                    <textarea name="commentArea" id="commentArea" rows="10" placeholder="Ostavite komentar..."></textarea>
                    <button>Posalji</button>
                </form> -->
            </div>
            <!-- Ispis komentara -->
            <div class="row">
                <div class="col-12 position-relative p-3 mb-2 comment">
                    <span class="font-weight-bold">Korisnik</span>
                    <span class="comDate position-absolute">07-May-2020 12:00:00</span>
                    <p class="mt-3">Ovo je neki tamo komentar1</p>
                    <button class="btn buttonCustom btnResponse">Odgovori</button>
                </div>
                <div class="col-12 position-relative p-3 mb-2 comment">
                    <span class="font-weight-bold">Korisnik</span>
                    <span class="comDate position-absolute">07-May-2020 12:00:00</span>
                    <p class="mt-3">Ovo je neki tamo komentar2</p>
                    <button class="btn buttonCustom btnResponse">Odgovori</button>
                </div>
                <div class="col-12 position-relative p-3 mb-2 comment">
                    <span class="font-weight-bold">Korisnik</span>
                    <span class="comDate position-absolute">07-May-2020 12:00:00</span>
                    <p class="mt-3">Ovo je neki tamo komentar3</p>
                    <button class="btn buttonCustom btnResponse">Odgovori</button>
                </div>
                <div class="odgovori">
                     <div class="col-12 position-relative p-3 mb-2 comment response">
                        <span class="font-weight-bold">Korisnik</span>
                        <span class="comDate position-absolute">07-May-2020 12:00:00</span>
                        <p class="mt-3">Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometar Ovo je neki tamo odgovor na kometarOvo je neki tamo odgovor na kometar</p>
                    </div>
                </div>
               
                <div class="col-12 position-relative p-3 mb-2 comment">
                    <span class="font-weight-bold">Korisnik</span>
                    <span class="comDate position-absolute">07-May-2020 12:00:00</span>
                    <p class="mt-3">Ovo je neki tamo komentar4</p>
                    <button class="btn buttonCustom btnResponse">Odgovori</button>
                </div>
            </div>
            <!-- Ispis komentara -->
            <!-- Povezane vesti -->
            <div class="row relatedNews">
                <div class="col-12">
                    <h2>Procitajte i ovo</h2>
                </div>
                <div class="col-12 col-md-5 col-lg-2">
                    <img src="naslov.jpg" alt="" class="img" />
                    <h4><a href="#">Ovo je jos jedna vest povezana sa ovom</a></h4>
                </div>
                <div class="col-12 col-md-5 col-lg-2">
                    <img src="naslov.jpg" alt="" class="img" />
                    <h4><a href="#">Ovo je jos jedna vest povezana sa ovom</a></h4>
                </div>
                <div class="col-12 col-md-5 col-lg-2">
                    <img src="naslov.jpg" alt="" class="img" />
                    <h4><a href="#">Ovo je jos jedna vest povezana sa ovom</a></h4>
                </div>
                <div class="col-12 col-md-5 col-lg-2">
                    <img src="naslov.jpg" alt="" class="img" />
                    <h4><a href="#">Ovo je jos jedna vest povezana sa ovom</a></h4>
                </div>
            </div>
        </article>
    </div>
</section>
<?php
    require_once "views/fixed/footer.php";
?>
