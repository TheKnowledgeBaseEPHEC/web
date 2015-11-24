<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Voici vos séances terminées</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <div id="content">
                        <table class="table-tuto table-curved">
                        <thead>
                        <tr>
                            <th>Temps écoulé lors de la séance</th>
                            <th>Professeur choisis</th>
                            <th>A payer</th>
                            <th>Cours choisis</th>
                            <th>Commentaire</th>
                            <th>Paiement</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach($seances as $seance) {
                            echo "</th>
                                    <td>$seance->temps secondes</td>
                                    <td>$seance->NomDemander</td>
                                    <td>$seance->toPay €</td>
                                    <td>$seance->idCours</td>
                                    ";
                            if (($seance->idRating) != 0){
                                echo "<td>$seance->idRating</td>";
                            } else {
                                echo "<td><a>Merci d'ajouter un commentaire</a></td>";
                            }

                            if (($seance->paymentStatus) != 0){
                                echo "<td>$seance->paymentStatus</td>";
                            } else {
                                echo "<td><a>Veuillez effectuer le paiement</a></td>";
                            }
                            echo "
                                   </tr>";
                            $i = $i + 1;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
