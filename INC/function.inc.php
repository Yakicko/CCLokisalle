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