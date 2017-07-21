<?php
function isConnected()
{
    if(isset($_SESSION["utilisateur"]))
    {
        return true;
    }
    return false;
}

function isAdmin()
{
    if( isConnected() && $_SESSION["utilisateur"]["statut"] == 1)
    {
        return true;
    }
    return false;
}

function deconnexion()
{

    $page_en_cours = substr(strrchr($_SERVER["PHP_SELF"], "/"), 1);

    if(isset($_GET["action"]) && $_GET["action"] == "deconnexion")
    {
        session_destroy();
        return $page_en_cours;
    }
    

}