<?php 
    include("layout/header.php"); 
    if(isset($_SESSION['logged'])){
?>
<script src="js/menuu.js"></script>
<section>
    <div class="menu-responsive-container">
        <h1>Menu</h1><i class="fas fa-bars icono-menu"></i><i class="fas fa-times x-icono"></i>
    </div>
    <div class="body-container">
        <nav class="menu-container">
            <h1><i class="fas fa-user"></i><?php echo"".$_SESSION['nombreUsu']."";?></h1>
            <?php 
                if($_SESSION['secretaria']==true){
                    echo"
                    <ul>
                        <li><i class='far fa-calendar-plus'></i><a href='secretarias/asignarPaciente.php'>Reservar turno</a></li>
                        <li><i class='fas fa-clipboard-list'></i><a href='secretarias/lista-turnos.php'>Ver lista de turnos</a></li>
                        <li><i class='fas fa-user-plus'></i><a href='secretarias/registrarPaciente.php'>Registrar paciente</a></li>
                    </ul>
                    ";
                }
                if($_SESSION['doctor']==true){
                    echo"
                        <ul>
                            <li><i class='far fa-address-card'><a href='doctores/pacientes.php'></i>Pacientes</a></li>
                            <li><i class='fas fa-clipboard-list'><a href='doctores/turnos.php'></i>Mis turnos</a></li>
                        </ul>
                    ";
                }
            ?>
            <ul>
                <li id="cerrar"><i class="fas fa-sign-out-alt"></i><a href="cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>
        </nav>
        <div class="right-side">
            <div>
                <p>Bienvenido/a: <strong id="nom-usuario"><?php echo"".$_SESSION['nombreUsu'].""; ?></strong></p> 
            </div>
            <ul class="cuerpo-logo">
                <h1>Clinica Riobam</h1>
                <div>
                    <i class="fas fa-user-md"></i>
                    <i class="fas fa-hospital-alt"></i>
                    <i class="fas fa-heartbeat"></i>
                </div>
            </ul>
        </div>
    </div>
</section>

<?php
    }
    else{
        header('Location:login.php');
    }

include("layout/footer.php"); 
?>