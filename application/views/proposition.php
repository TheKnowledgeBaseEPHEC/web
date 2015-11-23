<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Merci de vous proposer pour ce cours</h1></a>
        </div>
    </div>
</header>
<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 text-center">
                <h2>Avant de confirmer votre proposition pour le cours de <?php print $cours_data->IntituleCours ?>, complétez les informations suivantes:</h2>
                <?php
                    print '<p>' . form_open('');
                    echo form_label("Donnez une brève description technique du cours et des méthodes d'enseignement", "description");
                    $data = array(
                        'name' => 'descriptionP',
                        'id' => 'description',
                        'rows' => 5,
                        'cols' => 40,
                        'class' => 'form-control',
                        'required' => 'required'
                    );
                    echo form_textarea($data);

                    echo form_label("Quelle rémunération allez-vous demander à votre tutoré?", "remuneration");
                    $data = array(
                        'name' => 'remuneration',
                        'id' => 'remuneration',
                        'class' => 'form-control',
                        'required' => 'required'
                    );
                    echo form_input($data);

                    echo form_label("Donnez vos disponibilités (exemple: lundi et samedi)", "disponibilites");
                    $data = array(
                        'name' => 'disponibilitesP',
                        'id' => 'disponibilites',
                        'class' => 'form-control',
                        'required' => 'required'
                    );
                    echo form_input($data);

                    $button = array(
                        'name' => 'submitP',
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
