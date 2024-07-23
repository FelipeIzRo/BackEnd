@extends('layout')

@section('content')
    <div class="content">        
        <ul class="list-group">    
            @isset($pelicula)        
            <li class="list-group-item" style="background-color:rgba(184,218,255,100);"><h1>{{$pelicula->nombre}}</h1></li>
            
            <li class="list-group-item">Genero: {{$pelicula->genero}}</li>
            <li class="list-group-item">Año de publicación: {{$pelicula->anio}}</li>
            <li class="list-group-item">Puntuacion: {{$pelicula->puntuacion}}</li>
            <li class="list-group-item">Sinopsis:<br>{{$pelicula->sinopsis}}</li>            
            @endisset()
        </ul>
    </div>
    <form action="{{ route('index') }}" method="get">
        <br><button type="submit" class="btn btn-primary">Volver</button>
    </form>
@endsection()
