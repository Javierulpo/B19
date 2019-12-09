<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>UTI</title>
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="css/proyecto.css">
	<script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/locale/easyui-lang-es.js"></script>
    
</head>
<body class="easyui-layout">
<div class="titulo"> 
	   Sistema Integrado para Adminsitración 
 </div>
 <p> </p>
<p></p>

	<center> 
<div  class="easyui-panel"   title="Ingreso al Sistema " style="width:100%;max-width:400px;padding:30px 60px;">
        <form id="ff" method="post"
          onsubmit="return submitForm();" >
            <div style="margin-bottom:20px">
                <input class="easyui-textbox"  name="txtusuario" style="width:100%" data-options="label:'Usuario:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <input  class="easyui-passwordbox"    iconWidth="28"  name="txtpassword" style="width:100%" data-options="label:'Password:',required:true,validType:'password'">
            </div>
          
        </form>
        <div style="text-align:center;padding:5px 0">
         <button class="easyui-linkbutton"  type="submit" form="ff" value="Continue" style="width:80px" >Login</button>
        </div>
	</div> 

    <?php 
     session_start();
     unset(  $_SESSION['usuario'] );
     require('controlador/coneccion.php');

     $mensaje=" ";

       if( isset($_POST["txtusuario"]) &&  isset($_POST["txtpassword"])   )
        {
            $txtusuario = pg_escape_string( $_POST['txtusuario']);
            $txtpassword = pg_escape_string( $_POST['txtpassword']); 
            $sql = "SELECT * FROM  usuario where
             login='$txtusuario' and password='$txtpassword' ";
            $result = pg_query($dbconn, $sql);
            if ($result == false) {
                echo  "Ocurrió un error en la consulta" ;
               exit;
            }  
            $row = pg_fetch_assoc($result) ;
            if( isset($row['nombre']) == false){
                $mensaje ="Usuario y Clave Incorrecto";
            } 
            else{                 
               
                  $_SESSION['usuario'] = $row['nombre'];                 
                  header("location: main.php") ;
                }
                   
        }


    ?>
    <div> <?php  echo  $mensaje;?>   </div>
    </center>
    <script>
        function submitForm(){            
            var isvalid = $( "#ff" ).form('validate'); 
            return isvalid;
        }
       
    </script>

</body>
</body>
</html>