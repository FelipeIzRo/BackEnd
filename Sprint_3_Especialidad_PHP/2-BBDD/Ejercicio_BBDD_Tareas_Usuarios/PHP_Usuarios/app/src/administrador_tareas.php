<?php
require_once('./service/conexionDB.php');
require_once('./class/mySqlRepository.php');
require_once('./class/tarea.php');
require_once('./class/usuario.php');

$conexionDB = new ConexionDB();
$tareaRepository = new MySQLRepository($conexionDB);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form_type = $_POST['form_type'];

    if (isset($_POST['agregar_tarea']) && $form_type === 'agregar_tarea') {
        $nombre_tarea = $_POST['nombre_tarea'];
        $descripcion = $_POST['descripcion'];
        $id_usuario = $_POST['asignar_usuario'] !== 'null' ? $_POST['asignar_usuario'] : null;
        //$id_usuario = $_POST['asigar_usuario'];
        
        $tarea = new Tarea($nombre_tarea, $descripcion);

        // Insertar el objeto de usuario en la base de datos
        if ($tareaRepository->agregarTarea($tarea->getNombre(), $tarea->getDescripcion(), $id_usuario)) {
            echo "Tarea agregada correctamente.";
        } else {
            echo "Error al agregar la tarea.";
        }
    }

    //$_POST['id_tarea'] !== 'null' && $_POST['asignar_usuario'] !== 'null'
    //Es porque Sin asiganr tiene valor 'null'
    if (isset($_POST['asignar_tarea']) 
        && $form_type === 'asignar_tarea' 
        && isset($_POST['id_tarea'])
        && isset($_POST['asignar_usuario'])
        && $_POST['id_tarea'] !== 'null'
        && $_POST['asignar_usuario'] !== 'null') {

        $id_tarea = $_POST['id_tarea'];
        $id_usuario = $_POST['asignar_usuario'];
        
        $tareaRepository->asignarTarea($id_tarea,$id_usuario);
    }
    
}

$usuarios = $tareaRepository->obtenerSinTareas();
$tareas_asignadas = $tareaRepository->obtenerAsignadas();
$tareas_no_asignadas = $tareaRepository->obtenerNoAsignadas();
$conexionDB->cerrarConexion();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrador de Usuarios</title>
</head>
<body>
    <nav><a href="index.php">Index</a></nav>
    <h1>Administrador de Tareas</h1>
    <h2>Agregar Tarea</h2>
    <form method="post" action="administrador_tareas.php">
        <input type="hidden" name="form_type" value="agregar_tarea">
        <label for="nombre_tarea">Nombre de la tarea:</label>
        <input type="text" name="nombre_tarea" required><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" required><br>

        <label for="asignar_usuario">Asignar usuario:</label>
        <select id="asignar_usuario" name="asignar_usuario">
            <option value="null">Sin Asignar</option>
            <?php foreach ($usuarios as $user) { ?>            
            <option value="<?php echo $user['id']; ?>"><?php echo $user['nombre']; ?></option>                    
            <?php } ?>
        </select>

        <br>
        <input type="submit" name="agregar_tarea" value="Agregar Tarea">
    </form>

    <h2>Asignar Tarea</h2>
    <form method="post" action="administrador_tareas.php">
        <input type="hidden" name="form_type" value="asignar_tarea">
        
        <label for="id_tarea">Tarea:</label>
        <select id="id_tarea" name="id_tarea">
            <option value="null">Sin Asignar</option>
            <?php foreach ($tareas_no_asignadas as $tarea) { ?>            
            <option value="<?php echo $tarea['id']; ?>"><?php echo $tarea['nombre']; ?></option>                    
            <?php } ?>
        </select>

        <label for="asignar_usuario">Asignar usuario:</label>
        <select id="asignar_usuario" name="asignar_usuario">
            <option value="null">Sin Asignar</option>
            <?php foreach ($usuarios as $user) { ?>            
            <option value="<?php echo $user['id']; ?>"><?php echo $user['nombre']; ?></option>                    
            <?php } ?>
        </select>

        <input type="submit" name="asignar_tarea" value="Asignar Tarea">
    </form>
        <!-- Tabla Tareas Asignadas -->
        <h1>TAREAS ASIGNADAS</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>        
                <?php foreach ($tareas_asignadas as $t) { ?>    
                    <tr>        
                        <td><?php echo $t['nombre']; ?></td>
                        <td><?php echo $t['descripcion']; ?></td> 
                        <td><?php echo $t['nombre_usuario']; ?></td>  
                    </tr>           
                <?php } ?>        
            </tbody>
        </table>

    <!-- Tabla Tareas No Asignadas-->        
        <h1>TAREAS NO ASIGNADAS</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>        
                <?php for ($i = 0; $i < count($tareas_no_asignadas); $i++) { ?>    
                    <tr>                        
                        <td><?php echo $tareas_no_asignadas[$i]['nombre']; ?></td>
                        <td><?php echo $tareas_no_asignadas[$i]['descripcion']; ?></td>                                                 
                    </tr>           
                <?php } ?>        
            </tbody>
        </table>
    
</body>
</html>