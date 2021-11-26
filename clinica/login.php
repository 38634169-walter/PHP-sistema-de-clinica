<?php 
    include("layout/header.php");
?>
<section>
    <div class="login-contenedor">
        <h1><i class="fas fa-users icono-users"></i>Iniciar sesion</h1>
        <div class="login-form">
            <form action="login.php" method="POST">
                <div>
                    <input type="text" placeholder="Usuario" name="usuario">
                    <input type="password" placeholder="Contraseña" name="clave">
                </div>
                <button name="btn-login">Iniciar sesion</button>
            </form>
        </div>
    </div>
</section>
<?php 
    if(isset($_POST['btn-login'])){
        include("abrir_conexion.php");
        $sql="SELECT * FROM usuarios WHERE usuario = '".$_POST['usuario']."' AND clave = '".$_POST['clave']."' ";
        $consulta=mysqli_query($conexion,$sql);
        $b=0;
        if($consulta){
            while($datos=mysqli_fetch_array($consulta)){
                $b=1;
                if($datos['administrador']==true){
                    $_SESSION['administrador']=true;
                    $_SESSION['doctor']=false;
                    $_SESSION['secretaria']=false;
                }
                if($datos['secretaria']==true){
                    $_SESSION['secretaria']=true;
                    $_SESSION['administrador']=false;
                    $_SESSION['doctor']=false;
                }
                if($datos['doctor']==true){
                    $_SESSION['doctor']=true;
                    $_SESSION['administrador']=false;
                    $_SESSION['secretaria']=false;
                }
                $_SESSION['logged']=true;
                $_SESSION['nombreUsu']=$datos['nombreUsu'];
                $_SESSION['apellidoUsu']=$datos['apellidoUsu'];
                $_SESSION['ID_usuario']=$datos['ID_usuario'];
                include("cerrar_conexion.php");
                header('Location:inicio.php');
                exit();
            }
            if(isset($_POST['btn-login']) and  !$_POST['clave'] || !$_POST['usuario']){
                echo "
                    <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                        <div style='width:90%;background:red;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                            <p style='text-align:center;color:white;'> Debes ingresar todos los campos </p>
                            <a href='' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                        </div>    
                    </div>    
                ";  
            }
            if($b==0 and isset($_POST['btn-login']) and $_POST['clave'] and $_POST['usuario']){
                echo "
                    <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                        <div style='width:90%;background:red;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                            <p style='text-align:center;color:white;'> Usuario o contraseña invalidos </p>
                            <a href='' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                        </div>    
                    </div>    
                ";  
            }
        }
        include("cerrar_conexion.php");
    }
?>
<?php include("layout/footer.php") ?>