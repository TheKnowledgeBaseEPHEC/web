<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Bienvenue sur le profil de profil</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

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
            </div>
        </div>
    </div>
</section>