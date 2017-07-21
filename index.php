<?php
require_once("inc/init.inc.php");












require("inc/header.inc.php");
require("inc/nav.inc.php");
?>


        <div class="container">

            <div class="starter-template">
                <h1>Accueil</h1>
                <?= $message ?>
            </div><!--/.starter-template -->

        </div><!-- /.container -->
        
        <div class="container">

        <div class="row">

            <div class="col-md-3" >
                <p class="lead">Catégorie</p>
                <div class=" list-group">
                    <a href="#" class="list-group-item">Réunion</a>
                    <a href="#" class="list-group-item">Bureau</a>
                    <a href="#" class="list-group-item">Formation</a>
                </div>

                <p class="lead">Ville</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Paris</a>
                    <a href="#" class="list-group-item">Lyon</a>
                    <a href="#" class="list-group-item">Marseille</a>
                </div>

                <p class="lead">Capacité</p>
                <div class="list-group">
                <input type="number" min="6" max="30" class="well-sm"/>
                </div>

                <p class="lead">Prix</p>
                <div class="list-group">
                <input type="range" min="500" max="1000" class="" />
                </div>

                <p class="lead">Date d'arrivée</p>
                <div class="list-group">
                <input type="date" class="well-sm" />
                </div>

                <p class="lead">Date de départ</p>
                <div class="list-group">
                <input type="date" class="well-sm" />
                </div>

            </div>

            

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active" ></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="img/crorange.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="img/crview.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="img/crbricks.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>
<?php
                for($i = 0; $i < 5; $i++)
                {
?>                

                

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="img/crview.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$24.99</h4>
                                <h4><a href="#">First Product</a>
                                </h4>
                                <p>Plus de détails sur ce salle<a target="_blank" href="item.php">Item</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>
<?php
                }
?>                    





                    
                    

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    

    <hr>

        

<?php
require("inc/footer.inc.php")
?>
