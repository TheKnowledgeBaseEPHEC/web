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
                    <?php
                        $error = $this->session->flashdata('upload_error');
                        if (!empty($error)) {
                        echo "<label class='error'><i class='fa fa-exclamation-triangle'></i> $error</label>";
                    }
                    ?>
                    <table class="table">
                        <tr>
                            <td>Nom</td>
                            <td><?php echo $this->session->userdata('user_nom'); ?></td>
                        </tr>
                        <tr>
                            <td>Prenom</td>
                            <td><?php echo $this->session->userdata('user_prenom'); ?></td>
                        </tr>
                        <tr>
                            <td>Adresse Email</td>
                            <td><?php echo $this->session->userdata('user_email'); ?></td>

                        </tr>
                        <tr>
                            <td>Image d'avatar</td>
                            <td><?php
                                $image_properties = array (
                                    'src' => $this->session->userdata('user_avatar'),
                                    'alt' => 'erreur de chargement',
                                    'class' => 'post_image',
                                    'width' => '200',
                                    'height' => '200',
                                    'title' => 'photo avatar',
                                    'rel' =>'lightbox',
                                );
                                echo img($image_properties);
                                ?></td>
                        </tr>
                    </table>
                </div>
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
                        print form_submit($button) . form_close();
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
                        print form_submit($button) . form_close();
                        ?>
                    </div>
                    <div id="d">
                        <?php echo form_open_multipart('/profil');

                        $data = array(
                            'name' => 'userfile',
                            'type' => 'file',
                            'id' => 'userfile',
                            'class' => 'form-control',
                            'required' => 'required'
                        );
                        echo form_input($data);

                        $button = array(
                            'name' => 'avatar_submit',
                            'value' => 'Upload',
                            'class' => 'formsubmit',
                        );

                        echo form_submit($button);
                        echo form_close();
                        ?>
                    </div>
                </div>
                <p>
                    <?php
                        print anchor(base_url("logout"), "se déconnecter", 'class="btn formsubmit"');
                    ?>
                </p>
            </div>
        </div>
    </div>
    </div>
</section>

<script>
    window.onload = function() {
        $('#tabs')
            .tabs()
            .addClass('ui-tabs-vertical ui-helper-clearfix');
    }
</script>