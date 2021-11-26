
<?php
    include("../layout/header.php");
    if(isset($_SESSION['logged'])){
?>  
    <a href="pacientes.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Resultados para: </h1>
        <?php
            if($_POST['dni']){
                echo "<p style='text-align:center;font-weight:bold;'> DNI: ".$_POST['dni']."</p>"; 
            }
            if($_POST['nombre']){
                echo "<p style='text-align:center;font-weight:bold;'> Nombre: ".$_POST['nombre']."</p>"; 
            }
            if($_POST['apellido']){
                echo "<p style='text-align:center;font-weight:bold;'> Apellido: ".$_POST['apellido']."</p>"; 
            }
        ?>
    <div class="tabla-cotainer">
        <table class="tabla">
            <thead>
                <tr>
                    <th colspan="3" class="cabeza-tabla">Resultados de busqueda</th>
                </tr>
                <tr>
                    <th>DNI</th>
                    <th>Nombre y Apellido</th>
                    <th>Historial</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if( (isset($_POST['dni'])) or (isset($_POST['fecha'])) ){
                    include("../abrir_conexion.php");
                    if( $_POST['dni'] and $_POST['nombre'] and $_POST['apellido']){
                        $sql="SELECT * FROM pacientes WHERE DNI = '".$_POST['dni']."' AND nombrePaciente LIKE '%".$_POST['nombre']."%' AND apellidoPaciente LIKE '%".$_SESSION['apellido']."%' ";
                    }
                    else{
                        if( $_POST['dni'] and $_POST['nombre']){
                            $sql="SELECT * FROM pacientes WHERE DNI = '".$_POST['dni']."' AND nombrePaciente LIKE '%".$_POST['nombre']."%' ";
                        }
                        if( $_POST['dni'] and $_POST['apellido']){
                            $sql="SELECT * FROM pacientes WHERE DNI = '".$_POST['dni']."' AND apellidoPaciente LIKE '%".$_SESSION['apellido']."%' ";
                        }
                        // No mostrar los errores de PHP
                        error_reporting(0);
                        if( $_POST['nombre'] and $_POST['apellido']){
                            $sql="SELECT * FROM pacientes WHERE nombrePaciente LIKE '%".$_POST['nombre']."%' AND apellidoPaciente LIKE '%".$_SESSION['apellido']."%' ";
                        }
                        else{
                            if( $_POST['nombre']){
                                $sql="SELECT * FROM pacientes WHERE nombrePaciente LIKE '%".$_POST['nombre']."%' ";
                            }
                            if( $_POST['apellido']){
                                $sql="SELECT * FROM pacientes WHERE apellidoPaciente LIKE '%".$_SESSION['apellido']."%' ";
                            }
                            if( $_POST['dni']){
                                $sql="SELECT * FROM pacientes WHERE DNI = '".$_POST['dni']."' ";
                            }
                        }
                    }
                    if(!$_POST['nombre'] and !$_POST['apellido'] and !$_POST['dni']){
                        echo "
                            <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                                <div style='width:90%;background:red;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                                    <p style='text-align:center;color:white;'> *No se ingreso ningun dato para la busqueda</p>
                                    <a href='pacientes.php' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                                </div>    
                    </div>    
                        ";  
                    }
                    else{
                        $consulta=mysqli_query($conexion,$sql);
                        $b=0;
                        while($datos=mysqli_fetch_array($consulta)){
                            $b=1;
                            echo"
                                <tr>
                                    <td>".$datos['DNI']."</td>
                                    <td>".$datos['nombrePaciente']." ".$datos['apellidoPaciente']."</td>
                                    <td align='center' style='display:flex;justify-content:center;align-items:center;'>
                                    <a href=\"verHistorial.php?DNI=".$datos["DNI"]."\" style='text-decoration:none;padding:5px;text-align:center;color:white;background:green;border-radius:10px;margin:2px;'><i class='far fa-eye'></i></a>
                                    <a href=\"agregarHistorial.php?DNI=".$datos["DNI"]."\" style='text-decoration:none;padding:5px;text-align:center;color:white;background:purple;border-radius:10px;margin:2px;'><i class='fas fa-plus'></i></a>
                                    </td>
                                </tr>       
                            ";
                        }
                        if($b==0){
                            echo "
                                <tr>
                                    <td colspan='3' style='color:black;'> No hay resultados para los datos ingresados</td>
                                </tr>
                            ";
                        }
                        include("../cerrar_conexion.php");
                    }
                }
            ?>
            </tbody>
        </table>
    </div> 
<?php
    }
    else{

    }
    include("../layout/footer.php"); 
?>
