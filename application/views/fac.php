<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#univ"><h1>Universités et hautes écoles</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="univ">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 text-center">
            <?php
                foreach ($ecoles_data as $ecole) {
                    print '<div class="row">';
                    print '<div class="wow bounceIn circle-image">';
                    print '<a href=/fac/' . $ecole->slug . '><img class="img-circle" src="' . $ecole->Image . '" /></a>';
                    print '</div>';
                    print '</div>';
                    print '<hr class="light">';
                }
                ?>
            </div>
        </div>
    </div>
</section>