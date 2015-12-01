
<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row post__article">
            <div class="col-md-6 col-md-offset-3">
                <table class="table-tuto table-curved">
                    <p><h2>Avis des utilisateurs</h2></p>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Utilisateur demandeur</th>
                        <th>Commentaire</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach($ratings as $rating) {
                        echo "<tr>
                                               <td scope=row>";
                        echo $i;
                        echo "</th>";
                        echo "</th>
                                      <td>$rating->NomDemandeur</td>";
                        if (($rating->comment) == 0){
                            echo "<td><b>Avis: </b> $rating->comment</td>";
                        } else {
                            echo "<td><b>non soumis</b></td>";
                        }
                        if (($rating->rating) != 0){
                            echo "<td><b>Note: </b> $rating->rating/5</td>";
                        } else {
                            echo "<td><b>non soumis</b></td>";
                        }
                        echo "</tr>";
                        $i = $i + 1;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


