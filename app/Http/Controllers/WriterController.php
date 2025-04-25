<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WriterController extends Controller
{
    //
    public function mostrarVistaAutores(Request $request) {

        $autores = Writer::all();

        return view('writerMain', compact('autores'));
    }

    public function showWriter($id) {
        $writer = Writer::findOrFail($id);
        $booksWriter = $writer->books;
        return view('writerView', compact('writer', 'booksWriter'));
    }

    public function indexWriters() 
    {
        $writers = Writer::all();
        return view('writersAdminView', compact('writers'));
    }

    public function showInsert() {
        return view('insertWriterView');
    }

    public function doInsert(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'imagen' => 'required|url',
            'nombre_completo' => 'required|string|max:255',
            'pais' => 'required|string|max:50',
            'nacimiento' => 'required|date_format:Y-m-d',
            'fallecimiento' => 'nullable|date_format:Y-m-d'
        ],[
            'nombre.required' => 'El nombre del autor es obligatorio.',
    'nombre.string' => 'El nombre del autor debe ser una cadena de texto.',
    'nombre.max' => 'El nombre del autor no puede tener más de 255 caracteres.',
    
    'imagen.required' => 'La imagen del autor es obligatoria.',
    'imagen.url' => 'La imagen debe ser una URL válida.',
    
    'nombre_completo.required' => 'El nombre completo del autor es obligatorio.',
    'nombre_completo.string' => 'El nombre completo del autor debe ser una cadena de texto.',
    'nombre_completo.max' => 'El nombre completo del autor no puede tener más de 255 caracteres.',
    
    'pais.required' => 'El país del autor es obligatorio.',
    'pais.string' => 'El país debe ser una cadena de texto.',
    'pais.max' => 'El país del autor no puede tener más de 50 caracteres.',
    
    'nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
    'nacimiento.date_format' => 'La fecha de nacimiento debe tener el formato YYYY-MM-DD.',
    
    'fallecimiento.date_format' => 'La fecha de fallecimiento, si se proporciona, debe tener el formato YYYY-MM-DD.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $writer = new Writer();
        $writer->nombre = $request->nombre;
        $writer->imagen = $request->imagen;
        $writer->nombre_completo = $request->nombre_completo;
        $writer->pais = $request->pais;
        $writer->nacimiento = $request->nacimiento;
        $writer->fallecimiento = $request->fallecimiento;
        $writer->save();

        return redirect()->route('admin.writers')->with('success', 'Autor insertado correctamente.');
    }


    public function edit($id)
    {
        $writer = Writer::findOrFail($id);
        return view('editWriter', compact('writer'));  
    }
    


    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'imagen' => 'required|url',
            'nombre_completo' => 'required|string|max:255',
            'pais' => 'required|string|max:50',
            'nacimiento' => 'required|date_format:Y-m-d',
            'fallecimiento' => 'nullable|date_format:Y-m-d'
        ],[
            'nombre.required' => 'El nombre del autor es obligatorio.',
            'nombre.string' => 'El nombre del autor debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del autor no puede tener más de 255 caracteres.',
            
            'imagen.required' => 'La imagen del autor es obligatoria.',
            'imagen.url' => 'La imagen debe ser una URL válida.',
            
            'nombre_completo.required' => 'El nombre completo del autor es obligatorio.',
            'nombre_completo.string' => 'El nombre completo del autor debe ser una cadena de texto.',
            'nombre_completo.max' => 'El nombre completo del autor no puede tener más de 255 caracteres.',
            
            'pais.required' => 'El país del autor es obligatorio.',
            'pais.string' => 'El país debe ser una cadena de texto.',
            'pais.max' => 'El país del autor no puede tener más de 50 caracteres.',
            
            'nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'nacimiento.date_format' => 'La fecha de nacimiento debe tener el formato YYYY-MM-DD.',
            
            'fallecimiento.date_format' => 'La fecha de fallecimiento, si se proporciona, debe tener el formato YYYY-MM-DD.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $writer = Writer::findOrFail($id);

        $writer->nombre = $request->nombre;
        $writer->imagen = $request->imagen;
        $writer->nombre_completo = $request->nombre_completo;
        $writer->pais = $request->pais;
        $writer->nacimiento = $request->nacimiento;
        $writer->fallecimiento = $request->fallecimiento;
        $writer->save();

        return redirect()->route('admin.writers')->with('success', 'Autor editado correctamente.');
    }

    public function delete($id)
{
    $writer = Writer::findOrFail($id);
    
    $writer->delete();

    return redirect()->route('admin.writers')->with('success', 'Autor eliminado correctamente.');
}

}
