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
            <div class="col-lg-4 col-lg-offset-4">
                <div id="content">
                    <div class="signup_wrap">
                        <p>
                            <?php
                            print form_open('/login');
                            $data = array(
                                'name' => 'email',
                                'id' => 'email',
                                'placeholder' => 'Adresse email',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            echo form_close();
                            ?></p>

                        <p>
                            <?php
                            $data = array(
                                'name' => 'password',
                                'type' => 'password',
                                'id' => 'password',
                                'placeholder' => 'Mot de passe',
                                'class' => 'form-control',
                            );
                            echo form_input ($data);
                            echo form_close();
                            ?>
                        </p>
                        <p>
                            <?php
                            $button = array(
                                'name' => 'submit',
                                'value' => 'Valider',
                                'class' => 'formsubmit',
                            );
                            // print form_input($data);
                            print form_submit($button);
                            echo form_close();
                            ?>
                        </p>
                    </div><!--<div class="signup_wrap">-->
                </div><!--<div id="content">-->
                <div class="content">
                </div><!--<div class="content">-->
            </div>
        </div>
    </div>
</section>
