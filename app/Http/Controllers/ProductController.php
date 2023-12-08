<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HelpFuntionController;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function Index()
    {
        try {
            if (session()->has('user')) {
                $datos = Product::latest()->paginate(10);
                return view('product.index', compact('datos'));
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar'.$e);
        }
    }


    public function showprt($id){
        try {
           

                $datos =  Product::findOrFail($id);

        return view('product.showprt', compact('datos'));
   
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }
    public function buscar(Request $request)
    {
        try{
    $query = Product::query();

    // Aplica los filtros de búsqueda si se proporcionan
    if ($request->has('filtro_nombre')) {
        $filtro_nombre = $request->input('filtro_nombre');
        $query->where('nameproduct', 'like', "%$filtro_nombre%");
    }

    // Continúa agregando más filtros si es necesario

    $datos = $query->latest()->paginate(10);

    return view('product.index', compact('datos'));
} catch (Exception $e) {
    return   redirect()->back()->with('error', 'Error al Cargar');
    }
   }
    public  function Sessionstar(){
        if (session()->has('user')) {
            return redirect('/');
        }
    }
  // Esta funcion llama a la vista crear usuarios

// esta funcion llama a la creacion de un registro nuevo desde la seccion de registrar usuarios
   
   





    public function create()
    {
        try {
            if (session()->has('user')) {
                
        return view('product.create');

        }else{
            return redirect('/');
        }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }


    }
    public function store(Request $request){
        try {
            if (session()->has('user')) {
                $Product= new Product();
                $Product->nameproduct =$request->input('nameproduct');
                $Product->description =$request->input('description');
                $Product->stock =$request->input('stock');
             
                $Product->price =$request->input('price');
                $Product->id_usuario =$request->input('id_usuario');
             
                //return $request->input('id_usuario');
                


                if ($request->hasFile('imgproduct') && $request->file('imgproduct')->isValid()) {

                    
                  
                    $file = $request->file('imgproduct');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('filedata/'), $fileName); // Copiar el archivo a la carpeta "public/uploads"
                    $Product->imgproduct='filedata/'.$fileName;
                  
                }

            if ($Product->save()) {
                return redirect()->back()->with('error', 'Creado con éxito');
            }


       return   redirect()->back()->with('error', 'Error al Crear');
    }else{
        return redirect('/');
    }
} catch (Exception $e) {
    return   redirect()->back()->with('error', 'Error al Cargar');
    }
    }
// esta funcion llama a la vista editar
    public function edit($id)
    {
        try {
            if (session()->has('user')) {


                $datos =  Product::findOrFail($id);
       
        
        return view('product.edit', compact('datos'));
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

// esta funcion actualiza los datos en la base d
    public function update(Request $request, $id)
    {
        try {
            if (session()->has('user')) {

                $userdata = session('user');
       
        $Product =Product::findOrFail($id);
        $Product->nameproduct =$request->input('nameproduct');
        $Product->description =$request->input('description');
        $Product->stock =$request->input('stock');
        $Product->price =$request->input('price');
        $Product->id_usuario =$request->input('id_usuario');
     

    
    if ($request->hasFile('imgproduct') && $request->file('imgproduct')->isValid()) {

        $rutaImagen = public_path($Product->imgproduct); 
        if (File::exists($rutaImagen)) {
            File::delete($rutaImagen); // Elimina la imagen
            
        }      
                  
        $file = $request->file('imgproduct');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('filedata/'), $fileName); // Copiar el archivo a la carpeta "public/uploads"
        $Product->imgproduct='filedata/'.$fileName;
      
    }

       
        if( $Product->save()){
            return   redirect()->back()->with('error', 'Actualizado con exito');
        }
        return   redirect()->back()->with('error', 'Error al Actualizar');
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

// esta funcion elimina datos de la tabla
    public function destroy($id)
    {
        try {
            if (session()->has('user')) {
        $dato = Product::findOrFail($id);
        $dato->delete();
        return redirect()->route('product.index');
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

    // login
// esta funcion realiza una verificacion y un login


}
