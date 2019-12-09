<?php
session_start(); 
unset( $_SESSION["login"]) ;
header("location: pagina1.php");
?>
 