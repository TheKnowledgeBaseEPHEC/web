<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Bienvenue sur votre profil</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="content">
                    <div class="signup_wrap">
                    </div><!--<div class="signup_wrap">-->
                    </div><!--<div id="content">-->
                    <div class="container">
                        <table class="table">
                            <tr>
                                <td>Nom</td>
                                <td><?php echo $this->session->userdata('user_data')['nom']; ?></td>
                            </tr>
                            <tr>
                                <td>Prenom</td>
                                <td><?php echo $this->session->userdata('user_data')['prenom']; ?></td>
                            </tr>
                            <tr>
                                <td>Adresse Email</td>
                                <td><?php echo $this->session->userdata('user_data')['email']; ?></td>

                            </tr>
                            <tr>
                                <td>Image d'avatar</td>
                                <td><?php
                                    $this->load->model('Profil_model');
                                    $idUser = $this->session->userdata('user_data')['id'];
                                    $imagePath = $this->Profil_model->recupPImg($idUser);
                                    $this->load->helper('html');
                                    echo img($imagePath);
                                    ?></td>
                            </tr>
                        </table>
                    </div>
                <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
                <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
                <div id="tabs">
                    <ul>
                        <li>
                            <a href="#a">Nom</a>
                        </li>
                        <li>
                            <a href="#b">Prenom</a>
                        </li>
                        <li>
                            <a href="#c">Adresse Mail</a>
                        </li>
                        <li>
                            <a href="#d">Avatar</a>
                        </li>
                    </ul>
                    <div id="a">
                        <?php
                        print form_open('/modifName');
                        $data = array(
                            'name' => 'name',
                            'id' => 'name',
                            'placeholder' => 'Nom',
                            'class' => 'form-control',
                        );
                        echo form_input ($data);

                        $button = array(
                            'name' => 'submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        echo form_close();
                        ?>
                    </div>
                    <div id="b">
                        <?php
                        print form_open('/modifPrenom');
                        $data = array(
                            'name' => 'prenom',
                            'id' => 'prenom',
                            'placeholder' => 'Prenom',
                            'class' => 'form-control',
                        );
                        echo form_input ($data);

                        $button = array(
                            'name' => 'submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        echo form_close();
                        ?>
                    </div>
                    <div id="c">
                        <?php
                        print form_open('/modifMail');
                        $data = array(
                            'name' => 'email',
                            'id' => 'email',
                            'placeholder' => 'Email',
                            'class' => 'form-control',
                        );
                        echo form_input ($data);

                        $button = array(
                            'name' => 'submit',
                            'value' => 'Modifier',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        echo form_close();
                        ?>
                    </div>
                    <div id="d">
                        <?php echo form_open_multipart('/upload');?>
                        <?php
                        $data = array(
                            'name' => 'userfile',
                            'type' => 'file',
                            'id' => 'userfile',
                        );
                        echo form_input ($data);

                        $button = array(
                            'name' => 'submit',
                            'value' => 'Upload',
                            'class' => 'formsubmit',
                        );
                        print form_submit($button);
                        echo form_close();
                        ?>
                    </div>
                </div>
                <script>
                    $('#tabs')
                        .tabs()
                        .addClass('ui-tabs-vertical ui-helper-clearfix');
                </script>
                    <p><?php
                    print form_open('/deconnexion');
                    $button = array(
                        'name' => 'deconnexion',
                        'value' => 'Deconnexion',
                        'class' => 'formsubmit',
                    );
                    print form_submit($button);
                    echo form_close();
                    ?>
                    </p>
                    </body>
                    </html>
                </div><!--<div class="content">-->
            </div>
        </div>
    </div>
</section>
