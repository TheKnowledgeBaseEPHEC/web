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
            <div class="col-md-12">
                <?php
                foreach ($uni_data as $uni) {
                    print '<div class="row">';
                    print '<div class="circle-image">';
                    print '<img class="img-circle" src="' . $uni->img . '" />';
                    print 'nb cours = ' . $uni->ncours . '.';
                    print '</div>';
                    print '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>