<?php 
    include("../layout/header.php"); 
    if(isset($_SESSION['logged'])){
?>
<section>
    <a href="lista-turnos.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
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
                    $sql="SELECT * FROM turnos WHERE ID_turno = '".$_GET['ID_turno']."' ";
                    $consulta=mysqli_query($conexion,$sql);
                    while($datos=mysqli_fetch_array($consulta)){
                        $sql2="SELECT * FROM usuarios WHERE ID_usuario = '".$datos['doctor']."' ";
                        $consulta2=mysqli_query($conexion,$sql2);
                        while($datos2=mysqli_fetch_array($consulta2)){
                            $doctorNombre=$datos2['nombreUsu'];
                            $doctorApellido=$datos2['nombreUsu'];
                        }
                        echo"
                            <tr><td><strong>Nombre: </strong></td><td>".$datos['nombrePaciente']."</td></tr>
                            <tr><td><strong>Apellido: </strong></td><td>".$datos['apellidoPaciente']."</td></tr>
                            <tr><td><strong>DNI: </strong></td><td>".$datos['dniPaciente']."</td></tr>
                            <tr><td><strong>Fecha: </strong></td><td>".$datos['fecha']."</td></tr>
                            <tr><td><strong>Hora: </strong></td><td>".$datos['hora'].":00</td></tr>
                            <tr><td><strong>Doctor/a: </strong></td><td>".$doctorNombre." ".$doctorApellido."</td></tr>
                            <tr>
                                <td colspan='2' style='height:1cm;justify-content:center;align-items:center;'>
                                    <a href=\"editar.php?ID_turno=".$datos['ID_turno']."\" style='text-decoration:none;padding:5px;text-align:center;color:white;background:rgb(143, 135, 29);border-radius:10px;'><i class='fas fa-edit'></i> Editar</a>
                                    <a href=\"eliminar.php?ID_turno=".$datos['ID_turno']."\" style='text-decoration:none;padding:5px;text-align:center;color:white;background:red;border-radius:10px;'><i class='fas fa-trash-alt'></i> Eliminar</a>
                                </td>
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