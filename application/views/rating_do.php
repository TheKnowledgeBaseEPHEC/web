<header style="min-height: 30%;">
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Donnez votre feedback sur le cours!</h1></a>
        </div>
    </div>
</header>


<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row post__article">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                        <div>
                            <form action="../submit_rating" method="post">
                            <div>
                                <?php echo "<input type=hidden class=form-control name=idSeance id=idSeance  value=$idSeance required>" ;?>
                            </div>
                            <div class="form-group">
                                <label for="comment"><span class="glyphicon glyphicon-comment"></span> Commentaire</label>
                                <textarea class="form-control" name="comment" id="comment" placeholder="Entrez ici votre feedback sur le cours qui vous a été donné" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rating" required><span class="glyphicon glyphicon-star"></span> Votre côte sur 5:</label>
                                <input style="color:black" value="5" type="number" name="rating" id="rating" min="1" max="5" step="1">
                            </div>
                            <input type="submit" class="btn btn-block formsubmit" id="btnSave">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
