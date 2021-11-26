<?php 
    include("../layout/header.php"); 
    if($_SESSION['logged']){
?>
<section>
        <?php 
            if(isset($_GET['ID_turno'])){
        ?>
        <a href="lista-turnos.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
        <h1 class="titulo">Editar turno</h1>
        <div class="form-container">
            <form action="" method="POST">
                <li><label for="">Doctor: </label><select name="doc">
                    <?php 
                        include("../abrir_conexion.php.");
                        $sql="SELECT * FROM usuarios WHERE doctor = true";
                        $consulta=mysqli_query($conexion,$sql);
                        while($datos=mysqli_fetch_array($consulta)){
                            echo"
                                <option value='".$datos['ID_usuario']."'>".$datos['nombreUsu']." " .$datos['apellidoUsu']."</option>
                            ";
                        }
                        include("../cerrar_conexion.php.");
                    ?>
                </select></li>
                <li><label for="">Fecha: </label><input type="date" name="fecha"></li>        
                <button name="btn-fecha" class="btn btn-success boton-guardar">Consultar horarios</button>
            </form>
            <?php
                $registrado=false;
                if(isset($_POST['btn-fecha']) and !$_POST['doc'] || !$_POST['fecha']){
                    echo "
                        <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                            <div style='width:90%;background:red;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                                <p style='text-align:center;color:white;'> Debes ingresar todos los datos </p>
                                <a href='' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                            </div>    
                        </div>    
                    ";  
                }
                if(isset($_POST['btn-fecha']) and $_POST['doc'] and $_POST['fecha']){
                    $_SESSION['fecha']=$_POST['fecha'];
                    $_SESSION['doc']=$_POST['doc'];
                    include("../abrir_conexion.php");
                    $sql="SELECT * FROM turnos WHERE fecha = '".$_POST['fecha']."' AND doctor = '".$_POST['doc']."' ";
                    $consulta=mysqli_query($conexion,$sql);
                    $v=array(8,9,10,11,12,13,14,15,16,17,18);
                    $sizeV=sizeof($v);
                    $cont=0;
                    while($datos=mysqli_fetch_array($consulta)){
                        // No mostrar los errores de PHP
                        error_reporting(0);
                        for($i=0;$i<$sizeV;$i++){
                            if($datos['hora']==$v[$i]){
                                $cont++;
                                for($j=$i;$j<$sizeV;$j++){
                                        $v[$j]=$v[$j+1];                                
                                }
                            }
                        }
                    }
                    include("../cerrar_conexion.php");
                    echo"
                        <form action='' method='POST'>
                            <p class='titulo-medio'> Horarios disponibles</p>
                            <li>
                                <label>Hora: </label>
                                <select name='hora'>";
                                for($i=0;$i<$sizeV-$cont;$i++){
                                    echo"
                                        <option value='".$v[$i]."'>".$v[$i].":00</option>
                                    ";
                                }
                    echo"            
                                </select>
                            </li>
                            <button name='btn-reservar' class='btn btn-success boton-guardar'>Guardar</button>
                        </form>
                    ";
                }
                if(isset($_POST['btn-reservar']) and !$_POST['hora']){
                    echo "
                        <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                            <div style='width:90%;background:red;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                                <p style='text-align:center;color:white;'> Debes ingresar todos los datos </p>
                                <a href='' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                            </div>    
                        </div>    
                    ";  
                }
                if(isset($_POST['btn-reservar']) and $_POST['hora']){
                    include("../abrir_conexion.php");
                    $sql="UPDATE turnos SET fecha = '".$_SESSION['fecha']."',hora = '".$_POST['hora']."',doctor = '".$_SESSION['doc']."' WHERE ID_turno = '".$_GET['ID_turno']."' " ;
                    $consulta=mysqli_query($conexion,$sql);
                    if($consulta){
                        echo "
                            <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                                <div style='width:90%;background:green;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                                    <p style='text-align:center;color:white;'> Agregado con exito </p>
                                    <a href='lista-turnos.php' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                                </div>    
                            </div>    
                        ";
                    }
                    include("../cerrar_conexion.php");
                }
            ?>
        </div>
        <?php 
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