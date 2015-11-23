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

                /* Fac list with links */
                $i = 0;
                print '<ul class="list-group">';
                foreach ($arr as $item) {
                    print '<li class="list-group-item">';
                    print '<a class="scroll-link white-link" href="#' . $item[$i]->slug . '">'. $item[$i]->NomEcole . '</a>';
                    print '</li>';
                    foreach ($item as $subitem) {
                        $i++;
                    }
                }
                print '</ul>';
                print '<hr class="light">';

                /* Cours grouped by Facs */
                $i = 0;
                $c = count($arr);
                foreach ($arr as $facs) {
                    print '<div id="' . $facs[$i]->slug . '" class="page-section">';
                    print '<h2><i class="fa fa-graduation-cap"></i> ' . $facs[$i]->NomEcole . '</h2>';
                    print '<ul class="list-group">';
                    foreach ($facs as $cours) {
                        print '<li class="list-group-item">';
                        print '<a href="/' . uri_string() . '/' . $cours->slug . '">' . $cours->IntituleCours . '</a>';
                        print '</li>';
                        $i++;
                    }
                    print '</ul>';
                    print '</div>';
                    print '<hr class="light">';
                }
                print '<a class="btn btn-primary btn-xl scroll-top">Remonter</a>';
                print '<a class="btn btn-success btn-xl scroll-top" href="ajouter_cour"><i class="glyphicon glyphicon-plus"></i> Ajouter un cours</a>';
                ;
                ?>
            </div>
        </div>
    </div>
</section>

<script>
    /* Smooth scrolling to divs and top */
    window.onload = function () {
        $('a[href^="#"]').on('click',function (e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);

            $('html, body').stop().animate({
                'scroll-top': $target.offset().top - '60'
            }, 900, 'swing', function () {
                window.location.hash = target;
            });
        });
        $('.scroll-top').on('click', function() {
            $("html, body").animate(
                {
                    scrollTop: 0
                }, "slow");
        });
    }
</script>
