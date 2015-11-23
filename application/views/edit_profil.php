<section class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <?php
                    $this->load->model('Profil_model');
                    $this->load->helpers('html');
                ?>
                <h2>Editez votre profil</h2>

                <div id="tabs">
                    <div id="nom">
                        <?php
                        echo validation_errors();
                        print form_open('/editionprofil', array('id' => 'nomform'));
                        echo '<p>';
                        echo form_label("Nom de famille", "name") . '</p><p>';
                        $data = array(
                            'name' => 'name',
                            'id' => 'name',
                            'value' => $user->nom,
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
                        print form_open('/editionprofil', array('id' => 'prenom'));
                        echo '<p>';
                        echo form_label("Prenom", "prenom") . '</p><p>';
                        $data = array(
                            'name' => 'prenom',
                            'id' => 'prenom',
                            'value' => $user->prenom,
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
                        print form_open('/editionprofil', array('id' => 'email'));
                        echo '<p>';
                        echo form_label("Email", "email") . '</p><p>';
                        $data = array(
                            'name' => 'email',
                            'id' => 'email',
                            'value' => $user->email,
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
                        <?php echo form_open_multipart('/editionprofil', array('id' => 'avatar'));
                        echo '<p>';
                        echo form_label("Avatar", "avatar") . '</p><p>';

                        $image_properties = array(
                            'src' => $user->avatar,
                            'alt' => 'erreur de chargement',
                            'class' => 'post_image',
                            'width' => '200',
                            'height' => '200',
                            'title' => 'photo avatar',
                            'rel' => 'lightbox',
                        );
                        echo '<p>'.img($image_properties).'</p>';

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
                        print form_open('/editionprofil', array('id' => 'password'));
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
                        print form_open('/editionprofil');
                        print '<p>';
                        print form_label("Question secrète", "question secrète") . '</p><p>';

                        echo '
                        <p><select class="show-menu-arrow form-control" style="width: 100%">
                            <option value="animal">Quel est le nom de votre premier animal de compagnie?</option>
                            <option value="voiture">Quelle est la marque de votre première voiture?</option>
                            <option value="ville">Quel est le nom de votre ville de naissance?</option>
                        </select></p>';

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
