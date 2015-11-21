<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1><?php echo $user->nom.' '.$user->prenom;?></h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
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
                <?php
                if ($userslug === $this->session->userdata('user_slug'))
                {
                    echo "<b><p>Vous n'allez quand même pas vous faire une demmande à vous même!?</p></b>";
                } else {
                    if ($userslug === null)
                    {
                    echo "<p><b>Bienvenue sur votre profil</b></p>";
                    } else {
                        print form_open('', array('id' => 'interet'));
                        echo '<p>';
                        $button = array(
                            'name' => 'interet_submit',
                            'value' => 'Je suis intéressé par cette personne',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        print form_close() . '</p>';
                    }
                }
                ?>

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

                <p> <table class="table-seances">
                    <p><h2>J'aimerais être tutoré par</h2></p>
                <tr>
                    <th></th>
                    <th>Nom du cours</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($sceancesDemandeur as $item) { ?>
                    <tr>
                        <td><?php print $item->idDemander;?></td>
                        <td><?php print $item->NomCours;?></td>
                        <td><?php  print form_open('');
                                $button = array(
                                    'name' => 'firstname_submit',
                                    'value' => 'Confirmer',
                                    'class' => 'formsubmit',
                                );
                                print form_submit($button);
                                print form_close() . '</p>';?></td>
                        <td><?php print $item->startDate;?></td>
                    </tr>
                    </p>
                    <?php  }
                ?>

                </table></p>
                <hr class="light">

                <p> <table class="table-seances">
                    <p><h2>M'ont demandé comme tuteur</h2></p>
                <tr>
                    <th></th>
                    <th>Nom du cours</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($sceancesDemander as $item) { ?>
                    <tr>
                        <td><?php print $item->idDemandeur;?></td>
                        <td><?php print $item->NomCours;?></td>
                        <td><?php  print form_open('');
                                $button = array(
                                    'name' => 'firstname_submit',
                                    'value' => 'Confirmer',
                                    'class' => 'formsubmit',
                                );
                                print form_submit($button);
                                print form_close() . '</p>';?></td>
                        <td><?php print $item->startDate;?></td>
                    </tr>
                    </p>
                    <?php  }
                ?>
                </table></p>

                <p> <table class="table-seances">
                    <p><h2>Mes séances confirmées</h2></p>
                <tr>
                    <th></th>
                    <th>Nom du cours</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($sceancesDemander as $item) { ?>
                    <tr>
                        <td><?php print $item->idDemandeur;?></td>
                        <td><?php print $item->NomCours;?></td>
                        <td><?php  print form_open('');
                                $button = array(
                                    'name' => 'firstname_submit',
                                    'value' => 'Confirmer',
                                    'class' => 'formsubmit',
                                );
                                print form_submit($button);
                                print form_close() . '</p>';?></td>
                        <td><?php print $item->startDate;?></td>
                    </tr>
                    </p>
                    <?php  }
                ?>
                </table></p>
            </div>
        </div>
    </div>
</section>