<section class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center post__article">
                <p>Exemple de CSV:<br>
                    identificateur unique ; Prenom ; Nom de famille ; Email ; Mot de passe<br>

                    youri.mooton;youri;mouton;youri.mout@gmail.com;testA4
                    sim.asbtos;sim;sabb;test@test.com;asrtoien
                </p>
                <?php
                echo validation_errors();
                echo form_open_multipart('/csv');
                $data = array(
                    'name' => 'userfile',
                    'type' => 'file',
                    'id' => 'userfile',
                    'class' => 'form-control',
                    'required' => 'required'
                );
                echo form_input($data) . '</p><p>';

                $button = array(
                    'name' => 'csv_submit',
                    'value' => 'Upload',
                    'class' => 'formsubmit',
                );

                echo form_submit($button) . '</p>';
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</section>
