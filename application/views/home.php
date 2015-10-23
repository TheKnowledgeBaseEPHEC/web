<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Knowledge Base</h1>

            <h2>trouvez des tutorats !</h2>
            <hr>
            <a href="#about" class="btn btn-primary btn-xl page-scroll">Plus d'informations</a>
        </div>
    </div>
</header>

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">Trouvez la solution!</h2>
                <hr class="light">
                <p class="text-faded">Nous proposons une liste de cours disponibles dans de nombreuses universités et
                    hautes écoles en Belgique donnés par des anciens élèves du cours ayant une bonne compréhension de la
                    matière.</p>

                <div id="scrollable-dropdown-menu">
                    <div class="input-group-btn">
                        <button class="search-btn btn btn-default btn-xl" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                        <input class="search-input btn btn-xl search" type="text" placeholder="Cherchez un cours">
                    </div>
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
        function formatRepo(repo) {
            if (repo.loading) return repo.text;

            var markup = '<img src="' + repo.owner.avatar_url + '" style="max-width: 100%" />' +
                repo.full_name +
                repo.forks_count +
                repo.stargazers_count;

            if (repo.description) {
                markup += repo.description;
            }
            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }

        function formatRepo(repo) {
            if (repo.loading) return repo.text;

            var markup = '<div class="clearfix">' +
                '<div class="col-sm-1">' +
                '<img src="' + repo.owner.avatar_url + '" style="max-width: 100%" />' +
                '</div>' +
                '<div clas="col-sm-10">' +
                '<div class="clearfix">' +
                '<div class="col-sm-6">' + repo.full_name + '</div>' +
                '<div class="col-sm-3"><i class="fa fa-code-fork"></i> ' + repo.forks_count + '</div>' +
                '<div class="col-sm-2"><i class="fa fa-star"></i> ' + repo.stargazers_count + '</div>' +
                '</div>';

            if (repo.description) {
                markup += '<div>' + repo.description + '</div>';
            }

            markup += '</div></div>';

            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }

        $(document).ready(function () {
            $(".search").select2({
                ajax: {
                    url: "https://api.github.com/search/repositories",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, page) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data.items
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page

            });
        });
    }
</script>
