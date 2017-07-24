<?php
require_once("inc/init.inc.php");

if(empty($_GET['id_salle']) || !is_numeric($_GET['id_salle']))
{
	header("location:index.php");
}

$id_salle = $_GET['id_salle'];
$recup_salle = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :id_salle");
$recup_salle->bindParam(":id_salle", $id_salle, PDO::PARAM_STR);
$recup_salle->execute();

if($recup_salle->rowCount() < 1)
{
    header("location:index.php");
}

$produit = $recup_salle->fetch(PDO::FETCH_ASSOC);








require("inc/header.inc.php");
require("inc/nav.inc.php");
?>


        <div class="container">

            <div class="starter-template">
                <h1>Template CCLokisalle</h1>
                <?= $message ?>
            </div><!--/.starter-template -->

        </div><!-- /.container -->

         <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
<?php            
                echo '<h1 class="page-header">'. $produit["titre"] . '</h1>';
                
           echo  '</div>';
       echo  '</div>';
       echo  '<!-- /.row -->';

         echo '<!-- Portfolio Item Row -->';
         echo '<div class="row">';
            echo '<div class="col-md-8">';
                echo '<img class="img-responsive" src="' . URL . 'photo/' . $produit["photo"] . '" alt="">';        
                echo  '</div>';
                echo '<div class="col-md-4">';            
                echo  '<h3>Description</h3>';   
               echo '<p>' . $produit["description"] .'</p>';
               echo '<h3>Capacité</h3>';
               echo '<p>' . $produit["capacite"] .'</p>';
               echo '<hr />';

               $adresse_sans_espace = str_replace(' ', '+', $produit['adresse']); 
               $ville_sans_espace = str_replace(' ', '+', $produit['ville']); 
               $adresse_gmap = $adresse_sans_espace . ',+' . $produit['cp'] . '+' . $ville_sans_espace;

               echo '<h5 style="margin-bottom: 20px;font-weight:bold;">' . $produit["adresse"] . ' ' . $produit["cp"] . ', ' . $produit["ville"] . '</h5>'; 


               echo '<iframe width="100%" height="auto" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q='.$adresse_gmap.'&output=embed"></iframe>
';  
           echo '</div>';
?>
        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Related Projects</h3>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

        <hr>

<?php
require("inc/footer.inc.php")
?>
