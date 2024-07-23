@extends('layout')
@section('content')
@isset($pelicula)
    @if(is_null($pelicula))
        <form action="{{ route('formulario.enviar') }}" method="post">
    @else
        <form action="{{ route('modificar', $pelicula->id) }}" method="POST">
            @method('POST')
    @endif
@else
    <form action="{{ route('formulario.enviar') }}" method="post">
@endif
    @csrf    
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ isset($pelicula) ? $pelicula->nombre : '' }}" required>

    <label for="genero">Genero:</label>
    <input type="text" id="genero" name="genero" class="form-control" value="{{ isset($pelicula) ? $pelicula->genero : '' }}" required>

    <label for="anio">Año:</label>
    <input type="number" id="anio" name="anio" class="form-control" value="{{ isset($pelicula) ? $pelicula->anio : '' }}" required>

    <label for="puntuacion">Puntuación:</label><br>
    <div class="btn-group" role="group" aria-label="Puntuación">
        <button type="button" class="btn btn-secondary" data-value="1" onclick="clicado(1,this)">1</button>
        <button type="button" class="btn btn-secondary" data-value="2" onclick="clicado(2,this)">2</button>
        <button type="button" class="btn btn-secondary" data-value="3" onclick="clicado(3,this)">3</button>
        <button type="button" class="btn btn-secondary" data-value="4" onclick="clicado(4,this)">4</button>
        <button type="button" class="btn btn-secondary" data-value="5" onclick="clicado(5,this)">5</button>
        <input type="hidden" id="puntuacion" name="puntuacion" value="{{ isset($pelicula) ? $pelicula->puntuacion : '' }}" required>
    </div>
    <br>

    <label for="sinopsis">Sinopsis:</label>
    <input type="text" id="sinopsis" name="sinopsis" class="form-control" value="{{ isset($pelicula) ? $pelicula->sinopsis : '' }}" required>

    @isset($pelicula)
        <br><button type="submit" class="btn btn-primary">Actualizar</button>
    @else
        <br><button type="submit" class="btn btn-primary">Enviar</button>
    @endisset
    
</form>
<form action="{{ route('index') }}" method="get">
        <br><button type="submit" class="btn btn-primary">Volver</button>
</form>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        var puntuacionInput = document.getElementById('puntuacion');
        var puntuacionValue = '{{ isset($pelicula) ? $pelicula->puntuacion : '' }}';

        // Si hay una puntuación preseleccionada, encontrar y activar el botón correspondiente
        if (puntuacionValue !== '') {
            var buttons = document.querySelectorAll('.btn-group button');
            buttons.forEach(function(btn) {
                if (btn.getAttribute('data-value') === puntuacionValue) {
                    btn.classList.add('active');
                }
            });
        }
    });

    function clicado(value, boton) {
        var input = document.getElementById('puntuacion');
        input.value = value;

        // Remover la clase 'active' de todos los botones
        var buttons = document.querySelectorAll('.btn-group button');
        buttons.forEach(function(btn) {
            btn.classList.remove('active');
        });

        // Agregar la clase 'active' solo al botón clicado
        boton.classList.add('active');
    }
</script>

@endsection
