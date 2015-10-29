<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Knowledge Base</h1>

            <h2>trouvez des tutorats</h2>
            <hr>
            <a href="#about" class="btn btn-primary btn-xl page-scroll">Plus d'informations</a>
        </div>
    </div>
</header>

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 text-center">
                <h2 class="section-heading">Trouvez la solution!</h2>
                <hr class="light">
                <p class="text-faded">Nous proposons une liste de cours disponibles dans de nombreuses universités et
                    hautes écoles en Belgique donnés par des anciens élèves du cours ayant une bonne compréhension de la
                    matière.</p>

                <div class="input-group select2-bootstrap-append">
                    <input type="hidden" class="search form-control" placeholder="" multiple>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-xl search-button" type="button"
                                        data-select2-open="multi-append">
                                    <i class="fa fa-search"></i>
                                </button>
				            </span>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">À votre service</h2>
                <hr class="primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-5x fa-user-plus wow bounceIn text-primary"></i>

                    <p class="text-muted nbusers">Déjà x utilisateurs!</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-5x fa-graduation-cap wow bounceIn text-primary" data-wow-delay=".1s"></i>

                    <p class="text-muted nbcours">x cours dans y facultés disponibles!</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-5x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>

                    <p class="text-muted love">Par l'équipe KnowledgeBase de l'EPHEC!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    window.onload = function () {
        /* Load search box */
        $(".search").select2({
            placeholder: 'Cherchez votre université',
            width: '100%',
            allowClear: true,
            multiple: false,
            theme: "classic",
            ajax: {
                url: window.location.href + '/fac/data',
                dataType: 'json',
                type: "GET",
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.idEcole,
                                text: item.NomEcole,
                                image: item.Image,
                                email: item.AdEmail,
                                slug: item.slug
                            }
                        })
                    };
                }
            }
        });

        /* Fill from misc data */
        $.ajax({
            url: window.location.href + '/data',
            dataType: 'json',
            success: function (data) {
                $('.nbusers').contents().filter(function () {
                    this.textContent = this.textContent.replace('x', data[0].nbusers);
                });
                $('.nbcours').contents().filter(function () {
                    this.textContent = this.textContent.replace('x', data[0].nbcours);
                    this.textContent = this.textContent.replace('y', data[0].nbfacs);
                })
            }
        });

        /* Submit search */
        $(".search-button").on('click', function (e) {
            var result = window.location.href + 'cours#' + $('.search').select2('data').slug;
            window.location.href = result;
        });
    }
</script>
