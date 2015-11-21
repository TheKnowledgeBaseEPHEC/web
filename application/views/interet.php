<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Merci de manifester votre intérêt pour ce cours</h1></a>
        </div>
    </div>
</header>
<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2>Avant de confirmer votre intérêt pour le cours de  <?php print $cours_data->IntituleCours ?>, complétez les informations suivantes:</h2>
                <?php
                print '<p>' . form_open('');
                echo form_label("Pourquoi choisissez-vous ce cours?", "description");
                $data = array(
                    'name' => 'descriptionI',
                    'id' => 'description',
                    'rows' => 5,
                    'cols' => 40,
                    'class' => 'form-control',
                    'required' => 'required'
                );
                echo form_textarea($data);

                echo form_label("Donnez vos disponibilités (exemple: lundi et samedi)", "disponibilites");
                $data = array(
                    'name' => 'disponibilitesI',
                    'id' => 'disponibilites',
                    'class' => 'form-control',
                    'required' => 'required'
                );
                echo form_input($data);

                $button = array(
                    'name' => 'submitI',
                    'value' => 'Confirmer',
                    'class' => 'formsubmit',
                );
                print  '</p>' . form_submit($button);
                form_close();
                ?>

            </div>
        </div>
    </div>
</section>