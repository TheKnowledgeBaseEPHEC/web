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
                    <?php
                    echo ($this->session->flashdata('deleteSc'));
                    echo ($this->session->flashdata('deleteDA'));
                    echo ($this->session->flashdata('deletePA'));
                    echo ($this->session->flashdata('confirmSc'));
                    echo ($this->session->flashdata('errorInt'));
                    echo ($this->session->flashdata('errorProp'));
                    ?>
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
                                'width' => '100%',
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
                    <?php
                    if ($userslug == null)
                    {
                        print anchor(base_url("editionprofil"), "Éditez votre profil", 'class="btn btn-block formsubmit"');
                    }
                    if ($userslug == $this->session->userdata('user_slug'))
                    {
                        print anchor(base_url("editionprofil"), "Éditez votre profil", 'class="btn btn-block formsubmit"');
                    } ?>

                </p>

                <hr class="light">

                <p><table class="table-tuto table-curved">
                    <p><h2>Mes demandes d'aide</h2></p>
                <tr>
                    <th>Cours</th>
                    <th>Description</th>
                    <th>Disponibilités</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($mesDemandes as $item) {?>
                    <tr>
                        <td><a href ='<?php echo base_url("/mesDemandesAide/$item->idInteret");?>'></a><?php print $item->NomCours;?></a></td>
                        <td><?php print $item->DescriptionI;?></td>
                        <td><?php print $item->DisponibilitesI;?></td>
                        <td><?php print $item->Date;?></td>
                    </tr>
                <?php  }
                ?>
                </table></p>
                <hr class="light">

                <p><table class="table-tuto table-curved">
                    <p><h2>Mes propositions d'aide</h2></p>
                <tr>
                    <th>Cours</th>
                    <th>Description</th>
                    <th>Rémunération</th>
                    <th>Disponibilités</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($mesPropositions as $item) {?>
                    <tr>
                        <td><a href ='<?php echo base_url("/mesPropAide/$item->idProposition");?>'></a><?php print $item->NomCours;?></a></td>
                        <td><?php print $item->DescriptionP;?></td>
                        <td><?php print $item->Remuneration;?></td>
                        <td><?php print $item->DisponibilitesP;?></td>
                        <td><?php print $item->Date;?></td>
                    </tr>
                <?php  }
                ?>
                </table></p>
                <hr class="light">
                <p><table class="table-tuto table-curved">
                    <p><h2>Mes séances </h2></p>
                <tr>
                    <th>De</th>
                    <th>Avec</th>
                    <th>Cours</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($mesSeances as $item) { ?>
                    <tr>
                        <td><a href ='<?php echo base_url("/maSeance/$item->idSeance");?>'></a><?php print $item->NomDemandeur;?></a></td>
                        <td><?php print $item->NomDemander; ?></td>
                        <td><?php print $item->IntituleCours; ?></td>
                        <td><?php
                            if ($item->confirmDemander == 1) {
                                print "OK";
                            } else {
                                print "En cours de confirmation";
                            }
                            ?>
                        </td>
                        <td><?php print $item->startDate; ?></td>
                    </tr>
                <?php  }
                ?>
                </table></p>
                <hr class="light">

                <p><table class="table-tuto table-curved">
                    <p><h2>Qui me demande? </h2></p>
                <tr>
                    <th>De</th>
                    <th>Cours</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($otherSeances as $item) { ?>
                    <tr>
                        <td><a href ='<?php echo base_url("/mesDemSc/$item->idSeance");?>'></a><?php print $item->NomDemandeur;?></a></td>
                        <td><?php print $item->IntituleCours; ?></td>
                        <td><?php print $item->startDate; ?></td>
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
        $('tr').click(function () {
            window.location = $(this).find('a').attr('href');
        }).hover(function () {
            $(this).toggleClass('hover');
        });
    }
</script>