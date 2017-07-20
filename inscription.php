<?php
require_once("inc/init.inc.php");
$erreur = "";
//traitement du formulaire
if(isset($_POST["pseudo"]) && isset($_POST["mdp"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["civilite"]))
{
    $pseudo = $_POST["pseudo"];
    $mdp = $_POST["mdp"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $civilite = $_POST["civilite"];
    
    $verif_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
    $verif_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $verif_pseudo->execute();
    
    if($verif_pseudo->rowCount() > 0 )
    {
        $erreur = true;
        $message .= "<div class='alert alert-danger' style='margin-bottom:10px;'>Pseudo déjà utilisé</div>";
    }

    if((iconv_strlen($pseudo) < 4 || iconv_strlen($pseudo) > 14) && !empty($pseudo) )
    {
        $erreur = true;
        $message .= "<div class='alert alert-danger' style='margin-bottom:10px;'>Le pseudo doit faire entre 4 et 14 caractères</div>"; 
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $erreur = true;
        $message .= "<div class='alert alert-danger' style='margin-bottom:10px;'>Email Invalide</div>"; 
    }

    if(empty($pseudo) || empty($email) || empty($mdp))
    {
        $erreur = true;
        $message .= "<div class='alert alert-danger' style='margin-bottom:10px;'>Veuillez remplir les champs obligatoire</div>"; 
    }

    if(!$erreur)
    {
        $enregistrement = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, date_enregistrement) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :civilite, NOW())");
        $enregistrement->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $enregistrement->bindParam(":mdp", $mdp, PDO::PARAM_STR);
        $enregistrement->bindParam(":nom", $nom, PDO::PARAM_STR);
        $enregistrement->bindParam(":prenom", $prenom, PDO::PARAM_STR);
        $enregistrement->bindParam(":email", $email, PDO::PARAM_STR);
        $enregistrement->bindParam(":civilite", $civilite, PDO::PARAM_STR);
        $enregistrement->execute();

        header("location:connexion.php");
    }


}










require("inc/header.inc.php");
require("inc/nav.inc.php");
?>


        <div class="container">

            <div class="starter-template">
                <h1>Inscription</h1>
                <?= $message ?>
            </div><!--/.starter-template -->

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    
                    <form action="" method="post" class="well">
                        <p class="text-danger"><small>*(champs obligatoire)</small></p>
                        <div class="form-group">
                            <label for="pseudo">Pseudo <span class="text-danger">*</span></label>
                            <input type="text" id="pseudo" name="pseudo" class="form-control" value="<?php if(isset($_POST["pseudo"])) echo $_POST["pseudo"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe <span class="text-danger">*</span></label>
                            <input type="text" id="mdp" name="mdp" class="form-control" value="<?php if(isset($_POST["mdp"])) echo $_POST["mdp"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="<?php if(isset($_POST["nom"])) echo $_POST["nom"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" value="<?php if(isset($_POST["prenom"])) echo $_POST["prenom"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="text" id="email" name="email" class="form-control" value="<?php if(isset($_POST["email"])) echo $_POST["email"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="civilite">Civilité</label>
                            <select id="civilite" name="civilite" class="form-control">
                                <option value="m">Homme</option>
                                <option value="f">Femme</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="submit" class="btn btn-primary btn-block" value="S'inscrire">
                        </div>
                        <a href="connexion.php" class="btn btn-warning btn-block">Connexion</a>
                    </form>
                </div><!-- /.col-sm-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->

<?php
require("inc/footer.inc.php")
?>
