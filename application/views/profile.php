<?php $data = reset($user_data); ?>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Profile Utilisateur</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                print '<div class="row">';
                print 'User : ' . $data->Prenom . ' ' . $data->Nom;
                print '</div>';
                ?>
            </div>
        </div>
    </div>
</section>
