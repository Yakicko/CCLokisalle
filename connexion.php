<?php
require_once("inc/init.inc.php");


if(isset($_GET["action"]) && $_GET["action"] == "deconnexion")
{
    session_destroy();
    header("location:panier.php");
}


//verification si l'utilisateurest connecte sinon on le redirige sur son profile
if(isConnected())
{
	header("location:panier.php");                
}




// verification de l'existence des indices du formulaire
if(isset($_POST['pseudo']) && isset($_POST['mdp']))
{
	$pseudo = $_POST['pseudo'];
	$mdp = $_POST['mdp'];
	
	$verif_connexion = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp");
	$verif_connexion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
	$verif_connexion->bindParam(":mdp", $mdp, PDO::PARAM_STR);
	$verif_connexion->execute();

	if($verif_connexion->rowCount() > 0)
	{
		// Si nous avons une ligne alors le pseudo et le mdp sont corrects
		//$message .='<div class="alert alert-success">OK Welcome to Lokisalle</div>';// WE REDIRECT ON THE MAIN PAGE
		$info_utilisateur = $verif_connexion->fetch(PDO::FETCH_ASSOC);
		// on place toutes les informations de l'utilisateur dans la session sauf le mdp
		$_SESSION['utilisateur']= array();
		$_SESSION['utilisateur']['id_membre'] = $info_utilisateur['id_membre'];
		$_SESSION['utilisateur']['pseudo'] = $info_utilisateur['pseudo'];
		$_SESSION['utilisateur']['nom'] = $info_utilisateur['nom'];
		$_SESSION['utilisateur']['prenom'] = $info_utilisateur['prenom'];
		$_SESSION['utilisateur']['email'] = $info_utilisateur['email'];
		$_SESSION['utilisateur']['civilite'] = $info_utilisateur['civilite'];
		$_SESSION['utilisateur']['statut'] = $info_utilisateur['statut'];
		$_SESSION['utilisateur']['date_enregistrement'] = $info_utilisateur['date_enregistrement'];
	
		// on redirige sur profil
		header("location:index.php");
	}
	else {
		$message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, erreur sur le pseudo ou le mot de passe<br /> Veuillez recommencer sil vous plait.</div>';
	}

}
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>


        <div class="container">

            <div class="starter-template">
                <h1>Connexion</h1>
                <?= $message ?>
            </div><!--/.starter-template -->

    

       	<div class="row">
		  <div class="col-sm-4 col-sm-offset-4">
			<form method="post" action="" class="well text-center">
				<div class="form-group">
					<label for="pseudo">Pseudo</label>
					<input type="text" name="pseudo" id="pseudo" class="form-control" value="" />
				</div>
				<div class="form-group">
					<label for="mdp">Mot de passe</label>
					<input type="text" name="mdp" id="mdp" class="form-control" value="" />
				</div>
				<div class="form-group">
					<input type="submit" name="inscription" id="inscription" class="form-control btn btn-success" value="Connexion"> 
				</div>

				<a href="inscription.php" class="btn btn-block btn-warning">S'inscire</a>

			</form>	
		  </div>
        </div> 
        
         </div><!-- /.container -->

<?php
require("inc/footer.inc.php")
?>
