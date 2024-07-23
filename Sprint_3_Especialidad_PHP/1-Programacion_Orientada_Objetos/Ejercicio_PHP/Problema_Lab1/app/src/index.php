<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
</head>
<body>
    <h1>Formulario de Entrada de Datos</h1>
    <form action="/index.php" method="post">
        
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>
    
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required><br><br>

        <label for="editor">Editor:</label>
        <input type="text" id="editor" name="editor" required><br><br>

        <label for="anio">Año de publicación:</label>
        <input type="number" id="anio" name="anio" min="1700" max="2100" required><br><br>
        
        <label for="numero_pg">Número de páginas:</label>
        <input type="number" id="numero_pg" name="numero_pg"><br><br>
            
        <label for="numero_ed">Número de edicion:</label>
        <input type="number" id="numero_ed" name="numero_ed"><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
<?php
    require_once('./clases/libro.php');
    require_once('./clases/revista.php');


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
        $autor = isset($_POST['autor']) ? $_POST['autor'] : '';
        $editor =isset($_POST['editor']) ? $_POST['editor'] : '';
        $anio = isset($_POST['anio']) ? $_POST['anio'] : '';
        $numero_pg = isset($_POST['numero_pg']) ? $_POST['numero_pg'] : '';
        $numero_ed = isset($_POST['numero_ed']) ? $_POST['numero_ed'] : '';

        if ($numero_pg != '' && $numero_ed != '') {
            echo 'Error <br> Un libro tiene numero de páginas <br> '.
            'Una revista tiene número de edición <br>';        
        }
        else if($numero_pg != ''){
            $libro = new Libro ($titulo, $autor, $editor, $anio, $numero_pg);
            $libro->getDatos();
        }
        else if($numero_ed != ''){
            $revista = new Revista ($titulo, $autor, $editor, $anio, $numero_ed);
            $revista->getDatos();
        }
        else{
            echo'Rellene número de páginas o numero de edición';
        }
    }
    


    
?>
