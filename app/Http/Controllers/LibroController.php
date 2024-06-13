<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libro;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LibroFormRequest;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request) {
            $query = trim($request->get('texto'));
            $libros = DB::table('libro')
                /**->where('titulo', 'LIKE' . $query . '%')*/
                ->orderBy('id', 'desc')
                ->paginate(7);
            return view('almacen.libro.index', [
                "libro" => $libros, "texto" => $query
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("almacen.libro.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LibroFormRequest $request)
    {
        //
        $libro = new Libro;
        $libro->titulo = $request->get('titulo');
        $libro->autor = $request->get('autor');
        $libro->numpag = $request->get('numpag');
        $libro->portada = $request->get('portada');
        $libro->save();
        return Redirect::to('almacen/libro');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return view("almacen.libro.show", ["libro" => Libro::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return view("almacen.libro.edit", ["libro" => libro::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LibroFormRequest $request, $id)
    {
        //
        $libro = Libro::findOrFail($id);
        $libro->titulo = $request->get('titulo');
        $libro->autor = $request->get('autor');
        $libro->numpag = $request->get('numpag');
        $libro->portada = $request->get('portada');
        $libro->save();
        $libro->update();
        return Redirect::to('almacen/libro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $libro = Libro::findOrFail($id);
        $libro->delete();
        return Redirect::to('almacen/libro');
        return redirect()->route('libro.index')->with('success', 'libro eliminado correctamente');
    }
}
