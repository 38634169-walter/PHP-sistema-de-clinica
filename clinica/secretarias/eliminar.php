<?php 
    session_start();
    if(isset($_SESSION['logged'])){
        if(isset($_GET['ID_turno'])){
            echo"
                <form class='cartel-aviso' method='POST'>
                    <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                        <div style='width:90%;background:rgb(143, 135, 29);border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                            <p style='text-align:center;color:white;'> Seguro que desea eliminarlo? </p>
                            <button name='btn-eliminar' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Si</button>
                            <a href='lista-turnos.php' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>No</a>
                        </div>    
                    </div>
                </form>
            ";
        }
        if(isset($_POST['btn-eliminar'])){
            include("../abrir_conexion.php");
            $sql="DELETE FROM turnos WHERE ID_turno = '".$_GET['ID_turno']."'";
            $consulta=mysqli_query($conexion,$sql);
            if($consulta){
                echo"
                <div class='cartel-aviso' style='display:flex;justify-content:center;align-items:center;position:relative;z-index:100;'>
                    <div style='width:90%;background:green;border-radius:15px;padding:10px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:fixed;top:3cm;z-index:9999999;'>
                        <p style='text-align:center;color:white;'> Se elimino con exito </p>
                        <a href='lista-turnos.php' class='btn-cartel-aviso' style='text-decoration=none;padding:0px 5px;text-align:center;color:black;background:white;border-radius:10px;'>Ok</a>
                        <br>
                    </div>    
                </div>
            ";
            }
            include("../cerrar_conexion.php");
        }
?>
    
<?php 
    }
    else{
        header('Location:../login.php');
        exit();
    }
?>