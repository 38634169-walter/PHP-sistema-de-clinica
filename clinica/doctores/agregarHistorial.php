<?php 
    include("../layout/header.php");
    if(isset($_SESSION['logged'])){
?>
<section>
    <a href="pacientes.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Agregar historia</h1>
    <div class="form-container">
        <form action="" method="POST">
            <li><label>Fecha: </label><input name='fecha' type='date'placeholder="Fecha"></li>
            <li><label>Observacion: </label><textarea name="observacion" cols="30" rows="10" placeholder="Observacion"></textarea>
            <button type="submit" name='btn-agregar-historial' class='btn btn-success boton-guardar'>Guardar</button>
        </form>
    </div>
    <?php 
        if(isset($_POST['btn-agregar-historial']) and !$_POST['fecha'] || !$_POST['observacion']){
            echo "
                <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                    <div style='width:90%;background:red;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                        <p style='text-align:center;color:white;'> Debes ingresar todos los datos </p>
                        <a href='' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                    </div>    
                </div>    
            ";  
        }
        if(isset($_POST['btn-agregar-historial']) and $_POST['fecha'] and $_POST['observacion']){
            include("../abrir_conexion.php");
            $sql2="SELECT * FROM pacientes WHERE DNI = '".$_GET['DNI']."' ";
            $consulta2=mysqli_query($conexion,$sql2);
            while($datos2=mysqli_fetch_array($consulta2)){
                $nombrePaciente=$datos2['nombrePaciente'];
                $apellidoPaciente=$datos2['apellidoPaciente'];
            }
            $sql="INSERT INTO historial(nombrePaciente,apellidoPaciente,DNI,doctor,diagnosticoPaciente,fecha) values('".$nombrePaciente."' , '".$apellidoPaciente."' , '".$_GET['DNI']."' , '".$_SESSION['ID_usuario']."' , '".$_POST['observacion']."' , '".$_POST['fecha']."' )";
            $consulta=mysqli_query($conexion,$sql);
            if($consulta==true){
                echo "
                    <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                        <div style='width:90%;background:green;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                            <p style='text-align:center;color:white;'> Agregado con exito </p>
                            <a href='pacientes.php' class='btn-cartel-aviso' style='text-decoration:none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
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