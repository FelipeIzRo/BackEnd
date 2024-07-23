<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use App\Rules\YearValidationRule;

class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return view('index',compact('peliculas'));
    }

    public function show($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('show',compact('pelicula'));
    }
    public function mostrarFormulario()
    {
        return view('form');
    }
    public function crear(Request $request)
    {

        $validateData = $request->validate([
            'nombre' => 'required|string',
            'genero' => 'required|string',
            'anio' => ['required', new YearValidationRule],
            'puntuacion' => 'required',
            'sinopsis' => 'required|string',
        ]);

        $pelicula = Pelicula::create($validateData);

        return redirect()->route('index')->with('success', 'Formulario enviado correctamente');
        
    }

    public function eliminiar($id)
    {
        $pelicula = Pelicula::find($id);

        if ($pelicula) {
            $pelicula->delete();
            return redirect()->route('index')->with('success', 'Película eliminada correctamente.');
        }

        return redirect()->route('index')->with('error', 'Película no encontrada.');
    }

    public function pre_modificar($id)
    {
        $pelicula = Pelicula::find($id);
        if ($pelicula) {
            return view('form', compact('pelicula'));
        }
    }
    public function modificar(Request $request, $id)
    {
        
        $validateData = $request->validate([
            'nombre' => 'required|string',
            'genero' => 'required|string',
            'anio' => ['required', new YearValidationRule],
            'puntuacion' => 'required',
            'sinopsis' => 'required|string',
        ]);

        $pelicula = Pelicula::find($id);

        if ($pelicula) {
            $pelicula->nombre = $validateData['nombre'];
            $pelicula->genero = $validateData['genero'];
            $pelicula->anio = $validateData['anio'];
            $pelicula->puntuacion = $validateData['puntuacion'];
            $pelicula->sinopsis = $validateData['sinopsis'];           

            $pelicula->save();

            return redirect()->route('index')->with('success', 'Película actualizada correctamente.');
        }

        return view('index');
    }
}
