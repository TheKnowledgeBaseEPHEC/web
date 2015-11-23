<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row post__article">
            <div class="col-md-6 col-md-offset-3">
                <?php
                $validation_errors = $this->session->flashdata('validation_errors');
                if (!empty($validation_errors)) {
                    if (is_array($validation_errors)) {
                        $validation_errors_count = count($validation_errors);
                        $validation_errors_keys = array_keys($validation_errors);

                        for ($i = 0; $i < $validation_errors_count; $i++) {
                            echo '<label class="error"><i class="fa fa-exclamation-triangle"></i>';
                            echo $validation_errors[$validation_errors_keys[$i]] . '</label>';
                            echo '<hr class="light">';
                        }
                    } else {
                        echo '<label class="error"><i class="fa fa-exclamation-triangle"></i>';
                        echo $validation_errors . '</label>';
                        echo '<hr class="light">';
                    }
                }
                $error = $this->session->flashdata('upload_error');
                if (!empty($error)) {
                    echo "<label class='error'><i class='fa fa-exclamation-triangle'></i> $error</label>";
                }
                ?>
                <p>
                <h2>Profil</h2>
                <table class="table-curved">
                    <tr>
                        <td class="toptd">Nom</td>
                        <td class="toptd"><?php echo $user->nom; ?></td>
                    </tr>
                    <tr>
                        <td>Prenom</td>
                        <td><?php echo $user->prenom; ?></td>
                    </tr>
                    <tr>
                        <td>Adresse Email</td>
                        <td><?php echo $user->email; ?></td>
                    </tr>
                    <tr>
                        <td>Image d'avatar</td>
                        <td><?php
                            $this->load->model('Profil_model');
                            $idUser = $user->id;
                            $this->load->helper('html');
                            $image_properties = array(
                                'src' => $user->avatar,
                                'alt' => 'erreur de chargement',
                                'class' => 'post_image',
                                'width' => '200',
                                'height' => '200',
                                'title' => 'photo avatar',
                                'rel' => 'lightbox',
                            );
                            echo img($image_properties);
                            ?></td>
                    </tr>
                </table>
                </p>
                <p>
                <?= print anchor(base_url("editionprofil"), "Éditez votre profil", 'class="btn btn-block formsubmit"'); ?>
                </p>

                <hr class="light">

                <p><table class="table-tuto">
                    <p><h2>Mes demandes d'aide</h2></p>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Description</th>
                    <th>Disponibilités</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($mesDemandes as $item) {?>
                    <tr>
                        <td><a href ='<?php echo base_url("/confirmAide/$item->idInteret");?>'></a></td>
                        <td><?php print $item->Nom;?></td>
                        <td><?php print $item->Prenom;?></td>
                        <td><?php print $item->DescriptionI;?></td>
                        <td><?php print $item->DisponibilitesI;?></td>
                        <td><?php print $item->Date;?></td>
                    </tr>
                <?php  }
                ?>
                </table></p>
                <hr class="light">

                <p><table class="table-tuto">
                    <p><h2>Mes propositions d'aide</h2></p>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Description</th>
                    <th>Rémunération</th>
                    <th>Disponibilités</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($mesPropositions as $item) {?>
                    <tr>
                        <td><a href ='<?php echo base_url("/confirmAide/$item->idInteret");?>'></a></td>
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
                <hr class="light">

                <p><table class="table-tuto">
                    <p><h2>Mes scéances </h2></p>
                <tr>
                    <th></th>
                    <th>Avec</th>
                    <th>Cours</th>
                    <th>Pour être aidé</th>
                    <th>Pour aider</th>
                    <th>Votre confirmation</th>
                    <th>Sa confirmation</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($mesSeances as $item) { ?>
                <tr>
                    <td><a href='<?php echo base_url("/confirmAide/$item->idInteret"); ?>'></a></td>
                    <td><?php print $item->NomDemander; ?></td>
                    <td><?php print $item->idCours; ?></td>
                    <td><?php
                        if ($item->isDemandeAide == 0) {
                            print "Oui";
                        } else {
                            print "Non";
                        }
                            ?></td>
                        <td><?php
                            if ($item->isDemandeAide == 1){
                                print "Oui";
                            } else {
                                print "Non";
                            }
                            ?></td>
                        <td><?php
                            if ($item->confirmDemandeur == 1) {
                                print "OK";
                            } else {
                                print "NOK";
                            }
                            ?></td>
                        <td><?php
                            if ($item->confirmDemander == 1) {
                                print "OK";
                            } else {
                                print "NOK";
                            }
                            ?></td>
                        <td></td>
                    </tr>
                <?php  }
                ?>
                </table></p>
                <hr class="light">

                <p><table class="table-tuto">
                    <p><h2>Qui me demande? </h2></p>
                <tr>
                    <th></th>
                    <th>De</th>
                    <th>Cours</th>
                    <th>Je dois l'aider</th>
                    <th>Il veut m'aider</th>
                    <th>Sa confirmation</th>
                    <th>Votre confirmation</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($otherSeances as $item) { ?>
                    <tr>
                        <td><a href='<?php echo base_url("/confirmAide/$item->idInteret"); ?>'></a></td>
                        <td><?php print $item->NomDemandeur; ?></td>
                        <td><?php print $item->idCours; ?></td>
                        <td><?php
                            if ($item->isDemandeAide == 0) {
                                print "Oui";
                            } else {
                                print "Non";
                            }
                            ?></td>
                        <td><?php
                            if ($item->isDemandeAide == 1){
                                print "Oui";
                            } else {
                                print "Non";
                            }
                            ?></td>
                        <td><?php
                            if ($item->confirmDemandeur == 1) {
                                print "OK";
                            } else {
                                print "NOK";
                            }
                            ?></td>
                        <td><?php
                            if ($item->confirmDemander == 1) {
                                print "OK";
                            } else {
                                print "NOK";
                            }
                            ?></td>
                        <td></td>
                    </tr>
                <?php  }
                ?>
                </table></p>
            </div>
        </div>
    </div>
</section>

<script>
    window.onload = function() {
        $('.post__article').scrollNav({
            fixedMargin: 60,
            scrollOffset: 80,
            headlineText: 'Navigation',
            arrowKeys: true,
            sectionElem: 'div',
            showTopLink: false,
        });

        var $item = $('.scroll-nav__item');
        $.each($item, function(){
            $text = $(this).find('a').html().toLowerCase();
            $(this).addClass($text);
        });
    }
</script>