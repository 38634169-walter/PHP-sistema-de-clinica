<?php 
    include("../layout/header.php");
    if(isset($_SESSION['logged'])){
?>
<section>
    <a href="../inicio.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Registar paciente</h1>
    <div class="form-container">
        <form action="registrarPaciente.php" method="POST">
            <li><label>Nombre: </label><input name='nombre' type='text'></li>
            <li><label>Apellido: </label><input name='apellido' type='text'></li>
            <li><label>DNI: </label><input name='dni' type='number' min="1"></li>
            <li><label>Telefono: </label><input name='telefono' type='number' min="1"></li>
            <li><label>Email: </label><input name='email' type='email'></li>
            <li><label>Fecha de nacimiento: </label><input name='fechaNacimiento' type='date'></li>
            <button name='btn-registrar-paciente' class='btn btn-success boton-guardar'>Guardar</button>
        </form>
    </div>
    <?php
        if(isset($_POST['btn-registrar-paciente']) and !$_POST['nombre'] || !$_POST['apellido'] || !$_POST['dni'] || !$_POST['telefono'] || !$_POST['email'] || !$_POST['fechaNacimiento']){
            echo "
                <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                    <div style='width:90%;background:red;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                        <p style='text-align:center;color:white;'> Debes ingresar todos los datos </p>
                        <a href='' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                    </div>    
                </div>    
            ";  
        } 
        if(isset($_POST['btn-registrar-paciente']) and $_POST['nombre'] and $_POST['apellido'] and $_POST['dni'] and $_POST['telefono'] and $_POST['email'] and $_POST['fechaNacimiento']){
            include("../abrir_conexion.php");
            $sql="INSERT INTO pacientes(nombrePaciente,apellidoPaciente,DNI,telefono,email,fechaNacimiento) values('".$_POST['nombre']."' , '".$_POST['apellido']."' , '".$_POST['dni']."' , '".$_POST['telefono']."' , '".$_POST['email']."' , '".$_POST['fechaNacimiento']."' )";
            $consulta=mysqli_query($conexion,$sql);
            if($consulta==true){
                echo "
                    <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                        <div style='width:90%;background:green;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                            <p style='text-align:center;color:white;'> Agregado con exito </p>
                            <a href='../inicio.php' class='btn-cartel-aviso' style='text-decoration:none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                        </div>    
                    </div>    
                ";
            }
            include("../cerrar_conexion.php");
        }
    ?>
</section>
<?php 
    }
    else{
        header('Location:../login.php');
        exit();
    }
    include("../layout/footer.php");
?>