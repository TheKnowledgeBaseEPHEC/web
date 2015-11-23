<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#univ">
                <h1>
                    <?php print $cours_data->IntituleCours ?>
                </h1>
            </a>
        </div>
    </div>
</header>

<section class="bg-primary" id="univ">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 text-center">
                <p><table class="table-tuto table-curved">
                        <p><h2>J'ai besoin d'aide pour ce cours</h2></p>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Description</th>
                        <th>Disponibilités</th>
                        <th>Date</th>
                    </tr>
                        <?php
                        foreach ($tutore as $item) {?>
                   <tr>
                        <td><a href ='<?php echo base_url("/confirmAide/$item->idInteret");?>'></a><?php print $item->Nom;?></a></td>
                        <td><?php print $item->Prenom;?></td>
                        <td><?php print $item->DescriptionI;?></td>
                        <td><?php print $item->DisponibilitesI;?></td>
                        <td><?php print $item->Date;?></td>
                    </tr>
                      <?php  }
                        ?>
                </table></p>
                <hr class="light">

               <p> <table class="table-tuto table-curved">
                    <p><h2>Je propose mon aide pour ce cours</h2></p>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Description</th>
                    <th>Rémunération</th>
                    <th>Disponibilités</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($tuteur as $tut) { ?>
                    <tr>
                        <td><a href ='<?php echo base_url("/confirmDemande/$tut->idProposition");?>'><?php print $tut->Nom;?></a></td>
                        <td><?php print $tut->Prenom;?></td>
                        <td><?php print $tut->DescriptionP;?></td>
                        <td><?php print $tut->Remuneration;?></td>
                        <td><?php print $tut->DisponibilitesP;?></td>
                        <td><?php print $tut->Date;?></td>
                    </tr>
                    </p>
                    <?php  }
                    ?>
                </table></p>
                <hr class="light">
                <?php
                //print $cours_data->idCours;
                print '<p>' . form_open('');
                $button = array(
                    'name' => 'submitProposition',
                    'value' => 'Proposer son aide pour ce cours',
                    'class' => 'formsubmit',
                );
                print  '</p>' . form_submit($button);
                $button = array(
                    'name' => 'submitInteret',
                    'value' => 'Demander de l\'aide pour ce cours',
                    'class' => 'formsubmit',
                );
                print  '</p>' . form_submit($button);
                form_close();
                /* print '<div class="row">';
                 print $cours_data->idCours;
                 print '</div>';*/
                ?>
            </div>
        </div>
    </div>
</section>
<script>
    window.onload = function() {
        $('tr').click(function () {
            window.location = $(this).find('a').attr('href');
        }).hover(function () {
            $(this).toggleClass('hover');
        });
    }
</script>