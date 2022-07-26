<?php
require '../php/controller.php';

$c = new Controller();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva Sala | Admin</title>
    <link rel="icon" href="../img/log.png">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../DataTables/datatables.min.css">

</head>
<body>
        <header class="header">
            <div class="row justify-content-center">
                <div class="col-4">
                    <h4 class="text-center bg-success text-white">Listado de reservas</h4>
                </div>
            </div>
        </header>
        
            <div class="row justify-content-center">
            <div class="col-md-8">
               <h3 class="text-center bg-danger">Reservas de Hoy</h3>
                <table class="table table-dark">
                   <thead>
                       <tr>
                        <th>ID</th>
                        <th>Cantidad Alumnos</th>
                        <th>Sala</th>
                        <th>Curso</th>
                        <th>Asignatura</th>
                        <th>Fecha</th>
                        <th>Bloque</th>
                        <th>Docente</th>                           
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                       $lista = $c->listarTodaslasreservashoy();
                       for ($i=0; $i < count($lista); $i++) { 
                        $d = $lista[$i];
                        echo "<tr>";
                        echo "<td>".($i+1)."</td>";
                        echo "<td>".$d->getCantidad_Alumnos()."</td>";
                        echo "<td>".$d->getSala()."</td>";
                        echo "<td>".$d->getCurso()."</td>";
                        echo "<td>".$d->getAsignatura()."</td>";
                        echo "<td>".$d->getFecha()."</td>";
                        echo "<td>".$d->getBloque()."</td>";
                        echo "<td>".$d->getDocente()."</td>";
                        echo "</tr>";
                       }
                       ?>
                   </tbody>
                </table>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
               <h3 class="text-center bg-info">Todas las reservas</h3>
                <table id="reserve_list" class="table table-dark">
                   <thead>
                       <tr>
                        <th>ID</th>
                        <th>Cantidad Alumnos</th>
                        <th>Sala</th>
                        <th>Curso</th>
                        <th>Asignatura</th>
                        <th>Fecha</th>
                        <th>Bloque</th>
                        <th>Docente</th>                           
                       </tr>
                   </thead>
                   <tbody>
                   <?php
                       $lista = $c->listarTodaslasreservas();
                       for ($i=0; $i < count($lista); $i++) { 
                        $d = $lista[$i];
                        echo "<tr>";
                        echo "<td>".($i+1)."</td>";
                        echo "<td>".$d->getCantidad_Alumnos()."</td>";
                        echo "<td>".$d->getSala()."</td>";
                        echo "<td>".$d->getCurso()."</td>";
                        echo "<td>".$d->getAsignatura()."</td>";
                        echo "<td>".$d->getFecha()."</td>";
                        echo "<td>".$d->getBloque()."</td>";
                        echo "<td>".$d->getDocente()."</td>";
                        echo "</tr>";
                       }
                       ?>
                   </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center bg-warning text-white">Listado de Usuarios</h3>
                <table id="user_list" class="table table-dark">
                    <thead>
                    <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Fecha de Registro</th>
                    </tr>    
                    </thead>
                    <tbody>
                        <?php
                        $lista = $c->listarUsuarios();
                        for ($i=0; $i < count($lista); $i++) { 
                            $d = $lista[$i];
                            echo "<tr>";
                            echo "<td>".$d->getRut()."</td>";
                            echo "<td>".$d->getNombre()."</td>";
                            echo "<td>".$d->getApellido()."</td>";
                            echo "<td>".$d->getCorreo()."</td>";
                            echo "<td>".$d->getRegistro()."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        <script src="../js/jquery-3.6.0.js"></script>
        <script src="../js/bootstrap.bundle.js"></script>
    <script src="../DataTables/datatables.min.js"></script>
    <script src="../js/query.js"></script>
</body>
</html>