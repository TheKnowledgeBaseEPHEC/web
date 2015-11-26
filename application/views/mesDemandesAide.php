<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Demande d'aide</h1></a>
        </div>
    </div>
</header>
<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <p><table class="table-tuto table-curved">
                <tr>
                    <th>Cours</th>
                    <th>Description</th>
                    <th>Disponibilités</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($Personneaidee as $item) {?>
                    <tr>
                        <td><?php print $item->NomCours;?></td>
                        <td><?php print $item->DescriptionI;?></td>
                        <td><?php print $item->DisponibilitesI;?></td>
                        <td><?php print $item->Date;?></td>
                    </tr>
                <?php  }
                ?>
                </table></p>
                <?php
                    print '<p>' . form_open('');
                    $button = array(
                        'name' => 'deleteDemAide',
                        'value' => 'Supprimer',
                        'class' => 'formsubmit',
                    );
                    print  '</p>' . form_submit($button);
                    form_close();
                ?>
            </div>
        </div>
    </div>
</section>