<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\typeClients;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$date['client']=Client::all();
        $typeClient['typeClient']=typeClients::all();
        /*$user['user']=User::all();
        $sectorMaster['sectorMaster']=SectorMaster::all();*/

        return view('client.index', $typeClient);
    }

    public function fetchclient()
    {
        $client = DB::select('SELECT clients.id, clients.imageClient, clients.mailClient, clients.nameClient, clients.phoneClient, type_clients.typeClient FROM `clients` INNER JOIN type_clients ON clients.type_client_id = type_clients.id');
        return response()->json([
            'client'=>$client,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            "nameClient" => 'required',
            "phoneClient" => 'required',
            "mailClient" => 'required',
            "type_client_id" => 'required',
            "imageClient" => 'required|image',
        ];
        $mensajes = [
            "nameClient.required" => "El nombre del cliente es obligatorio",
            "phoneClient.required" => "El telefono del cliente es obligatorio",
            "mailClient.required" => "El email del cliente es obligatorio",
            "type_client_id.required" => "La selección del tipo cliente es obligatorio",
            "imageClient.required" => "La imagen del cliente es obligatorio",
            "imageClient.image" => "Solo se permiten imagenes",
        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $path = 'img/';
            $image = $request->file('imageClient');
            $nombre_archivo = time().'_'.$image->getClientOriginalName();
            $upload = $image->storeAs($path, $nombre_archivo, 'public');

            if($upload){
                Client::insert([
                    'nameClient'=>$request->input('nameClient'),
                    'phoneClient'=>$request->input('phoneClient'),
                    'mailClient'=>$request->input('mailClient'),
                    'imageClient'=>$nombre_archivo,
                    'type_client_id'=>$request->input('type_client_id'),
                ]);
            }
            
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $post = DB::table('clients')
        ->where('nameClient','like','%'.$request->get('searchQuest').'%')
        ->orWhere('phoneClient','like','%'.$request->get('searchQuest').'%')
        ->orWhere('mailClient','like','%'.$request->get('searchQuest').'%')
        ->get();

        return json_encode($post);
        
    }

    public function viewInfoClient($id)
    {
        $clients = DB::select('SELECT clients.id, clients.imageClient, clients.mailClient, clients.nameClient, clients.phoneClient, type_clients.typeClient FROM `clients` INNER JOIN type_clients ON clients.type_client_id = type_clients.id WHERE clients.id = '.$id);
        if ($clients) 
        {
            return response()->json([
                'status'=>200,
                'clients'=>$clients,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'El cliente no fue encontrado',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = DB::select('SELECT clients.id, clients.imageClient, clients.mailClient, clients.nameClient, clients.phoneClient, type_clients.typeClient FROM `clients` INNER JOIN type_clients ON clients.type_client_id = type_clients.id WHERE clients.id = '.$id);
        if ($clients) 
        {
            return response()->json([
                'status'=>200,
                'clients'=>$clients,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'El cliente no fue encontrado',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reglas = [
            "nameClient" => 'required',
            "phoneClient" => 'required',
            "mailClient" => 'required',
            "type_client_id" => 'required',
        ];
        $mensajes = [
            "nameClient.required" => "El nombre del cliente es obligatorio",
            "phoneClient.required" => "El telefono del cliente es obligatorio",
            "mailClient.required" => "El email del cliente es obligatorio",
            "type_client_id.required" => "La selección del tipo cliente es obligatorio",
        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $clients = Client::find($id);
            if ($clients) 
            {
                $clients->nameClient = $request->input('nameClient');
                $clients->phoneClient = $request->input('phoneClient');
                $clients->mailClient = $request->input('mailClient');
                $clients->type_client_id = $request->input('type_client_id');
                $clients->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se actualizo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'El departamento no fue encontrado',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
}