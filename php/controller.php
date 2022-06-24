<?php
require 'reserva.php';
require 'bloque.php';
require 'curso.php';
class Controller{
    
    //Variables de clase
    private $mi;

    //Conexion a la base de datos
    public function conexion(){
        $this->mi = new mysqli("localhost", "root", "", "reserva");
        if ($this->mi->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mi->connect_errno . ") " . $this->mi->connect_error;
        }    
    }

    //Desconexion de la base de datos
    public function desconexion(){
        $this->mi->close();
    }

    //Registrar Usuarios
    public function registrarUsuarios($rut, $nombre, $apellido, $tipo, $correo, $password, $token){
        $this->conexion();
        $sql = "insert into users values(null, '$rut', '$nombre', '$apellido', $tipo, '$correo', '$password', '$token',now())";
        $result = $this->mi->query($sql);
        $this->desconexion();
        return json_encode($result);
    }

    //Inicio de sesion
    public function IniciarSession($correo, $password){
        $this->conexion();
        $sql = "select * from users where correo = '$correo' and contrasena = '$password'";
        $result = $this->mi->query($sql);
        if ($rs = mysqli_fetch_array($result)) {
            session_start();
            $_SESSION['id'] = $rs['id_usu'];
            $_SESSION['rut'] = $rs['rut'];
            $_SESSION['nombre'] = $rs['nombre'];
            $_SESSION['apellido'] = $rs['apellido'];
            $_SESSION['tipo'] = $rs['id_tip'];
            $_SESSION['correo'] = $rs['correo'];
            $_SESSION['password'] = $rs['contrasena'];
            $_SESSION['token'] = $rs['token'];
            $_SESSION['fecha'] = $rs['fecha'];
            $this->desconexion();
            return 1;
        }else{
            $this->desconexion();
            return 0;
        }
    }
    
    //Buscar Token por Correo
    public function buscartoken($correo){
        $this->conexion();
        $sql = "select * from users where correo = '$correo'";
        $result = $this->mi->query($sql);
        if ($rs = mysqli_fetch_array($result)) {
            $this->desconexion();
            return $rs['token'];
        }else{
            $this->desconexion();
            return 0;
        }
    }
    //Resetear contraseña
    public function resetcontrasena($contrasena, $token){
        $this->conexion();
        $sql = "update users set contrasena = '$contrasena' where token = '$token'";
        $result = $this->mi->query($sql);
        $this->desconexion();
        return json_encode($result);
    }

    //Registrar reserva
    public function registrarreserva($cant, $sala, $asignatura, $fecha, $curso, $bloque, $usuario){
        $this->conexion();
        $sql = "insert into reserva values(null, $cant, $sala, '$asignatura', '$fecha', $curso, $usuario)";
        $result = json_encode($this->mi->query($sql));
        $this->desconexion();
        if($result == true){
            $this->conexion();
            $sql = "select max(id_res) as id from reserva;";
            $result = $this->mi->query($sql);
            if ($rs = mysqli_fetch_array($result)) {
                $id = $rs['id'];
                $this->desconexion();
                $this->registrarbloque($id, $bloque);
            }
        }
       
    }

    //Llenado Nub reservas
    public function registrarbloque($bloque, $reserva){
        $this->conexion();
        $sql = "insert into detalles_reserva values(null, $reserva, $bloque)";
        $result = json_encode($this->mi->query($sql));
        $this->desconexion();
        if($result == true){

        }
    }

    //Lista de reservas
    public function listarreserva($usuario){
        $this->conexion();
        $sql = "select id_res, cant_alu as cantidad, id_sal, asignatura, fecha, curso.nombre as id_cur, bloques.nombre as bloque, bloques.horario as horario, id_usu from reserva,bloques, detalles_reserva,curso where reserva.id_res = detalles_reserva.id_res and detalles_reserva.id_blo = bloques.id_blo and reserva.id_cur = curso.id_cur and reserva.id_usu = $usuario";
        $result = $this->mi->query($sql);
        $reservas = array();
        while ($rs = mysqli_fetch_array($result)) {
            $reserva = new Reserva($rs['id_res'], $rs['cantidad'], $rs['id_sal'], $rs['asignatura'], $rs['fecha'], $rs['id_cur'], $rs['bloque']. "\n" . $rs["horario"], $rs['id_usu']);
            $reservas[] = $reserva;
        }
        $this->desconexion();
        return $reservas;
    }

    //Listado de Bloques
    public function listarbloques($fecha, $laboratorio){
        $this->conexion();
        $sql = "select bloques.id_blo as id, bloques.nombre as nombre, bloques.hora as horario from bloques, reserva, detalles_reserva where bloques.id_blo = detalles_reserva.id_blo and detalles_reserva.id_res = reserva.id_res and reserva.fecha = '$fecha' and reserva.id_sal = $laboratorio group by bloques.nombre order by bloques.nombre;";
        $result = $this->mi->query($sql);
        $bloques = array();
        while ($rs = mysqli_fetch_array($result)) {
            $bloque = new Bloque($rs['id'],$rs['nombre'], $rs['horario']);
            $bloques[] = $bloque;
        }
        $this->desconexion();
        return $bloques;
    }

    //Listado de Bloques
    public function listarbloques1(){
        $this->conexion();
        $sql = "select * from bloques";
        $result = $this->mi->query($sql);
        $bloques = array();
        while ($rs = mysqli_fetch_array($result)) {
            $bloque = new Bloque($rs['id_blo'], $rs['nombre'], $rs['hora']);
            $bloques[] = $bloque;
        }
        $this->desconexion();
        return $bloques;
    }

    //Listado de Cursos
    public function listarcursos(){
        $this->conexion();
        $sql = "select * from curso order by nombre asc";
        $result = $this->mi->query($sql);
        $cursos = array();
        while ($rs = mysqli_fetch_array($result)) {
            $curso = new Curso($rs['id_cur'], $rs['nombre']);
            $cursos[] = $curso;
        }
        $this->desconexion();
        return $cursos;
    }


}