<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Models\Product;
use App\Models\Trolley;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HelpFuntionController;
use Illuminate\Support\Facades\File;
class TrolleyController extends Controller
{
    public function Index()
    {
        try {
            if (session()->has('user')) {
           
                $datos = Trolley::with('Product','Usuario')
                ->has('Product')
                ->latest()
                ->has('Usuario')->paginate(10);
                return view('trolley.index', compact('datos'));
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar'.$e);
        }
    }


    public function ordert($id){
        try {
           

                $datos =  Trolley::findOrFail($id);

        return view('trolley.ordert', compact('datos'));
   
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }
    public function buscar(Request $request)
    {
        try{
    $query = Trolley::query();

    // Aplica los filtros de búsqueda si se proporcionan
    if ($request->has('filtro_nombre')) {
        $filtro_nombre = $request->input('filtro_nombre');
        $query->where('nameproduct', 'like', "%$filtro_nombre%");
    }

    // Continúa agregando más filtros si es necesario

    $datos = $query->latest()->paginate(10);

    return view('trolley.index', compact('datos'));
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
                
        return view('trolley.create');

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
                $user = session('user');
                $Trolley= new Trolley();
                $Trolley->status =0;
                $Trolley->id_usuario =$request->input('id_usuario');
                $Trolley->id_product =$request->input('id_product');
             
             
                //return $request->input('id_usuario');


            if ($Trolley->save()) {
                $count = Trolley::where('id_usuario', $user->id)
        ->where('status', 0)
        ->count();
        session(['trolleryCount' => $count]);
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


                $datos =  Trolley::findOrFail($id);
       
        
        return view('trolley.edit', compact('datos'));
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
       
        $Product =Trolley::findOrFail($id);
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
                $user = session('user');
        $dato = Trolley::findOrFail($id);
        $dato->delete();

        $count = Trolley::where('id_usuario', $user->id)
        ->where('status', 0)
        ->count();
        session(['trolleryCount' => $count]);
        return redirect()->route('trolley.index');
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
