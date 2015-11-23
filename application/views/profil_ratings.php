<section class="" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Avis des utilisateurs</h2>
            </div>
            <div class="col-md-8">
                <div id="content"><table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Utilisateur</th>
                            <th>Commentaire</th>
                            <th>Note</th>
                            <th>Cours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach($ratings as $rating) {
                            echo "<tr>
                                    <th scope=row>";
                            echo $i;
                            echo "</th>";
                            echo "</th>
                                    <td>$rating->userRatingId</td>
                                    <td>$rating->comment</td>
                                    <td>$rating->rating/5</td>
                                    <td>$rating->idSeance</td>
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
