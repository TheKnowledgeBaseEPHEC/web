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
                            echo validation_errors();
                            echo form_label ("Nom d'utilisateur", "username");
                            $data = array(
                                'name' => 'username',
                                'id' => 'username',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?></p>

                        <p><?php
                            echo form_label ("Prenom", "prenom");
                            $data = array(
                                'name' => 'prenom',
                                'id' => 'prenom',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?> </p>
                        <p><?php
                            echo form_label ("Email", "email");
                            $data = array(
                                'name' => 'email',
                                'type' => 'email',
                                'id' => 'email',
                                'placeholder' => 'Ex: me@hotmail.com',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?> </p>

                        <p><?php
                            echo form_label ("Confirmation Email", "confirmmail");
                            $data = array(
                                'name' => 'confirmEmail',
                                'type' => 'email',
                                'id' => 'confirmEmail',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?> </p>

                        <p> <?php
                            echo form_label ("Mot de passe", "mdp");
                            $data = array(
                                'name' => 'password',
                                'type' => 'password',
                                'id' => 'password',
                                'placeholder' => 'Minimum 4 caracteres',
                                'maxlength' => '100',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            ?> </p>

                        <p> <?php
                            echo form_label ("Confirmation de mot de passe", "vmdp");
                            $data = array(
                                'name' => 'confirmPassword',
                                'type' => 'password',
                                'id' => 'confirmPassword',
                                'placeholder' => 'Confirmation du mot du passe',
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


