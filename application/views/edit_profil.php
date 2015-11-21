<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <h2>Editer votre profil</h2>

                <div id="tabs">
                    <ul>
                        <li>
                            <a href="#nom">Nom</a>
                        </li>
                        <li>
                            <a href="#prenom">Prenom</a>
                        </li>
                        <li>
                            <a href="#email">Adresse Mail</a>
                        </li>
                        <li>
                            <a href="#avatar">Avatar</a>
                        </li>
                        <li>
                            <a href="#mdp">Mot de passe</a>
                        </li>
                        <li>
                            <a href="#qsec">Question secrète</a>
                        </li>
                    </ul>
                    <div id="nom">
                        <?php
                        echo validation_errors();
                        print form_open('/profil', array('id' => 'nomform'));
                        echo '<p>';
                        echo form_label("Nom de famille", "name") . '</p><p>';
                        $data = array(
                            'name' => 'name',
                            'id' => 'name',
                            'placeholder' => 'Nom',
                            'class' => 'form-control',
                        );
                        echo form_input($data) . '</p><p>';

                        $button = array(
                            'name' => 'name_submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close() . '</p>';
                        ?>
                    </div>
                    <div id="prenom">
                        <?php
                        print form_open('/profil', array('id' => 'prenom'));
                        echo '<p>';
                        echo form_label("Prenom", "prenom") . '</p><p>';
                        $data = array(
                            'name' => 'prenom',
                            'id' => 'prenom',
                            'placeholder' => 'Prenom',
                            'class' => 'form-control',
                        );
                        echo form_input($data) . '</p><p>';

                        $button = array(
                            'name' => 'firstname_submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close() . '</p>';
                        ?>
                    </div>
                    <div id="email">
                        <?php
                        print form_open('/profil', array('id' => 'email'));
                        echo '<p>';
                        echo form_label("Email", "email") . '</p><p>';
                        $data = array(
                            'name' => 'email',
                            'id' => 'email',
                            'placeholder' => 'Email',
                            'class' => 'form-control',
                        );
                        print form_input($data) . '</p><p>';

                        $data = array(
                            'name' => 'confirmMail',
                            'id' => 'confirmMail',
                            'placeholder' => 'Confirmez votre email',
                            'class' => 'form-control',
                        );
                        print form_input($data) . '</p><p>';

                        $button = array(
                            'name' => 'mail_submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close() . '</p>';
                        ?>
                    </div>
                    <div id="avatar">
                        <?php echo form_open_multipart('/profil', array('id' => 'avatar'));
                        echo '<p>';
                        echo form_label("Avatar", "avatar") . '</p><p>';
                        $data = array(
                            'name' => 'userfile',
                            'type' => 'file',
                            'id' => 'userfile',
                            'class' => 'form-control',
                            'required' => 'required'
                        );
                        echo form_input($data) . '</p><p>';

                        $button = array(
                            'name' => 'avatar_submit',
                            'value' => 'Upload',
                            'class' => 'formsubmit',
                        );

                        echo form_submit($button) . '</p>';
                        echo form_close();
                        ?>
                    </div>
                    <div id="mdp">
                        <?php
                        print form_open('/profil', array('id' => 'password'));
                        echo '<p>';
                        echo form_label("Mot de passe", "mot de passe") . '</p><p>';
                        $data = array(
                            'name' => 'oldPwd',
                            'type' => 'password',
                            'id' => 'oldPwd',
                            'placeholder' => 'Votre ancien mot de passe',
                            'class' => 'form-control',
                        );
                        echo form_input($data) . '</p><p>';

                        $data = array(
                            'name' => 'newPwd',
                            'type' => 'password',
                            'id' => 'newPwd',
                            'placeholder' => 'Votre nouveau mot de passe',
                            'class' => 'form-control',
                        );
                        echo form_input($data) . '</p><p>';

                        $data = array(
                            'name' => 'confirmNewPwd',
                            'type' => 'password',
                            'id' => 'confirmOldPwd',
                            'placeholder' => 'Confirmation du nouveau mot de passe',
                            'class' => 'form-control',
                        );
                        echo form_input($data) . '</p><p>';

                        $button = array(
                            'name' => 'pwd_submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button) . '</p>';
                        print form_close();
                        ?>
                    </div>
                    <div id="qsec">
                        <?php
                        print validation_errors();
                        print form_open('/profil');
                        print '<p>';
                        print form_label("Question secrète", "question secrète") . '</p><p>';

                        $options = array(
                            'animal' => 'Quel est le nom de votre premier animal de compagnie?',
                            'voiture' => 'Quelle est la marque de votre première voiture?',
                            'ville' => 'Quel est le nom de votre ville de naissance?'
                        );

                        print form_dropdown('secret_questions', $options, 'animal', 'class="selectpicker"') . '</p><p>';
                        $data = array(
                            'name' => 'repScr',
                            'id' => 'repScr',
                            'placeholder' => 'Réponse',
                            'class' => 'form-control',
                        );
                        print form_input($data) . '</p><p>';

                        $button = array(
                            'name' => 'submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button) . '</p>';
                        print form_close();
                        ?>
                    </div>
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

        //$('.selectpicker').selectpicker();
    }
</script>