<?php
class MySQLRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->db->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerSinTareas() {
        $sql = "SELECT u.* 
                FROM usuarios u
                LEFT JOIN tareas t ON u.id = t.id_usuario  
                WHERE t.id_usuario IS NULL";
        $stmt = $this->db->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarUsuario($nombre, $email) {
        $sql = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
        $stmt = $this->db->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    public function agregarTarea($nombre,$descripcion,$id_usuario){
        $sql = 'INSERT INTO tareas (nombre,descripcion,id_usuario) VALUES (:nombre,:descripcion,:id_usuario)';
        $stmt = $this->db->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
    }

    public function obtenerTareas(){
        $sql = 'SELECT * FROM tareas';
        return fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerAsignadas(){
        $sql = 'SELECT t.*, u.nombre AS nombre_usuario
                FROM tareas t
                JOIN usuarios u ON t.id_usuario = u.id
                WHERE id_usuario IS NOT NULL';
        $stmt = $this->db->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerNoAsignadas(){
        $sql = 'SELECT * FROM tareas WHERE id_usuario IS NULL';
        $stmt = $this->db->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function asignarTarea($id_tarea,$id_usuario){
        $sql = 'UPDATE tareas SET id_usuario = :id_usuario WHERE id = :id_tarea';
        $stmt = $this->db->conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_tarea', $id_tarea);
        $stmt->execute();
    }
}
?>