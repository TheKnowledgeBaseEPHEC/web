<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Login</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="content">
                    <div class="signup_wrap">
                        <p>
                            <?php
                            print form_open('/login');
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

                        <p>
                            <?php
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
                            ?>
                        </p>
                        <p>
                            <?php
                            $button = array(
                                'name' => 'submit',
                                'value' => 'Valider',
                                'class' => 'btn btn-default',
                            );
                            // print form_input($data);
                            print form_submit($button);
                            ?>
                        </p>

                    </div><!--<div class="signup_wrap">-->
                </div><!--<div id="content">-->
                <div class="content">
                    <?php //print_r($this->input->post());?>
                    <?php //echo $this->session->userdata('username'); ?>
                </div><!--<div class="content">-->
            </div>
        </div>
    </div>
</section>
