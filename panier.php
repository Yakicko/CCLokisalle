<?php
require_once("inc/init.inc.php");





if(!isConnected())
{
    header("location:connexion.php");
}






require("inc/header.inc.php");
require("inc/nav.inc.php");
?>


        <div class="container">

            <div class="starter-template">
                <h1>Panier</h1>
                <?= $message ?>
            </div><!--/.starter-template -->

        </div><!-- /.container -->

<?php
require("inc/footer.inc.php")
?>
