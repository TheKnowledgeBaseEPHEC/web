<header style="min-height: 30%;">
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Ajout d'un cours</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div id="content">
                        <?php echo form_open('ajouter_cour'); ?>
                        <?php if (isset($message)) { ?>
                            <h3 style="color:green;">Le cours a bien été ajouté</h3><br>
                        <?php } ?>
                        <?php echo form_label('Intitulé du cours :'); ?> <?php echo form_error('IntituleCours'); ?><br />
                        <?php echo form_input(array('id' => 'IntituleCours', 'name' => 'IntituleCours', 'class' => 'form-control')); ?><br />

                        <?php echo form_label('École :'); ?> <?php echo form_error('Fac_Ecole_idEcole'); ?><br />
                        <?php echo form_input(array('id' => 'Fac_Ecole_idEcole', 'name' => 'Fac_Ecole_idEcole', 'class' => 'form-control')); ?><br />

                        <?php echo form_input(array('id' => 'idUser', 'name' => 'idUser', 'value' => $userId , 'class' => 'form-control', 'type' => 'hidden')); ?><br />

                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Valider' , 'class' => 'btn btn-default formsubmit')); ?>
                        <?php echo form_close(); ?><br/>
                </div>
            </div>
        </div>
</section>

<script>

</script>
