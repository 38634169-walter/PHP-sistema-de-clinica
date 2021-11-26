<?php 
    include("../layout/header.php"); 
    if(isset($_SESSION['logged'])){
?>
<section>
    <a href="turnos.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Turno</h1>
    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th colspan="3" class="cabeza-tabla">Paciente</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if($_GET['ID_turno']){
                    include("../abrir_conexion.php");
                    $sql="SELECT * FROM turnos WHERE ID_turno = '".$_GET['ID_turno']."' AND doctor = '".$_SESSION['ID_usuario']."' ";
                    $consulta=mysqli_query($conexion,$sql);
                    while($datos=mysqli_fetch_array($consulta)){
                        echo"
                            <tr><td><strong>Nombre: </strong></td><td>".$datos['nombrePaciente']."</td></tr>
                            <tr><td><strong>Apellido: </strong></td><td>".$datos['apellidoPaciente']."</td></tr>
                            <tr><td><strong>DNI: </strong></td><td>".$datos['dniPaciente']."</td></tr>
                            <tr><td><strong>Fecha: </strong></td><td>".$datos['fecha']."</td></tr>
                            <tr><td><strong>Hora: </strong></td><td>".$datos['hora'].":00</td></tr>
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