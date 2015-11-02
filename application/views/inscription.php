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
            <div class="col-lg-4 col-lg-offset-4">
                <div id="content">
                    <div class="reg_form">
                        <p><?php
                            print form_open('/inscrlogin');
                            $button = array(
                                'name' => 'submit',
                                'value' => 'Se connecter',
                                'class' => 'btn btn-default formsubmit',
                            );
                            echo form_submit($button);
                            echo '<hr class="light">';
                            echo form_close();
                            ?>
                        </p>

                        <p><?php
                            $attributes = array('id' => 'register');
                            print form_open('/submit', $attributes);

                            $validation_errors = $this->session->flashdata('validation_errors');
                            if (!empty($validation_errors)) {
                                if (is_array($validation_errors)) {
                                    $validation_errors_count = count($validation_errors);
                                    $validation_errors_keys = array_keys($validation_errors);

                                    for ($i = 0; $i < $validation_errors_count; $i++) {
                                        echo $validation_errors[$validation_errors_keys[$i]];
                                        echo '<hr class="light">';
                                    }
                                } else {
                                    echo $validation_errors;
                                    echo '<hr class="light">';
                                }
                            }

                            echo form_label("Nom de famille", "nom");
                            $data = array(
                                'name' => 'nom',
                                'id' => 'nom',
                                'class' => 'form-control',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>
                        </p>

                        <p><?php
                            echo form_label("Prenom", "prenom");
                            $data = array(
                                'name' => 'prenom',
                                'id' => 'prenom',
                                'class' => 'form-control',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>
                        </p>

                        <p><?php
                            echo form_label("Email", "email");
                            $data = array(
                                'name' => 'email',
                                'type' => 'email',
                                'id' => 'email',
                                'placeholder' => 'Ex: me@mail.com',
                                'class' => 'form-control',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>
                        </p>

                        <p><?php
                            echo form_label("Confirmation Email", "confirmEmail");
                            $data = array(
                                'name' => 'confirmEmail',
                                'type' => 'email',
                                'id' => 'confirmEmail',
                                'class' => 'form-control',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>
                        </p>

                        <p> <?php
                            echo form_label("Mot de passe", "mdp");
                            $data = array(
                                'name' => 'password',
                                'type' => 'password',
                                'id' => 'password',
                                'placeholder' => 'Minimum 4 caracteres',
                                'class' => 'form-control',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>
                        </p>

                        <p> <?php
                            echo form_label("Confirmation de mot de passe", "vmdp");
                            $data = array(
                                'name' => 'confirmPassword',
                                'type' => 'password',
                                'id' => 'confirmPassword',
                                'placeholder' => 'Confirmation du mot du passe',
                                'class' => 'form-control',
                                'required' => 'required'
                            );
                            echo form_input($data);
                            ?>
                        </p>

                        <?php
                        $button = array(
                            'name' => 'submit',
                            'value' => 'Valider',
                            'class' => 'btn btn-default formsubmit',
                            'required' => 'required'
                        );
                        // print form_input($data);
                        echo form_submit($button);
                        echo form_close();
                        ?>
                    </div>
                    <!--<div id="content">-->
                </div>
            </div>
        </div>
</section>

<script>
    window.onload = function () {
        $(function () {
            $("#register").validate({
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    prenom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    password: {
                        required: true,
                        minlength: 4,
                        maxlength: 64,
                        check_password: true
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    confirmEmail: {
                        required: true,
                        email: true,
                        equalTo: "#email"
                    }
                },
                messages: {
                    nom: {
                        required: "Veuillez entrer votre nom de famille",
                        minlength: "Votre nom doit avoir au moins 2 caractères",
                        maxlength: "Votre nom doit avoir moins de 25 caractères"
                    },
                    prenom: {
                        required: "Veuillez entrer votre prénom",
                        minlength: "Votre prénom doit avoir au moins 2 caractères",
                        maxlength: "Votre prénom d'utilisateur doit avoir moins de 25 caractères"
                    },
                    password: {
                        required: "Veuillez entrer un mot de passe",
                        minlength: "Votre mot de passe doit avoir au moins 4 caractères",
                        maxlength: "Votre mot de passe doit avoir moins de 64 caractères",
                        check_password: "Votre mot de passe doit contenir au moins une majuscule et un chiffre"
                    },
                    confirmPassword: {
                        required: "Veuillez confirmer votre mot de passe",
                        equalTo: "Les mots de passe entrés diffèrent"
                    },
                    email: {
                        required: "Veuillez entrer une addresse email",
                        email: "Veuillez entrer une addresse email valide"
                    },
                    confirmEmail: {
                        required: "Veuillez confirmer votre addresse email",
                        email: "Veuillez entrer une addresse email valide",
                        equalTo: "Les addresses email diffèrent"
                    }
                },
                showErrors: function (errorMap, errorList) {
                    for (var i = 0; errorList[i]; i++) {
                        errorList[i].message = '<i class="fa fa-exclamation-triangle"></i>  ' + errorList[i].message
                    }
                    this.defaultShowErrors()
                }
            });
            $.validator.addMethod("check_password", function (value) {
                return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value)
                    && /[A-Z]/.test(value) // uppercase letter
                    && /\d/.test(value) // number
            });
        });
    }
</script>