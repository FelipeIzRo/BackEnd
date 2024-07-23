<!DOCTYPE html>
<html>
<head>
    <title>Formulario Lab0</title>
    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br>
        
        <label for="edad">Edad:</label><br>
        <input type="text" id="edad" name="edad"><br>
        
        <label for="descripcion">Descripción:</label><br>
        <input type="text" id="descripcion" name="descripcion"><br><br>
        
        <input type="submit" value="Enviar">
    </form>
</head>
<body>
</body>
</html>
<?php  
    function existePost(){
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['edad']) 
    && isset($_POST['descripcion'])){  
        return true;
    }
    return false;
    }
    function generarArray($nombre,$edad,$descripcion){
        return $array = [
            "nombre" => $nombre,
            "edad" => $edad,
            "descripcion" => $descripcion
        ];
    }
    function noVacios($array){
        foreach ($array as $clave => $valor){
            if($valor == ''){
                return false;
            }
        }
        return true;
    }
    function escribirNombreDescripcion($array){
        $fichero = fopen('nombre_y_descripcion.txt','a');
        fwrite($fichero,"Nombre: {$array['nombre']}\nDescripcion:{$array['descripcion']}\n");
        fclose($fichero);
    }
    function escribirEdadMostrarMedia($array){
        $fichero = fopen('edades.txt','a');
        $valores = file('edades.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $mediaEdades = 0;
        $i = 0;
        for ( ; $i < count($valores) ; $i++){
            $mediaEdades+=$valores[$i];
        }
        $mediaEdades+=$array['edad'];
        $i++;
        $mediaEdades=$mediaEdades/$i;
        echo "La media de edades es:",$mediaEdades;
        fwrite($fichero,"{$array['edad']}\n");
        fclose($fichero);
    }

    if(existePost()){            
        
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        
        $array = generarArray($nombre,$edad,$descripcion);

        if(noVacios($array)){
            escribirNombreDescripcion($array);
            escribirEdadMostrarMedia($array);
            // echo $array['nombre'];
            // echo $array['edad'];
            // echo $array['descripcion'];
        }
        else{
            echo "ELEMENTOS VACIOS";
        }
        
    } 
?>
