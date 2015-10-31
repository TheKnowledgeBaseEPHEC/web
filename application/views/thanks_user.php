<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Merci pour votre inscription</h1></a>
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
                    <?php //echo $this->session->userdata('username'); ?>
                    <p>Veuillez confirmer votre inscription a l'adresse suivante: <?php echo $this->input->post('email');?> </p>
                    <h4><?php echo anchor('user/logout', 'Logout'); ?></h4>
                </div><!--<div class="content">-->
            </div>
        </div>
    </div>
</section>
