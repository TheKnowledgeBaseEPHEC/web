<header style="min-height: 30%;">
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Donnez votre feedback sur le cours!</h1></a>
        </div>
    </div>
</header>
<!--
                                <form class="form-horizontal" action="<?php $this->load->helper('url'); echo site_url('rating/add_rating');?>" method="post">
                                    <div>
                                        <!-- apres l'appel voip charger cette vue avec en data les deux id + id de la séance !!!-->

                                        <!-- Message body --> <!--
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="comment">Votre commentaire</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" id="comment" name="comment" placeholder="Entrez ici votre commentaire sur le cours..." rows="5"></textarea>
                                            </div>
                                        </div>

                                        <!-- Rating --> <!--
                                        <div class="form-group ">
                                            <label class="col-md-3 control-label" for="rating">Votre côte</label>
                                            <div class="col-md-9">
                                                <input name="rating" value="0" type="number" min=0 max=5 step=1 data-size="xs" required>
                                            </div>
                                        </div>

                                        <!-- Form actions --> <!--
                                        <div class="form-group">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary btn-md">Soummettre</button>
                                                <button type="reset" class="btn btn-default btn-md">Nettoyer</button>
                                            </div>
                                        </div>

</section>-->

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div id="content">
                    <?php
                    $this->load->helper('form');
                    echo form_open('rating/add_rating'); ?>
                    <?php echo form_input(array('id' => 'userRatingId', 'name' => 'userRatingId', 'value' => '56', 'class' => 'form-control')); ?><br />

                    <?php echo form_input(array('id' => 'userRatedId', 'name' => 'userRatedId', 'value' => '56', 'class' => 'form-control')); ?><br />

                    <?php echo form_input(array('id' => 'idSeance', 'name' => 'idSeance', 'value' => '5' , 'class' => 'form-control')); ?><br />

                    <?php
                    date_default_timezone_set("UTC");
                    $time = date("Y-m-d H:i:s", time());
                    ?>
                    <?php echo form_input(array('id' => 'date', 'name' => 'date', 'value' => $time , 'class' => 'form-control', 'type' => 'datetime')); ?><br />

                    <?php echo form_input(array('id' => 'status', 'name' => 'status', 'value' => 'rated' , 'class' => 'form-control', 'type' => 'text')); ?><br />

                    <?php echo form_textarea(array('id' => 'comment', 'name' => 'comment', 'class' => 'form-control', 'type' => 'text', 'rows' => '3')); ?><br />

                    <?php echo form_input(array('id' => 'rating', 'name' => 'rating', 'class' => 'form-control', 'value' => '5')); ?><br />

                    <?php echo form_submit(array('id' => 'submit', 'value' => 'Valider' , 'class' => 'btn btn-default formsubmit')); ?>
                    <?php echo form_close(); ?><br/>
                </div>
            </div>
        </div>
</section>
