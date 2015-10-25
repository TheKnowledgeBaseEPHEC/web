<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#univ">
                <h1>
                    <?php print $cours_data->IntituleCours ?>
                </h1>
            </a>
        </div>
    </div>
</header>

<section class="bg-primary" id="univ">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 text-center">
                <?php
                print '<div class="row">';
                print $cours_data->idCours;
                print '</div>';
                ?>
            </div>
        </div>
    </div>
</section>