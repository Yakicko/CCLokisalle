<?php
require_once("inc/init.inc.php");

if(empty($_GET['categorie']))
{
    //$liste_salle = $pdo->query("SELECT * FROM salle, produit WHERE salle.id_salle = produit.id_salle");
    $liste_salle = $pdo->query("SELECT * FROM salle");
}else{
    $cat = $_GET['categorie'];
    //$liste_salle = $pdo->prepare("SELECT * FROM salle, produit WHERE salle.id_salle = produit.id_salle AND categorie = :categorie");
	$liste_salle = $pdo->prepare("SELECT * FROM salle WHERE categorie = :categorie");
	$liste_salle->bindParam(":categorie", $cat, PDO::PARAM_STR);
	$liste_salle->execute();
}


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
<?php
            $liste_categorie = $pdo->query("SELECT DISTINCT categorie FROM salle");

            echo   '<p class="lead">Catégorie</p>';
            echo    '<div class=" list-group">';

            while($categorie = $liste_categorie->fetch(PDO::FETCH_ASSOC))
            {
                
                echo        '<a href="?categorie=' . $categorie['categorie'] . '" class="list-group-item">' . $categorie["categorie"] . '</a>';
                
            }

            echo    '</div>';
            $liste_ville = $pdo->query("SELECT DISTINCT ville FROM salle");

            echo    '<p class="lead">Ville</p>';
            echo    '<div class="list-group">';

            while($ville = $liste_ville->fetch(PDO::FETCH_ASSOC))
            {
                
                echo       '<a href="?ville=' . $ville['ville'] . '" class="list-group-item">' . $ville['ville'] . '</a>';
                
            } 
            echo    '</div>';   
?>
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
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-bottom:30px;">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active" ></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="img/office-space-1744803_1920.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="img/table-2469046_1920.jpg" alt="">
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

                
<?php
                //for($i = 0; $i < 5; $i++)
                $compteur = 0;
                while($salle = $liste_salle->fetch(PDO::FETCH_ASSOC))
                {
                    if($compteur % 3 == 0 && $compteur != 0 )
                    {
                        echo '</div><div class="row">';
                    }
                        $compteur++;
                    
               

                

                    echo '<div class="col-sm-4 col-lg-4 col-md-4">';
                    echo    '<div class="thumbnail">';
                    echo        '<img src="' . URL . 'photo/' . $salle['photo'] . '" class="img-responsive" />';
                    echo        '<div class="caption">';
                    echo            '<p>Plus de détails sur ce salle<br /><a href="item.php?id_salle=' . $salle['id_salle'] . '">Cliquez ici.</a></p>';
                    echo        '</div>';
                    echo        '<div class="ratings">';
                    echo            '<p class="pull-right">15 reviews</p>';
                    echo            '<p>';
                    echo                '<span class="glyphicon glyphicon-star"></span>';
                    echo                '<span class="glyphicon glyphicon-star"></span>';
                    echo                '<span class="glyphicon glyphicon-star"></span>';
                    echo                '<span class="glyphicon glyphicon-star"></span>';
                    echo                '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo            '</p>';
                    echo        '</div>';
                    echo    '</div>';
                    echo '</div>';

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
