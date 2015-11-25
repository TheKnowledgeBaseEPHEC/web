<header style="min-height: 80%;">
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Connexion</h1></a>
        </div>
        <div class="col-lg-4 col-lg-offset-4">
            <div id="content">
                <div class="signup_wrap">
                    <?php

                    // XXX plus belles erreurs
                    $error = $this->session->flashdata('login_error');
                    if (!empty($error)) {
                        echo "<label class='error'><i class='fa fa-exclamation-triangle'></i> $error</label>";
                    }

                    print '<p>' . form_open('/connexion', array('id' => 'login'));
                    $data = array(
                        'name' => 'email',
                        'id' => 'email',
                        'placeholder' => 'Adresse email',
                        'class' => 'form-control',
                        'required' => 'required'
                    );

                    print '</p><p>' . form_input($data);

                    $data = array(
                        'name' => 'password',
                        'type' => 'password',
                        'id' => 'password',
                        'placeholder' => 'Mot de passe',
                        'class' => 'form-control',
                        'required' => 'required'
                    );

                    print '</p><p>' . form_input($data);

                    $button = array(
                        'name' => 'submit',
                        'value' => 'Valider',
                        'class' => 'formsubmit',
                    );

                    print  '</p>' . form_submit($button);
                    form_close() ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>


<script>
    window.onload = function () {
        $(function () {
            $("#login").validate({
                rules: {
                    password: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    password: {
                        required: "Veuillez entrer votre mot de passe",
                    },
                    email: {
                        required: "Veuillez entrer une addresse email",
                        email: "Veuillez entrer une addresse email valide"
                    }
                },
                showErrors: function (errorMap, errorList) {
                    for (var i = 0; errorList[i]; i++) {
                        errorList[i].message = '<i class="fa fa-exclamation-triangle"></i>  ' + errorList[i].message
                    }
                    this.defaultShowErrors()
                }
            });
        });
    }
</script>
