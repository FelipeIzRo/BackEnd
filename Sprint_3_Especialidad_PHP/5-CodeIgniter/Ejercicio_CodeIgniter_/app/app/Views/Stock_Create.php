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
    <h1 class="display-1">Datos del producto</h1>
    <form action="<?= isset($product) ? base_url('stock/update/'.$product['id']) : base_url('stock/create/post')?>" method="POST">
    
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>        
            <input type="text" name="name" class="form-control" value="<?= isset($product) ? esc($product['name']) : '' ?>" <?= isset($product) ? 'disabled' : 'required' ?>>

            <div class="form-text">
                <?php if(isset($validation) && $validation->hasError('name')) :?>
                <p style="color:red;"><?= $validation->getError('name') ?></p>
                <?php endif;?>
            </div>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Cantidad:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" value="<?= isset($product) ? esc($product['quantity']) :'' ?>" require>
            
            <div class="form-text">
                <?php if(isset($validation) && $validation->hasError('quantity')) :?>
                <p style="color:red;"><?= $validation->getError('quantity') ?></p>
                <?php endif;?>  
            </div>      
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio:</label>
            <input type="number" step="0.01" placeholder="0.00" id="price" name="price" class="form-control" value="<?= isset($product) ? esc($product['price']) : '' ?>" require>

            <div class="form-text">
                <?php if(isset($validation) && $validation->hasError('price')) :?>
                <p style="color:red;"><?= $validation->getError('price') ?></p>
                <?php endif;?>
            </div>
        </div>
        
        <button class="<?= isset($product) ? 'btn btn-warning': 'btn btn-primary' ?>" type="submit"><?= isset($product) ? 'Modificar'  : 'Añadir Producto' ?></button>
    </form>
    <br>
    <form action="<?= base_url('/stock')?>" method='GET'>
        <button class="btn btn-primary" type="submit" >Atras</button>
    </form>
</div>
</body>
</html>
