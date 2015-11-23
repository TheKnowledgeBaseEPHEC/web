<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Merci pour votre demande</h1></a>
        </div>
    </div>
</header>
<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <p><table class="table-tuto">
                    <p><h2>Vous confirmez?</h2></p>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Description</th>
                    <th>Remuneration</th>
                    <th>Disponibilités</th>
                    <th>Date</th>
                </tr>
                <?php
                //$personneDA = personne qui demande de l'aide
                foreach ($personneDA as $item) {?>
                    <tr>
                        <td><?php print $item->Nom;?></td>
                        <td><?php print $item->Prenom;?></td>
                        <td><?php print $item->DescriptionP;?></td>
                        <td><?php print $item->Remuneration;?></td>
                        <td><?php print $item->DisponibilitesP;?></td>
                        <td><?php print $item->Date;?></td>
                    </tr>
                <?php  }
                ?>
                </table></p>
                <?php
                if ($this->session->userdata('user_id') == $item->idUser) {
                    echo "<b>Vous ne pouvez pas vous aider vous même!</b>";
                } else {
                    print '<p>' . form_open('');
                    $button = array(
                        'name' => 'submitDemandeAide',
                        'value' => 'Demander l\'aide de ' . $item->Prenom . '',
                        'class' => 'formsubmit',
                    );
                    print  '</p>' . form_submit($button);
                    form_close();
                }
                ?>
            </div>
        </div>
    </div>
</section>