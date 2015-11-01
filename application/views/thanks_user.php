<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Inscription</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="content">
                    <div class="reg_form">
                        <p><b>Voici les informations relatives a votre compte:</b></p>
                        <p><b>Nom:</b> <?php echo $this->input->post('username') ?></p>
                        <p><b>Prenom:</b> <?php echo $this->input->post('prenom') ?></p>
                        <p><b>Email:</b> <?php echo $this->input->post('email') ?></p>
                        <p><b>Veuillez confirmer votre inscription a l'adresse suivante:</b> <?php echo $this->input->post('email');?> </p>
                        <?php
                        print form_open('thanks_user/inscrlogin');
                        $button = array(
                            'name' => 'submit',
                            'value' => 'Se connecter',
                            'class' => 'btn btn-default',
                        );
                        echo form_submit ($button);
                        echo form_close();
                        ?>
                        <h4><?php echo anchor('user/logout', 'Logout'); ?></h4>
                    </div><!--<div id="content">-->
                </div>
            </div>
        </div>
</section>


