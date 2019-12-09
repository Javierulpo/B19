<?php
session_start(); 
if( isset(  $_SESSION["login"]) == false )
{
    header("location: pagina1.php");
}
?>


<html>
<header>
</header>
<body> 
  <a  href="logout.php" > Cerrar Sesion </a>
 </body> 
</html>