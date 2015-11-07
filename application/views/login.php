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
                        <?php

                        // XXX plus belles erreurs
                        $error = $this->session->flashdata('login_error');
                        if (!empty($error)) {
                            echo "<label class='error'><i class='fa fa-exclamation-triangle'></i> $error</label>";
                        }

                        print '<p>' . form_open('/login');
                        $data = array(
                            'name' => 'email',
                            'id' => 'email',
                            'placeholder' => 'Adresse email',
                            'class' => 'form-control',
                        );

                        print '</p><p>' . form_input($data);

                        $data = array(
                            'name' => 'password',
                            'type' => 'password',
                            'id' => 'password',
                            'placeholder' => 'Mot de passe',
                            'class' => 'form-control',
                        );

                        print '</p><p>' . form_input($data);

                        $button = array(
                            'name' => 'submit',
                            'value' => 'Valider',
                            'class' => 'formsubmit',
                        );

                        print  '</p>' .form_submit($button); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
