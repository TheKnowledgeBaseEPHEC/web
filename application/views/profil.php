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
            <div class="col-md-6 col-md-offset-3">
                    <?php
                    $validation_errors = $this->session->flashdata('validation_errors');
                    if (!empty($validation_errors)) {
                        if (is_array($validation_errors)) {
                            $validation_errors_count = count($validation_errors);
                            $validation_errors_keys = array_keys($validation_errors);

                            for ($i = 0; $i < $validation_errors_count; $i++) {
                                echo '<label class="error"><i class="fa fa-exclamation-triangle"></i>';
                                echo $validation_errors[$validation_errors_keys[$i]] . '</label>';
                                echo '<hr class="light">';
                            }
                        } else {
                            echo '<label class="error"><i class="fa fa-exclamation-triangle"></i>';
                            echo $validation_errors . '</label>';
                            echo '<hr class="light">';
                        }
                    }
                    $error = $this->session->flashdata('upload_error');
                    if (!empty($error)) {
                        echo "<label class='error'><i class='fa fa-exclamation-triangle'></i> $error</label>";
                    }
                    ?>

                    <table class="table-curved">
                        <tr>
                            <td class="toptd">Nom</td>
                            <td class="toptd"><?php echo $user->nom; ?></td>
                        </tr>
                        <tr>
                            <td>Prenom</td>
                            <td><?php echo $user->prenom; ?></td>
                        </tr>
                        <tr>
                            <td>Adresse Email</td>
                            <td><?php echo $user->email; ?></td>
                        </tr>
                        <tr>
                            <td>Question secrète</td>
                            <td><?php echo $user->SQuestion; ?></td>
                        </tr>
                        <tr>
                            <td>Image d'avatar</td>
                            <td><?php
                                $this->load->model('Profil_model');
                                $idUser = $user->id;
                                $this->load->helper('html');
                                $image_properties = array(
                                    'src' => $user->avatar,
                                    'alt' => 'erreur de chargement',
                                    'class' => 'post_image',
                                    'width' => '200',
                                    'height' => '200',
                                    'title' => 'photo avatar',
                                    'rel' => 'lightbox',
                                );
                                echo img($image_properties);
                                ?></td>
                        </tr>
                    </table>
                </div>


                <!-- Edition de profile utilisateur
                <div id="tabs">
                    <ul>
                        <li>
                            <a href="#a">Nom</a>
                        </li>
                        <li>
                            <a href="#b">Prenom</a>
                        </li>
                        <li>
                            <a href="#c">Adresse Mail</a>
                        </li>
                        <li>
                            <a href="#d">Avatar</a>
                        </li>
                        <li>
                            <a href="#e">Mot de passe</a>
                        </li>
                        <li>
                            <a href="#f">Question secrète</a>
                        </li>
                    </ul>
                    <div id="a">
                        <?php
                        echo validation_errors();
                        print form_open('/profil', array('id' => 'nomform'));
                        echo form_label("Nom de famille", "name");
                        $data = array(
                            'name' => 'name',
                            'id' => 'name',
                            'placeholder' => 'Nom',
                            'class' => 'form-control',
                        );
                        echo form_input($data);

                        $button = array(
                            'name' => 'name_submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close();
                        ?>
                    </div>
                    <div id="b">
                        <?php
                        print form_open('/profil', array('id' => 'prenom'));
                        echo form_label("Prenom", "prenom");
                        $data = array(
                            'name' => 'prenom',
                            'id' => 'prenom',
                            'placeholder' => 'Prenom',
                            'class' => 'form-control',
                        );
                        echo form_input($data);

                        $button = array(
                            'name' => 'firstname_submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close();
                        ?>
                    </div>
                    <div id="c">
                        <?php
                        print form_open('/profil', array('id' => 'email'));
                        echo form_label("Email", "email");
                        $data = array(
                            'name' => 'email',
                            'id' => 'email',
                            'placeholder' => 'Email',
                            'class' => 'form-control',
                        );
                        print form_input($data);

                        $data = array(
                            'name' => 'confirmMail',
                            'id' => 'confirmMail',
                            'placeholder' => 'Confirmez votre email',
                            'class' => 'form-control',
                        );
                        print form_input($data);

                        $button = array(
                            'name' => 'mail_submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close();
                        ?>
                    </div>
                    <div id="d">
                        <?php echo form_open_multipart('/profil', array('id' => 'avatar'));

                        $data = array(
                            'name' => 'userfile',
                            'type' => 'file',
                            'id' => 'userfile',
                            'class' => 'form-control',
                            'required' => 'required'
                        );
                        echo form_input($data);

                        $button = array(
                            'name' => 'avatar_submit',
                            'value' => 'Upload',
                            'class' => 'formsubmit',
                        );

                        echo form_submit($button);
                        echo form_close();
                        ?>
                    </div>
                    <div id="e">
                        <?php
                        print form_open('/profil', array('id' => 'password'));
                        echo form_label("Mot de passe", "mot de passe");
                        $data = array(
                            'name' => 'oldPwd',
                            'type' => 'password',
                            'id' => 'oldPwd',
                            'placeholder' => 'Votre ancien mot de passe',
                            'class' => 'form-control',
                        );
                        echo form_input($data);

                        $data = array(
                            'name' => 'newPwd',
                            'type' => 'password',
                            'id' => 'newPwd',
                            'placeholder' => 'Votre nouveau mot de passe',
                            'class' => 'form-control',
                        );
                        echo form_input($data);

                        $data = array(
                            'name' => 'confirmNewPwd',
                            'type' => 'password',
                            'id' => 'confirmOldPwd',
                            'placeholder' => 'Confirmation du nouveau mot de passe',
                            'class' => 'form-control',
                        );
                        echo form_input($data);

                        $button = array(
                            'name' => 'pwd_submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close();
                        ?>
                    </div>
                    <div id="f">
                        <?php
                        print validation_errors();
                        print form_open('/profil');
                        print form_label("Question secrète", "question secrète");

                        $options = array(
                            'animal' => 'Quel est le nom de votre premier animal de compagnie?',
                            'voiture' => 'Quelle est la marque de votre première voiture?',
                            'ville' => 'Quel est le nom de votre ville de naissance?'
                        );

                        print form_dropdown('secret_questions', $options, 'animal', 'class="selectpicker"');
                        $data = array(
                            'name' => 'repScr',
                            'id' => 'repScr',
                            'placeholder' => 'Réponse',
                            'class' => 'form-control',
                        );
                        print form_input($data);

                        $button = array(
                            'name' => 'submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close();
                        ?>
                    </div>
                    <p><?php
                        print anchor(base_url("logout"), "se deconnecter", 'class="btn formsubmit"');
                        ?>
                    </p>
                </div>
                <!--<div class="content">-->
            </div>
        </div>
    </div>
</section>

<script>
    window.onload = function () {
        $(function () {
            $("#nomform").validate({
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    }
                },
                messages: {
                    nom: {
                        required: "Veuillez entrer votre nom de famille",
                        minlength: "Votre nom doit avoir au moins 2 caractères",
                        maxlength: "Votre nom doit avoir moins de 25 caractères"
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

        $('#tabs')
            .tabs()
            .addClass('ui-tabs-vertical ui-helper-clearfix');

        $('.selectpicker').selectpicker();
    }
</script>