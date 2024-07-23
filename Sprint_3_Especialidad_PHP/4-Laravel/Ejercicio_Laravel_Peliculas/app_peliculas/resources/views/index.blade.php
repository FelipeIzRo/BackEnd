@extends('layout')

@section('content')
    <div class='container'>
        <h1>Lista de peliculas disponibles</h1>
        <table class="table table-striped">
            <thead>
                <tr class="table-primary">
                    <th>Nombre</th>
                    <th>Género</th>
                    <th>Año</th>
                </tr>
            </thead>

            <tbody>
                @isset($peliculas)
                    @foreach($peliculas as $pelicula)
                        <tr class="darken-on-hover p-3" onclick="verPelicula({{ $pelicula->id }})">
                            <td class="table-light">{{ $pelicula->nombre }}</td>
                            <td class="table-light">{{ $pelicula->genero }}</td>
                            <td class="table-light d-flex botones_tabla" style="justify-content:space-between; align-items:center;">{{ $pelicula->anio }}
                                <form action="{{ route('eliminar', $pelicula->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar esta película?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                </form>
                                <form action="{{ route('pre_modificar', $pelicula->id) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Modificar</button>
                                </form>
                            </td>   
                            
                        </tr>
                    @endforeach
                @endisset                
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="crearPelicula()">Añadir pelicula</button>                
    </div>
    <script>
        function verPelicula(id) 
        {
            console.log('ID de la película:', id);
            window.location.href = "{{ url('/peliculas') }}/" + id;            
        }
        function crearPelicula()
        {
            window.location.href = "{{ url('/crear_pelicula') }}";
        }
    </script>
@endsection()