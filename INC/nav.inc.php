<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Lokisalle</a>
        </div><!--/.navbar-header -->
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo URL ?>index.php">Accueil</a></li>
            <?php
                if(!isConnected())
                {
            ?>
                <li><a href="<?php echo URL ?>connexion.php">Connexion</a></li>
                <li><a href="<?php echo URL ?>inscription.php">Inscription</a></li>
            <?php
                }
                elseif(isConnected())
                {
            ?>
                <li><a href="?action=deconnexion">Deconnexion</a></li>
            <?php 
                }

                if(isAdmin())
                {
            ?>

                <li><a href="<?php echo URL ?>admin/gestion_produit.php">Gestion des réservation</a></li>
                <li><a href="<?php echo URL ?>admin/gestion_des_salles.php">Gestion des salles</a></li>

            <?php
                }
            ?>
                <li><a href="#">Contact</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div> <!--/.container -->
</nav>