<?php 
    include("../layout/header.php"); 
    if(isset($_SESSION['logged'])){
?>
<section>
    <a href="pacientes.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Historial</h1>
    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th colspan="3" class="cabeza-tabla">Historial</th>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <th>Observacion</th>
                    <th>Doctor</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if($_GET['DNI']){
                    include("../abrir_conexion.php");
                    $sql="SELECT * FROM historial WHERE DNI = '".$_GET['DNI']."' ";
                    $consulta=mysqli_query($conexion,$sql);
                    while($datos=mysqli_fetch_array($consulta)){
                        $sql2="SELECT * FROM  WHERE ID_usuario = '".$datos['doctor']."' ";
                        $consulta2=mysqli_query($conexion,$sql2);
                        while($datos2=mysqli_fetch_array($consulta2)){
                            $doctorNombre=$datos2['nombreUsu'];
                            $doctorApellido=$datos2['apellidoUsu'];
                        }
                        echo"
                            <tr>
                                <td>".$datos['fecha']."</td>
                                <td>".$datos['diagnosticoPaciente']."</td>
                                <td>".$doctorNombre." ".$doctorApellido."</td>
                            </tr>
                        ";   
                    }
                    include("../cerrar_conexion.php");
                }
            ?>
            </tbody>
        </table>
    </div> 
</section>
<?php 
    }
    else{
        header('Location:../login.php');
        exit();
    }
include("../layout/footer.php"); 
?>