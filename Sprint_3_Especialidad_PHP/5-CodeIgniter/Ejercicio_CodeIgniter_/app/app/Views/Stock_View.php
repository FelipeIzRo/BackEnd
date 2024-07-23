<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Stock</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<div>
    <h1 class="display-1"><?= $product['name'] ?></h1>
    <ul class="list-group">            
        <li class="list-group-item">Cantidad: <?= $product['quantity'] ?></li>
        <li class="list-group-item">Precio: <?= $product['price'] ?></li>
    </ul>
    <br>
    <form action="<?= base_url('/stock')?>" method='GET'>
        <button class="btn btn-primary" type="submit" >Atras</button>
    </form>
</div>
</body>
</html>
