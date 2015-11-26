<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Merci de vouloir aider cette personne</h1></a>
        </div>
    </div>
</header>
<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <p><table class="table-tuto table-curved">
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Description</th>
                        <th>Disponibilités</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    foreach ($Personneaidee as $item) {?>
                        <tr>
                            <td><?php print $item->Nom;?></td>
                            <td><?php print $item->Prenom;?></td>
                            <td><?php print $item->DescriptionI;?></td>
                            <td><?php print $item->DisponibilitesI;?></td>
                            <td><?php print $item->Date;?></td>
                        </tr>
                    <?php  }
                    ?>
                </table></p>
                <?php
                if ($this->session->userdata('user_id') == $item->idUser)
                {
                    echo "<b>Vous ne pouvez pas vous aider vous même!</b>";
                } else {
                    print '<p>' . form_open('');
                    $button = array(
                        'name' => 'submitAide',
                        'value' => 'Confirmer mon aide pour ' . $item->Prenom . '',
                        'class' => 'formsubmit',
                    );
                    print  '</p>' . form_submit($button);
                    form_close();
                }
                ?>
                <?php
                print '<p>' . form_open('');
                $button = array(
                    'name' => 'consProfil',
                    'value' => 'consulter le profil de ' . $item->Prenom . '',
                    'class' => 'formsubmit',
                );
                print  '</p>' . form_submit($button);
                form_close();
                ?>
            </div>
        </div>
    </div>
</section>