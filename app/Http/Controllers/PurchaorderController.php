<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Product;
use App\Models\Trolley;
use App\Models\Purchaorder;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HelpFuntionController;
use Illuminate\Support\Facades\File;
use  App\Mail\EviarCorreo;
use Illuminate\Support\Facades\Mail;
class PurchaorderController extends Controller
{
    public function Index()
    {
        try {
            if (session()->has('user')) {
              

                $datos = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
                ->has('Usuario')
                ->has('Trolley')
                ->has('repartido')
                ->latest()
                ->has('cliente')
                ->paginate(10);
            
                $repartidor = Usuario::where('roles', 'Repartidor')->paginate(10);
                
                $matriz=compact('datos','repartidor');
                return view('purchaorder.index', compact('matriz'));
            } else {
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar'.$e);
        }
    }


   
    public function buscar(Request $request)
    {
        try {
            $filtroCorreo = $request->input('filtro_correo');
    
            $datos = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
            ->whereHas('cliente', function ($query) {
                $query->where('correo', $filtroCorreo );
            })
            ->has('Usuario')
            ->has('Trolley')
            ->has('repartido')
            ->latest()
            ->paginate(10);
        
        $repartidor = Usuario::where('roles', 'Repartidor')->paginate(10);
        
        $matriz = compact('datos', 'repartidor');
        return view('purchaorder.index', compact('matriz'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al Cargar');
        }
    }
    
  // Esta funcion llama a la vista crear usuarios

// esta funcion llama a la creacion de un registro nuevo desde la seccion de registrar usuarios
   
   





  
    public function ordertcreate($id)
    {
       
            if (session()->has('user')) {


                $datos =  Trolley::with([ 'Product'])
                        ->latest()
                        ->has('Product')
                        ->paginate(10) 
                        ->find($id);
                        $repartidor = Usuario::where('roles', 'Repartidor')->get();
                $matriz = compact('repartidor', 'datos');

        return view('purchaorder.create', compact('matriz'));
           }else{
             return redirect('/');
              }
  


    }
    public function store(Request $request){
        
            if (session()->has('user')) {
                $userdata = session('user');
                $Purchaorder= new Purchaorder();
                $Purchaorder->pricetotal =$request->input('pricetotal');
                $Purchaorder->status =$request->input('status');
                $Purchaorder->address =$request->input('address');
             
                $Purchaorder->units =$request->input('units');
                $Purchaorder->id_usuario =$request->input('id_usuario');
                $Purchaorder->id_cliente =$request->input('id_cliente');
                $Purchaorder->id_repartidor =$request->input('id_repartidor');
                $Purchaorder->id_trolley =$request->input('id_trolley');
               
                //return $request->input('id_usuario');
                
                if ($request->hasFile('img_pago') && $request->file('img_pago')->isValid()) {

                  
                    $file = $request->file('img_pago');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/'.$userdata->correo), $fileName); // Copiar el archivo a la carpeta "public/uploads"
                    $Purchaorder->img_pago='uploads/'.$userdata->correo.'/'.$fileName;
                  
                }else{
                    return   redirect()->back()->with('error', 'No envio en comprabante');
                }

            if ( $Purchaorder->save()) {
                $user = session('user');
                $Trolley =Trolley::findOrFail($request->input('id_trolley'));
                $Trolley->status ='1';
                $Trolley->save();
                $count = Trolley::where('id_usuario', $user->id)
                ->where('status', 0)
                ->count();

                $Product =Product::findOrFail($Trolley->id_product);
                $Product->stock= $Product->stock-$request->input('units');
                $Product->save();
              
                session(['trolleryCount' => $count]);

                $dato = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
                ->has('Usuario')
                ->has('Trolley')
                ->has('repartido')
                ->latest()
                ->has('cliente')->find($Purchaorder->id);
             
                PurchaorderController::enviarcorreo($dato->cliente->correo, $dato->id);

                return redirect()->back()->with('error', 'Creado con éxito');
            }


       return   redirect()->back()->with('error', 'Error al Crear');
    }else{
        return redirect('/');
    }

    }

    public function enviarcorreo($correo,$id){
        Mail::to($correo)->send(new EviarCorreo($id) );

    }
// esta funcion llama a la vista editar
    public function edit(Request $request,$id)
    {
        try {
            if (session()->has('user')) {
  
                $dato = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
                ->has('Usuario')
                ->has('Trolley')
                ->has('repartido')
                ->latest()
                ->has('cliente')->find($id);
             
            //    PurchaorderController::enviarcorreo('polk.vernaza12@gmail.com',$id);
        return view('purchaorder.edit', compact('dato'));
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }


    public function enviarcorreodestino($id)
    {
        try {
            if (session()->has('user')) {
  
                $dato = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
                ->has('Usuario')
                ->has('Trolley')
                ->has('repartido')
                ->latest()
                ->has('cliente')->find($id);
                
                PurchaorderController::enviarcorreo($dato->cliente->correo,$id);
                return   redirect()->back()->with('error', 'Enviado');
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

                $dato =Purchaorder::findOrFail($id);
               /* $frutas = explode("/", $dato->img_pago);
                $rutafile =   $frutas[1] .'/'.$frutas[2].'/'.$frutas[3].'/'.$frutas[4].'/'.$frutas[5]   ;*/
                //return   $rutafile;
                 
                
                                 $rutafile2 = public_path($dato->img_pago); // Ruta completa al archivo en la carpeta 'public'
                
                                if (File::exists($rutafile2)) {
                                    File::delete($rutafile2); // Elimina el archivo
                                }


       
        $dato->delete();
        return redirect()->route('purchaorder.index');
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

    public function cancelar($id)
    {
        try {
            if (session()->has('user')) {
                $Purchaorder=Purchaorder::findOrFail($id);
               $Purchaorder->status="repayment";
               $Purchaorder->save();
               $dato = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
               ->has('Usuario')
               ->has('Trolley')
               ->has('repartido')
               ->latest()
               ->has('cliente')->find($id);
               
               PurchaorderController::enviarcorreo($dato->cliente->correo,$id);
        return redirect()->route('purchaorder.index');
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

    public function completar($id)
    {
        try {
            if (session()->has('user')) {
                $Purchaorder=Purchaorder::findOrFail($id);
               $Purchaorder->status="Completed";
               $Purchaorder->save();
               $dato = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
               ->has('Usuario')
               ->has('Trolley')
               ->has('repartido')
               ->latest()
               ->has('cliente')->find($id);
               
               PurchaorderController::enviarcorreo($dato->cliente->correo,$id);


        return redirect()->route('purchaorder.index');
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

    public function img_completar(Request $request,$id)
    {
        try {
            
            if (session()->has('user')) {
                $userdata = session('user');
                $Purchaorder=Purchaorder::findOrFail($id);

                if ($request->hasFile('img_delivery') && $request->file('img_delivery')->isValid()) {

                  
                    $file = $request->file('img_delivery');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/'.$userdata->correo), $fileName); // Copiar el archivo a la carpeta "public/uploads"
                    $Purchaorder->img_delivery='uploads/'.$userdata->correo.'/'.$fileName;
                  
                }
               
               $Purchaorder->save();
        return redirect()->route('purchaorder.index');
            }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

    public function enviarorden(Request $request,$id)
    {
        try {
            if (session()->has('user')) {
                $Purchaorder=Purchaorder::findOrFail($id);
               $Purchaorder->status="Sent";
               $Purchaorder->save();
               $dato = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
               ->has('Usuario')
               ->has('Trolley')
               ->has('repartido')
               ->latest()
               ->has('cliente')->find($id);
               
               PurchaorderController::enviarcorreo($dato->cliente->correo,$id);
               PurchaorderController::enviarcorreo($dato->repartido->correo,$id);
        return redirect()->route('purchaorder.index');
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

    public function repartidores(Request $request,$id)
    {
        try {
            if (session()->has('user')) {
                $Purchaorder=Purchaorder::findOrFail($id);
               $Purchaorder->id_repartidor=$request->input('id_repartidor');
               $Purchaorder->save();
        return redirect()->route('purchaorder.index');
    }else{
        return redirect('/');
    }
    } catch (Exception $e) {
        return   redirect()->back()->with('error', 'Error al Cargar');
        }
    }

}
