<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Bienvenue sur votre profil</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="content">
                    <div class="signup_wrap">

                    </div><!--<div class="signup_wrap">-->
                </div><!--<div id="content">-->
                <div class="content">
                    <p><b>Bienvenue sur votre profil </b><?php echo $this->session->userdata('user_data')['slug']; ?></p>
                    <p></p><a class="btn btn-default formsubmit" href="/logout">Déloguer</a></p>
                </div><!--<div class="content">-->
            </div>
        </div>
    </div>
</section>
