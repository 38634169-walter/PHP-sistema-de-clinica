<?php 
    include("../layout/header.php"); 
    if($_SESSION['logged']){
?>
    <a href="../inicio.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Lista de turnos</h1>
    <br>
    <h3 class="titulo-medio">Buscar paciente por:</h3>
    <form class="form-split" action="buscar.php" method="POST">
        <div class="form-split">
            <li><label>DNI: </label><input type="number" name="dni" min="1"></li>    
            <li><label>Fecha: </label><input type="date" name="fecha"></li>        
            <button type="submit" class="btn btn-success boton-guardar">Buscar</button>
        </div>
    </form>
    <h3 class="titulo-medio">Turnos:</h3>
    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th colspan="3" class="cabeza-tabla">Ultimos turnos dados</th>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre y Apellido</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
    <?php 
        include("../abrir_conexion.php");
        $sql="SELECT * FROM turnos";
        $consulta=mysqli_query($conexion,$sql);
        while($datos=mysqli_fetch_array($consulta)){
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
        include("../cerrar_conexion.php");
    ?>
            </tbody>
        </table>
    </div> 
    
<?php 
    include("../layout/footer.php"); 
    }
    else{
        header('Location:../login.php');
        exit();
    }
?>