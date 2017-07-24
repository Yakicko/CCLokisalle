<?php
require_once("../inc/init.inc.php");


if(!isAdmin())
{
    header("location:" . URL . "index.php");
}
// Déclaration des variables
$erreur = "";

$titre = "";
$description = "";
$pays = "";
$ville = "";
$adresse = "";
$cp = "";
$capacite = "";
$categorie = "";

// SUPPRESSION DANS LA BASE DE DONNER
if(isset($_GET["action"],$_GET["id"]) && $_GET["action"] == "supprimer" && is_numeric($_GET["id"]))
{
    $id_salle = $_GET["id"];
    $salle_supprimer = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :id_salle");
    $salle_supprimer->bindParam(":id_salle", $id_salle, PDO::PARAM_STR);
    $salle_supprimer->execute();
    
    $salle_a_supprimer = $salle_supprimer->fetch(PDO::FETCH_ASSOC);
    // on vérifie si la photo existe
    if(!empty($salle_a_supprimer["photo"]))
    {
        // on vérifie le chemin si le fichier existe
        $chemin_photo = RACINE_SERVEUR . "photo/" . $salle_a_supprimer["photo"];
        if(file_exists($chemin_photo))
        {
            unlink($chemin_photo); // unlink() permet de supprimer un fichier sur le serveur.
        }
    }
    
    $suppression = $pdo->prepare("DELETE FROM salle WHERE id_salle = :id_salle");
    $suppression->bindParam(":id_salle", $id_salle, PDO::PARAM_STR);
    $suppression->execute();
    header("location:gestion_des_salles.php?action=affichage");
}
    

if(isset($_GET["action"], $_GET["id"]) && $_GET["action"] == "modifier" && !empty($_GET["id"]) && is_numeric($_GET["id"]))
{
    $info_modif = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :id_salle");
    $info_modif->bindParam(":id_salle", $_GET["id"], PDO::PARAM_STR);
    $info_modif->execute();

    $info_modification = $info_modif->fetch(PDO::FETCH_ASSOC);

    $titre = $info_modification["titre"];
    $description = $info_modification["description"];
    $pays = $info_modification["pays"];
    $ville = $info_modification["ville"];
    $adresse = $info_modification["adresse"];
    $cp = $info_modification["cp"];
    $capacite = $info_modification["capacite"];
    $categorie = $info_modification["categorie"];
    
}

if(isset($_POST["titre"], $_POST["description"], $_POST["pays"], $_POST["ville"], $_POST["adresse"], $_POST["cp"], $_POST["capacite"], $_POST["categorie"]))
{
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $pays = $_POST["pays"];
    $ville = $_POST["ville"];
    $adresse = $_POST["adresse"];
    $cp = $_POST["cp"];
    $capacite = $_POST["capacite"];
    $categorie = $_POST["categorie"];
    $photo_bdd = "";

    
   


    if(!empty($_FILES["photo"]["name"]))
    {
       
        $photo_bdd = $titre . "_" . $_FILES["photo"]["name"];

        // vérification de l'extension de l'image (extension acceptées: jpg, jpeg, png, gif)
		$extension = strrchr($_FILES["photo"]["name"],"."); 
		
		// on transforme $extension afin que tous les caractères soient en minuscule
		$extension = strtolower($extension); // inverse => strtoupper()
		
		// on enlève le .
		$extension = substr($extension, 1); // exemple : .jpg => jpg
		
		// les extensions accepté
		$tab_extension_valide = array("jpg", "jpeg", "png", "gif");
		
		// nous pouvons donc vérifier si $extension fait partie des valeur autorisé dans $tab_extention_valide
		$verif_extension = in_array($extension, $tab_extension_valide); // in_array() vérifie si une valeur fournie en 1er argument fait partie des valeurs contenues dans un tableau en 2ème argument.
		
		if($verif_extension && !$erreur)
		{
			// si $verif_extension est égale à true et que $erreur n'est pas égale à true
			$photo_dossier = RACINE_SERVEUR . "photo/" . $photo_bdd;
			
			copy($_FILES["photo"]["tmp_name"], $photo_dossier);
			// copy() permet de copier un fichier depuis un emplacement fourni en premier argument vers un autre emplacement fourni en deuxième argument.
		}
		elseif(!$verif_extension)
		{
			$message .= "<div class='alert alert-danger' style='margin-top:20px;' role='alert' >Format autorisées : jpg / jpeg / png / gif</div>";
			$erreur = true;
		}
    }

    if(empty($titre) || empty($pays) || empty($ville) || empty($adresse))
    {
        $erreur = true;
        $message .= "<div class='alert alert-danger' style='margin-bottom:10px;'>Veuillez remplir les champs obligatoire</div>"; 
    }

    
    //  INSERTION/MODIFICATION EN S'IL N'Y A PAS D'ERREUR
    if(!$erreur)
    {
        if(isset($_GET["action"]) && $_GET["action"] == "ajout")
        {
            $insertion = $pdo->prepare("INSERT INTO salle (titre, description, photo, pays, ville, adresse, cp, capacite, categorie) VALUES (:titre, :description, :photo, :pays, :ville, :adresse, :cp, :capacite, :categorie)");
        }
        elseif(isset($_GET["action"]) && $_GET["action"] == "modifier")
        {
            $insertion = $pdo->prepare("UPDATE salle SET titre = :titre, description = :description, photo = :photo, pays = :pays, ville = :ville, adresse = :adresse, cp = :cp, capacite = :capacite, categorie = :categorie WHERE id_salle = :id_salle");
            $insertion->bindParam(":id_salle", $_GET["id"], PDO::PARAM_STR);
        }
        
        
        $insertion->bindParam(":titre", $titre, PDO::PARAM_STR);
        $insertion->bindParam(":description", $description, PDO::PARAM_STR);
        $insertion->bindParam(":photo", $photo_bdd, PDO::PARAM_STR);
        $insertion->bindParam(":pays", $pays, PDO::PARAM_STR);
        $insertion->bindParam(":ville", $ville, PDO::PARAM_STR);
        $insertion->bindParam(":adresse", $adresse, PDO::PARAM_STR);
        $insertion->bindParam(":cp", $cp, PDO::PARAM_STR);
        $insertion->bindParam(":capacite", $capacite, PDO::PARAM_STR);
        $insertion->bindParam(":categorie", $categorie, PDO::PARAM_STR);
        

        $insertion->execute();
    }


    
   
}





require("../inc/header.inc.php");
require("../inc/nav.inc.php");
?>




        <div class="container">

            <div class="starter-template">
                <h1>Gestion des salles</h1>
                <?= $message ?>
            </div><!--/.starter-template -->
        </div><!-- /.container -->
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 text-center">
                    <a href="?action=ajout" class="btn btn-primary text-center" style="margin-bottom:50px;">ajouter une salle</a>
                    <a href="?action=affichage" class="btn btn-warning text-center" style="margin-bottom:50px;">Afficher les salles</a>
<?php
if(isset($_GET["action"]) && ($_GET["action"] == "ajout" || $_GET["action"] == "modifier"))
{
?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control"value="<?php echo $titre ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description"><?php echo $description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <input type="text" name="pays" id="pays" class="form-control"value="<?php echo $pays ?>">
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" class="form-control"value="<?php echo $ville ?>">
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" class="form-control"value="<?php echo $adresse ?>">
                        </div>
                        <div class="form-group">
                            <label for="cp">Code psotal</label>
                            <input type="text" name="cp" id="cp" class="form-control"value="<?php echo $cp ?>">
                        </div>
                        <div class="form-group">
                            <label for="capacite">Capacite</label>
                            <input type="text" name="capacite" id="capacite" class="form-control"value="<?php echo $capacite ?>">
                        </div>
                        <div class="form-group">
                            <label for="categorie">Categorie</label>
                            <select name="categorie" id="categorie" class="form-control">
                                <option value="réunion">Réunion</option>
                                <option value="bureau">Bureau</option>
                                <option value="formation">Formation</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Enregistrer">
                        </div>
                    </form>

                </div> <!-- /.col-sm-6 -->
            </div><!-- /.row -->
        </div> <!-- /.container -->
<?php
}
elseif(isset($_GET["action"]) && $_GET["action"] == "affichage")
{
    $affichage = $pdo->query("SELECT * FROM salle");

    $nb_col = $affichage->columnCount();

    echo "<table border='1'class='table table-bordered'>";
    echo "<thead>";
    echo "<tr>";

    for($i = 0; $i < $nb_col; $i++)
    {
        $colonne = $affichage->getColumnMeta($i)["name"];

       echo "<th>" . $colonne  . "</th>";
    }
    echo "<th>Modifier/supprimer</th>";

    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while($salle = $affichage->fetch(PDO::FETCH_ASSOC))
    {
        echo "<tr>";
        foreach($salle AS $indice => $valeur)
        {
            if($indice == "photo")
            {
                echo "<td><a href='#' class='thumbnail' data-toggle='modal' data-target='#lightbox'><img src='" . URL . "photo/" . $valeur . "' class='img-responsive' /></a></td>";
            }
            elseif($indice == "description")
            {
                echo "<td>" . substr($valeur, 0, 56) . "...<a href=''>Lire la suite</a></td>";
            }
            else
            {
                echo "<td>" . $valeur . "</td>";
            }
            
        }
        echo "<td><a href='gestion_des_salles.php?action=modifier&id=" . $salle["id_salle"] . "' class='btn btn-warning btn-block' ><span class='glyphicon glyphicon-refresh'></span></a>";
        echo "<a href='gestion_des_salles.php?action=supprimer&id=" . $salle["id_salle"] . "' class='btn btn-danger btn-block' ><span class='glyphicon glyphicon-remove-sign'></span ></a></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

?>



<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>

<?php
}
?>
<?php
require("../inc/footer.inc.php")
?>

