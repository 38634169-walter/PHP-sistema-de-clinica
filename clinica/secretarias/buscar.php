
<?php
    include("../layout/header.php");
    if(isset($_SESSION['logged'])){
?>  
    <a href="lista-turnos.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Resultados para: </h1>
        <?php
            if($_POST['dni']){
                echo "<p style='text-align:center;font-weight:bold;'> DNI: ".$_POST['dni']."</p>"; 
            }
            if($_POST['fecha']){
                echo "<p style='text-align:center;font-weight:bold;'> Fecha: ".$_POST['fecha']."</p>"; 
            }
        ?>
    <div class="tabla-cotainer">
        <table class="tabla">
            <thead>
                <tr>
                    <th colspan="3" class="cabeza-tabla">Resultados de busqueda</th>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre y Apellido</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if( (isset($_POST['dni'])) or (isset($_POST['fecha'])) ){
                    include("../abrir_conexion.php");
                    if( $_POST['dni'] and $_POST['fecha'] ){
                        $sql="SELECT * FROM turnos WHERE dniPaciente = '".$_POST['dni']."' AND fecha = '".$_POST['fecha']."' ";
                    }
                    else{
                        if($_POST['dni']){
                            $sql="SELECT * FROM turnos WHERE dniPaciente = '".$_POST['dni']."' ";
                        }
                        if($_POST['fecha']){
                            $sql="SELECT * FROM turnos WHERE fecha = '".$_POST['fecha']."' ";
                        }
                    }
                    if(!$_POST['fecha'] and !$_POST['dni']){
                        echo "
                            <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                                <div style='width:90%;background:red;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                                    <p style='text-align:center;color:white;'> *No se ingreso ningun dato para la busqueda</p>
                                    <a href='lista-turnos.php' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
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
                                    <td>".$datos['fecha']."</td>
                                    <td>".$datos['nombrePaciente']." ".$datos['apellidoPaciente']."</td>
                                    <td>
                                        <li><a href=\"verTurno.php?ID_turno=".$datos["ID_turno"]."\" style='text-decoration:none;padding:5px;text-align:center;color:white;background:green;border-radius:10px;'><i class='far fa-eye'></i></a></li>
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
