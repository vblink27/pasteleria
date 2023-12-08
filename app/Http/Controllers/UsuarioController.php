<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Models\Trolley;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HelpFuntionController;
use Illuminate\Support\Facades\File;
class UsuarioController extends Controller
{

    public function Index()
    {
        try {
            if (session()->has('user')) {
                $datos = Usuario::latest()->paginate(10);
                return view('usuarios.index', compact('datos'));
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar'.$e);
        }
    }


    public function buscar(Request $request)
    {
        try{
    $query = Usuario::query();

    // Aplica los filtros de búsqueda si se proporcionan
    if ($request->has('filtro_nombre')) {
        $filtro_nombre = $request->input('filtro_nombre');
        $query->where('correo', 'like', "%$filtro_nombre%");
    }

    // Continúa agregando más filtros si es necesario

    $datos = $query->latest()->paginate(10);

    return view('usuarios.index', compact('datos'));
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
    public function Registrar_usuario(Request $request){
        try {

            $user = new Usuario();
            $user->nombre_apellido =$request->input('nombre_apellido');
            $user->correo =$request->input('correo');
            $user->usuario =$request->input('usuario');
            $user->roles ='Cliente';
            $user->clave = Hash::make($request->input('clave'));

            if ($user->save()) {
                 
           
                return redirect()->back()->with('error', 'Creado con éxito');
            
            }

        return   redirect()->back()->with('error', 'Error al Crear');
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar '.$e);
         }
    }
    public function Login(Request $request)
    {
        try {
        $correo = $request->input('correo');
        $clave = $request->input('clave');

        // Busca el usuario en la base de datos
        $user = Usuario::where('correo', $correo)->first();
      
        // Verifica si se encontró un usuario y si la contraseña es correcta

       if ($user && Hash::check($clave, $user->clave)) {

          // Inicia la sesión para el usuario
        session(['user' => $user]);

        $count = Trolley::where('id_usuario',$user->id)
        ->where('status', 0 ) ->count();
        
        session(['trolleryCount' => $count]);
       



// Redirecciona a la página de inicio después del inicio de sesión exitoso
return redirect()->route('dashboard');
        }
        // Si las credenciales son inválidas, redirecciona de vuelta al formulario de inicio de sesión con un mensaje de error
        return redirect()->back()->with('error', 'Credenciales inválidas');
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
         }

    }





    public function create()
    {
        try {
            if (session()->has('user')) {
                
        return view('usuarios.create');

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
                $user = new Usuario();
                $user->nombre_apellido =$request->input('nombre_apellido');
                $user->correo =$request->input('correo');
                $user->usuario =$request->input('usuario');
                $user->roles =$request->input('roles');
                $user->dni =$request->input('dni');
                $user->phones =$request->input('phones');
                $user->address =$request->input('address');
                $user->account =$request->input('account');
                


                if ($request->hasFile('imgprofile') && $request->file('imgprofile')->isValid()) {


                    $rutaImagen = public_path($user->imgprofile); 
                    if (File::exists($rutaImagen)) {
                        File::delete($rutaImagen); // Elimina la imagen
                        
                    }
                    $file = $request->file('imgprofile');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/'.$user->correo), $fileName); // Copiar el archivo a la carpeta "public/uploads"
                    $user->imgprofile='uploads/'.$user->correo.'/'.$fileName;
                  
                }

                $user->clave = Hash::make($request->input('clave'));

            if ($user->save()) {
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


                $datos =  Usuario::findOrFail($id);
       
        
        return view('usuarios.edit', compact('datos'));
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
        $user =Usuario::findOrFail($id);
        $user->nombre_apellido =$request->input('nombre_apellido');
        if(!empty($request->input('correo'))){
            $user->correo =$request->input('correo');
        }
        
        $user->usuario =$request->input('usuario');
       $user->roles =$request->input('roles');
       $clave=$request->input('clave');
      $user->dni=$request->input('dni');
      $user->phones=$request->input('phones');
      $user->address=$request->input('address');
      $user->account=$request->input('account');

     

      if ($request->hasFile('imgprofile') && $request->file('imgprofile')->isValid()) {

        $rutaImagen = public_path($user->imgprofile); 
        if (File::exists($rutaImagen)) {
            File::delete($rutaImagen); // Elimina la imagen
            
        }
        $file = $request->file('imgprofile');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/'.$userdata->correo), $fileName); // Copiar el archivo a la carpeta "public/uploads"
        $user->imgprofile='uploads/'.$userdata->correo.'/'.$fileName;
      
    }

        if($clave == $user->clave){
            $user->clave = $request->input('clave');
            if($user->save()){
                if(session('user')->roles!='Administrador'){
                $user =Usuario::findOrFail($id);
                session(['user' => $user]);
                return   redirect()->back()->with('error', 'Actualizado con exito, Clave no editada');
                }

            }
             }else{
            $user->clave = Hash::make($request->input('clave'));
            if($user->save()){
                if(session('user')->roles!='Administrador'){
                $user =Usuario::findOrFail($id);
                session(['user' => $user]);
                return   redirect()->back()->with('error', 'Actualizado con exito Clave editada');
            }
            }
        }

        if($user->save()){
            if(session('user')->roles!='Administrador'){
                $user =Usuario::findOrFail($id);
                session(['user' => $user]);
                return   redirect()->back()->with('error', 'Actualizado con exito');
            }else{
                if(session('user')->id==$id){
                $user =Usuario::findOrFail($id);
                session(['user' => $user]);
                return   redirect()->back()->with('error', 'Actualizado con exito');
                }else{
                    return   redirect()->back()->with('error', 'Actualizado con exito');
                }

            }
     
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
        $dato = Usuario::findOrFail($id);
        
        $dato->delete();
        return redirect()->route('usuarios.index');
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
