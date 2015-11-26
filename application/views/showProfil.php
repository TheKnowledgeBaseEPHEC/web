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
                 </p>
                </div>
            </div>
        </div>
    </section>

