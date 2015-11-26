<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Voici vos ratings</h1></a>
        </div>
    </div>
</header>

<section class="" id="profile">
    <div class="container">
        <div class="row">
            <!--<div class="col-md-4"></div>
            <div class="col-md-8">-->
            <div>
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
