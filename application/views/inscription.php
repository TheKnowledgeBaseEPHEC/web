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
                       <p><?php
                           print form_open('/inscrlogin');
                        $button = array(
                            'name' => 'submit',
                            'value' => 'Se connecter',
                            'class' => 'btn btn-default',
                        );
                           echo form_submit ($button);
                           echo form_close();
                        ?></p>
                        <p><?php
                            print form_open('/submit');
                            $data = array(
                                'name' => 'username',
                                'id' => 'username',
                                'placeholder' => 'Nom Utilisateur',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?></p>

                        <p><?php
                            $data = array(
                                'name' => 'email',
                                'type' => 'email',
                                'id' => 'email',
                                'placeholder' => 'E-Mail',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?> </p>

                        <p> <?php
                            $data = array(
                                'name' => 'password',
                                'type' => 'password',
                                'id' => 'password',
                                'placeholder' => 'Mot de passe',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?> </p>

                        <p> <?php
                            $data = array(
                                'name' => 'confirmPassword',
                                'type' => 'password',
                                'id' => 'confirmPassword',
                                'placeholder' => 'Confirmation du mot de passe',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?> </p>

                        <?php
                        $button = array(
                            'name' => 'submit',
                            'value' => 'Valider',
                            'class' => 'btn btn-default',
                        );
                        // print form_input($data);
                        echo form_submit($button);
                        echo form_close();
                        ?>
                    </div><!--<div id="content">-->
                </div>
            </div>
        </div>
</section>


