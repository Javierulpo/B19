
<html>
<header>
</header>
<body> 
<form    method="post">   
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="txtUsuario" required>
<p></p>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="txtPassword" required>

    <button type="submit">Login</button> 
</form>
</body> 
</html>

<?php
   
  if( isset($_POST["txtUsuario"]) &&  isset($_POST["txtPassword"]) ){
     if($_POST["txtUsuario"] == "1" && $_POST["txtPassword"]=="1"  ){
        echo " datos correctos ";
        session_start(); 
        $_SESSION["login"] = "1";
        header("location: pagina2.php");
     }
     else
     echo " datos incorrectos ";
  }
?>