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
    <h1 class="display-1">Stock</h1>

    <?php if(session()->getFlashdata('success')): ?>
        <div id="div-success" class="alert alert-success" style="transition: opacity 0.3s ease;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif(session()->getFlashdata('error')): ?>
        <div id="div-error" class="alert alert-danger" style="transition: opacity 0.3s ease;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php else: ?>
        <br><br>
    <?php endif; ?>

    <ul class="list-group">
        <?php foreach($products as $product): ?>
            <li class="list-group-item" style="display:inline-flex; gap: 30px;"><a class="h3" 
            href="<?=base_url('/stock/view/'.$product['id'])?>"><?= $product['name'] ?></a>
            <p class="h3">Cantidad: <?= $product['quantity'] ?></p>
                <form action="<?=base_url('/stock/remove/'.$product['id'])?>" method="POST">
                    <button type="submit" class="btn btn-danger">Eliminar producto</button>                
                </form>
                <form action="<?=base_url('/stock/edit/'.$product['id'])?>" method="GET">
                    <button type="submit" class="btn btn-warning">Modificar producto</button>                
                </form>
            </li>
        <?php endforeach;?>
    </ul>
    <br>
    <form action="/stock/create" method="GET">
        <button type="submit" class="btn btn-primary">Añadir Producto</button>
    </form>    
</div>
<script>
    var succesAlert = document.getElementById('div-success');
    var errorAlert = document.getElementById('div-error');
    setTimeout(function() { 
        succesAlert.style.opacity = 0;    
    }, 2000);
    setTimeout(function() {
        errorAlert.style.opacity = 0;    
    }, 2000);
</script>
</body>
</html>
