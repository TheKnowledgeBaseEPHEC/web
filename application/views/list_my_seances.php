<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style>
        .modal-header, h4, .close {
            background-color: #f05f40;
            color:white !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-footer {
            background-color: #f9f9f9;
        }
    </style>
</head>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Voici vos séances terminées</h1></a>
        </div>
    </div>
</header>

<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row post__article">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    <div>
                        <div id="content"><table class="table-tuto table-curved">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Professeur choisi</th>
                                    <th>Date</th>
                                    <th>Commentaire</th>
                                    <!--<th>Paiement</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                foreach($seances as $seance) {
                                    echo "<tr>
                                            <td scope=row>";
                                    echo $i;
                                    echo "</th>";
                                    echo "</th>

                                            <td>$seance->NomDemander</td>
                                            <td>$seance->startDate</td>

                                            ";
                                    if (($seance->rating) != 0){
                                        echo "<td><b>Note: </b>$seance->rating/5 <b>Avis: </b> $seance->comment</td>";
                                    } else {
                                        echo "<td><a class='btn' id=myBtn_rating value=$seance->idSeance href='/profil/soumettre_avis/$seance->idSeance'>Commenter</a></td>";
                                    }
                                    $i = $i + 1;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>



