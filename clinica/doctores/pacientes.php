<?php 
    include("../layout/header.php"); 
    if($_SESSION['logged']){
?>
    <a href="../inicio.php" class="icono-arrow"><i class="fas fa-arrow-alt-circle-left"></i></a>
    <h1 class="titulo">Pacientes</h1>
    <br>
    <h3 class="titulo-medio">Buscar paciente por:</h3>
    <form class="form-split" action="buscarPaciente.php" method="POST">
        <div class="form-split">
            <li><label>DNI: </label><input type="number" min="1" name="dni" placeholder="DNI"></li>    
            <li><label>Nombre: </label><input type="text" name="nombre" placeholder="Nombre"></li>        
            <li><label>Apellido: </label><input type="text" name="apellido" placeholder="Apellido"></li>        
            <button type="submit" class="btn btn-success boton-guardar">Buscar</button>
        </div>
    </form>
    <h3 class="titulo-medio">Pacientes:</h3>
    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th colspan="3" class="cabeza-tabla">Pacientes</th>
                </tr>
                <tr>
                    <th>DNI</th>
                    <th>Nombre y Apellido</th>
                    <th>Historial</th>
                </tr>
            </thead>
            <tbody>
    <?php 
        include("../abrir_conexion.php");
        $sql="SELECT * FROM pacientes";
        $consulta=mysqli_query($conexion,$sql);
        while($datos=mysqli_fetch_array($consulta)){
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