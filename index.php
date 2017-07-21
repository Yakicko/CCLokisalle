<?php
require_once("inc/init.inc.php");












require("inc/header.inc.php");
require("inc/nav.inc.php");
// echo '<pre>';  var_dump($_GET); echo '</pre>';
// echo '<pre>';  var_dump($_SESSION); echo '</pre>';
?>


        <div class="container">

            <div class="starter-template">
                <h1>Accueil</h1>
                <?= $message ?>
            </div><!--/.starter-template -->

        </div><!-- /.container -->

<?php
require("inc/footer.inc.php")
?>
