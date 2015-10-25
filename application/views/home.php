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
                                <button class="btn btn-default btn-xl search-button" type="button" data-select2-open="multi-append">
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
                <h2 class="section-heading">At Your Service</h2>
                <hr class="primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>

                    <h3>Sturdy Templates</h3>

                    <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>

                    <h3>Ready to Ship</h3>

                    <p class="text-muted">You can use this theme as is, or you can make changes!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>

                    <h3>Up to Date</h3>

                    <p class="text-muted">We update dependencies to keep things fresh.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>

                    <h3>Made with Love</h3>

                    <p class="text-muted">You have to make your websites with love these days!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<aside class="bg-dark">
    <div class="container text-center">
        <div class="call-to-action">
            <h2>Free Download at Start Bootstrap!</h2>
            <a href="#" class="btn btn-default btn-xl wow tada">Download Now!</a>
        </div>
    </div>
</aside>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">Let's Get In Touch!</h2>
                <hr class="primary">
                <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we
                    will get back to you as soon as possible!</p>
            </div>
            <div class="col-lg-4 col-lg-offset-2 text-center">
                <i class="fa fa-phone fa-3x wow bounceIn"></i>

                <p>123-456-6789</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>

                <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
            </div>
        </div>
    </div>
</section>

<script>
    window.onload = function () {
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

        /* Submit search */
        $(".search-button").on('click',function(e){
            var result = window.location.href + 'fac/' + $('.search').select2('data').slug;
            window.location.href = result;
        });
    }
</script>
