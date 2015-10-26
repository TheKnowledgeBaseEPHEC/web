<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#univ">
                <h1>
                    Cours
                </h1>
            </a>
        </div>
    </div>
</header>

<section class="bg-primary" id="univ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <?php
                /* Group array by ecoleId and sort. */
                $arr = array();
                foreach ($cours_data as $key => $item) {
                    $arr[$item->idEcole][$key] = $item;
                }
                ksort($arr, SORT_STRING);

                $i = 0;
                foreach ($arr as $facs) {
                    print '<h2>' . $facs[$i]->NomEcole . '</h2>';
                    print '<ul class="list-group">';
                    foreach ($facs as $cours) {
                        print '<li class="list-group-item cours-' . $cours->idCours . '">';
                        print '<a href="/' . uri_string() . '/' . $cours->slug . '">' . $cours->IntituleCours . '</a>';
                        print '</li>';
                        $i++;
                    }
                    print '</ul>';
                    print '<hr class="light">';
                }
                ?>
            </div>
        </div>
    </div>
</section>