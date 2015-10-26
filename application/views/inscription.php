<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#inscription"><h1>Inscription</h1></a>
        </div>
    </div>
</header>
<section class="bg-primary" id="inscription">
    <div class="container">
        <div class="row">

            <?php
            echo form_open('form/valid_form');
            echo form_label('inscription', 'inscription');
            ?>

            <h5>Nom d'utilisateur</h5>
            <input type="text" name="username" value="" size="50" />

            <h5>Mot de passe</h5>
            <input type="text" name="password" value="" size="50" />

            <h5>Confirmation du mot de passe</h5>
            <input type="text" name="passconf" value="" size="50" />

            <h5>Adresse email</h5>
            <input type="text" name="email" value="" size="50" />

            <p></p><div><input type="submit" value="Submit" /></div></p>

            </form>
            <?php
            print '<div class="row">';
            //print 'User : ' . $user_data->Prenom . ' ' . $user_data->Nom;
            var_dump($user_data);
            print '</div>';
            ?>
        </div>
    </div>
</section>