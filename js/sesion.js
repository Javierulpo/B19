function login(){
    mi_usuario = document.form1.user.value;
    mi_contrasena = document.form1.pass.value;
    if (mi_usuario == "anthony" && mi_contraseña == "123") {
    document.location = "..css/index.php";
    }else{
    alert(mi_usuario + ", La contraseña no es correcta");
    }
    }
    