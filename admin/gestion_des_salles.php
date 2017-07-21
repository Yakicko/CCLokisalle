<?php
require_once("../inc/init.inc.php");

$erreur = "";

if(!isAdmin())
{
    header("location:" . URL . "index.php");
}


if(isset($_POST["titre"], $_POST["description"], $_POST["photo"], $_POST["pays"], $_POST["ville"], $_POST["adresse"], $_POST["cp"], $_POST["capacite"], $_POST["categorie"], $_FILES["photo"]))
{
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $photo = $_POST["photo"];
    $pays = $_POST["pays"];
    $ville = $_POST["ville"];
    $adresse = $_POST["adresse"];
    $cp = $_POST["cp"];
    $capacite = $_POST["capacite"];
    $categorie = $_POST["categorie"];
    $photo = $_FILES["photo"];
    $photo_bdd = "";


    if(!empty($photo))
    {
        $photo_bdd = $titre . "_" . $photo["name"];

        // vérification de l'extension de l'image (extension acceptées: jpg, jpeg, png, gif)
		$extension = strrchr($photo["name"],"."); 
		
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

    

    if(!$erreur)
    {
        $insertion = $pdo->prepare("INSERT INTO salle (titre, description, photo, pays, ville, adresse, cp, capacite, categorie) VALUES (:titre, :description, :photo, :pays, :ville, :adresse, :cp, :capacite, :categorie)");
        
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
                <div class="col-sm-6 col-sm-offset-3">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control"value="<?php if(isset($_POST["titre"])) echo $_POST["titre"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description"><?php if(isset($_POST["description"])) echo $_POST["description"] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <input type="text" name="pays" id="pays" class="form-control"value="<?php if(isset($_POST["pays"])) echo $_POST["pays"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" class="form-control"value="<?php if(isset($_POST["ville"])) echo $_POST["ville"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" class="form-control"value="<?php if(isset($_POST["adresse"])) echo $_POST["adresse"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="cp">Code psotal</label>
                            <input type="text" name="cp" id="cp" class="form-control"value="<?php if(isset($_POST["cp"])) echo $_POST["cp"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="capacite">Capacite</label>
                            <input type="text" name="capacite" id="capacite" class="form-control"value="<?php if(isset($_POST["capacite"])) echo $_POST["capacite"] ?>">
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
require("../inc/footer.inc.php")
?>
