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
                    <?php //print_r($this->input->post());?>
                    <p><b>Bienvenue sur votre profil </b><?php echo $this->session->userdata('username'); ?></p>
                </div><!--<div class="content">-->
            </div>
        </div>
    </div>
</section>
