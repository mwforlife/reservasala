<?php
require 'reserva.php';
require 'bloque.php';
require 'curso.php';
require 'detalle_reserva.php';
require 'Usuarios.php';
class Controller{
    
    //Variables de clase
    private $mi;

    //Conexion a la base de datos
    public function conexion(){
        //$this->mi = new mysqli("localhost", "root", "", "reserva");
        $this->mi = new mysqli("localhost", "colegi38_informatica", "informatica2022", "colegi38_inventario");
        if ($this->mi->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mi->connect_errno . ") " . $this->mi->connect_error;
        }    
    }

    //Desconexion de la base de datos
    public function desconexion(){
        $this->mi->close();
    }

    public function comprobarusuario($rut, $correo){
        $this->conexion();
        $sql = "select * from users where rut = '$rut' or correo = '$correo'";
        $result = $this->mi->query($sql);
        if ($rs = mysqli_fetch_array($result)) {
            $this->desconexion();
            return 3;
        }else{
            $this->desconexion();
            return 0;
        }
    }

    //Registrar Usuarios
    public function registrarUsuarios($rut, $nombre, $apellido, $tipo, $correo, $password, $token){
        $this->conexion();
        $sql = "insert into users values(null, '$rut', '$nombre', '$apellido', $tipo, '$correo', '$password', '$token',now())";
        $result = $this->mi->query($sql);
        $this->desconexion();
        return json_encode($result);
    }

    public function listarUsuarios(){
        $this->conexion();
        $sql = "select * from users where id_tip!=1";
        $result = $this->mi->query($sql);
        $lista = array();
        while ($rs = mysqli_fetch_array($result)) {
            $usuario = new Usuarios($rs['id_usu'], $rs['rut'], $rs['nombre'], $rs['apellido'], $rs['correo'], $rs['fecha']);
            $lista[] = $usuario;
        }
        $this->desconexion();
        return $lista;
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
                $result = $this->registrarbloque($id, $bloque);
                return $result;
            }
        }
       
    }

    //Llenado Nub reservas
    public function registrarbloque($reserva,$bloque){
        $this->conexion();
        $sql = "insert into detalles_reserva values(null, $reserva, $bloque)";
        $result = json_encode($this->mi->query($sql));
        $this->desconexion();
        return $result;
    }

    //Lista de reservas
    public function listarreserva($usuario){
        $this->conexion();
        $sql = "select reserva.id_res, cant_alu as cantidad, id_sal, asignatura, fecha, curso.nombre as id_cur, bloques.nombre as bloque, bloques.hora as horario, id_usu from reserva,bloques, detalles_reserva,curso where reserva.id_res = detalles_reserva.id_res and detalles_reserva.id_blo = bloques.id_blo and reserva.id_cur = curso.id_cur and reserva.id_usu = $usuario and fecha>=curdate()";
        $result = $this->mi->query($sql);
        $reservas = array();
        while ($rs = mysqli_fetch_array($result)) {
            $reserva = new Reserva($rs['id_res'], $rs['cantidad'], $rs['id_sal'], $rs['asignatura'], $rs['fecha'], $rs['id_cur'], $rs['bloque']. "<br/>" . $rs["horario"], $rs['id_usu']);
            $reservas[] = $reserva;
        }
        $this->desconexion();
        return $reservas;
    }
    //Lista de reservas Hoy
    public function listarreservashoy($usuario){
        $this->conexion();
        $sql = "select reserva.id_res, cant_alu as cantidad, id_sal, asignatura, fecha, curso.nombre as id_cur, bloques.nombre as bloque, bloques.hora as horario, id_usu from reserva,bloques, detalles_reserva,curso where reserva.id_res = detalles_reserva.id_res and detalles_reserva.id_blo = bloques.id_blo and reserva.id_cur = curso.id_cur and reserva.id_usu = $usuario and fecha=curdate();";
        $result = $this->mi->query($sql);
        $reservas = array();
        while ($rs = mysqli_fetch_array($result)) {
            $reserva = new Reserva($rs['id_res'], $rs['cantidad'], $rs['id_sal'], $rs['asignatura'], $rs['fecha'], $rs['id_cur'], $rs['bloque']. "<br/>" . $rs["horario"], $rs['id_usu']);
            $reservas[] = $reserva;
        }
        $this->desconexion();
        return $reservas;
    }
   //Lista de reservas 
   public function listarTodaslasreservas(){
    $this->conexion();
    $sql = "select reserva.id_res, cant_alu as cantidad, sala.nombre as sala, asignatura, reserva.fecha, curso.nombre as id_cur, bloques.nombre as bloque, bloques.hora as horario, users.nombre as nombre, users.apellido as apellido from sala, reserva,bloques, detalles_reserva,curso,users where sala.id_sal=reserva.id_sal and users.id_usu=reserva.id_usu and reserva.id_res = detalles_reserva.id_res and detalles_reserva.id_blo = bloques.id_blo and reserva.id_cur = curso.id_cur and reserva.fecha>curdate();";
    $result = $this->mi->query($sql);
    $reservas = array();
    while ($rs = mysqli_fetch_array($result)) {
        $Det = new Detalle_Reserva($rs['id_res'], $rs['cantidad'], $rs['sala'],$rs['id_cur'], $rs['asignatura'], $rs['fecha'],  $rs['bloque']. "<br/>" . $rs["horario"], $rs['nombre'] ." ". $rs['apellido']);
        $reservas[] = $Det;
    }
    $this->desconexion();
    return $reservas;
}

    //Lista de reservas Hoy
    public function listarTodaslasreservashoy(){
        $this->conexion();
        $sql = "select reserva.id_res, cant_alu as cantidad, id_sal, asignatura, reserva.fecha, curso.nombre as id_cur, bloques.nombre as bloque, bloques.hora as horario, users.nombre as nombre, users.apellido as apellido from reserva,bloques, detalles_reserva,curso,users where users.id_usu=reserva.id_usu and reserva.id_res = detalles_reserva.id_res and detalles_reserva.id_blo = bloques.id_blo and reserva.id_cur = curso.id_cur and reserva.fecha=curdate() order by reserva.fecha;";
        $result = $this->mi->query($sql);
        $reservas = array();
        while ($rs = mysqli_fetch_array($result)) {
            $Det = new Detalle_Reserva($rs['id_res'], $rs['cantidad'], $rs['id_sal'],$rs['id_cur'], $rs['asignatura'], $rs['fecha'],  $rs['bloque']. "<br/>" . $rs["horario"], $rs['nombre'] ." ". $rs['apellido']);
            $reservas[] = $Det;
        }
        $this->desconexion();
        return $reservas;
    }

    //Listado de Bloques
    public function listarbloques($fecha, $laboratorio){
        $this->conexion();
        $sql = "select bloques.id_blo as id, bloques.nombre as nombre, bloques.hora as horario from bloques, reserva, detalles_reserva where bloques.id_blo = detalles_reserva.id_blo and detalles_reserva.id_res = reserva.id_res and reserva.fecha = '$fecha' and reserva.id_sal = $laboratorio group by bloques.nombre order by bloques.nombre asc;";
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