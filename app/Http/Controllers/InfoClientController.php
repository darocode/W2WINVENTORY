<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Site;
use App\Models\SubClient;
use App\Models\Warehouse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class InfoClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries['Warehouse']=Warehouse::all();
        $countries['sites']=Site::all();
        //para retornar la vista
        return view('infoClient.index', $countries);
    }

    /* CLIENT */
    public function edit($id)
    {
        $infoClient = Client::find($id);
        $countries['Client']=DB::select("SELECT clients.id, clients.nameClient, clients.phoneClient, clients.mailClient, clients.imageClient, type_clients.typeClient FROM `clients` INNER JOIN type_clients ON type_clients.id = clients.type_client_id WHERE clients.id =".$id);
        $countries['SubClient']=SubClient::find($id);
        $countries['Warehouse']=Warehouse::all();
        $countries['sites']=Site::all();

        return view('infoClient.index', compact('infoClient'), $countries);
    }

    public function fetchinfoclient($id)
    {
        $clientinfo = DB::select('SELECT clients.id, clients.imageClient, clients.mailClient, clients.nameClient, clients.phoneClient, type_clients.typeClient FROM `clients` INNER JOIN type_clients ON clients.type_client_id = type_clients.id WHERE clients.id = '.$id);
        return response()->json([
            'clientinfo'=>$clientinfo,
        ]);
    }
    /* CLIENT END */

    /* SUBCLIENT */
    public function fetchsubclient($id)
    {
        $subclient = DB::select('SELECT sub_clients.id, sub_clients.identifierSubClient, clients.nameClient, sites.nameSite, warehouses.direction FROM `sub_clients` INNER JOIN clients ON clients.id = sub_clients.client_id INNER JOIN warehouses ON warehouses.id = sub_clients.warehouse_id INNER JOIN sites ON sites.id = sub_clients.site_id WHERE sub_clients.client_id ='.$id);
        return response()->json([
            'subclient'=>$subclient,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storesubclient(Request $request)
    {
        $reglas = [
            "identifierSubClient" => 'required',
            "warehouse_id" => 'required',
            "site_id" => 'required',
        ];
        $mensajes = [
            "identifierSubClient.required" => "El identificador del sub cliente es obligatorio",
            "warehouse_id.required" => "La selección del almacen es obligatorio",
            "site_id.required" => "La selección del sitio es obligatorio",
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
            $sub = new SubClient;
            $sub->client_id = $request->input('client_id');
            $sub->identifierSubClient = $request->input('identifierSubClient');
            $sub->warehouse_id = $request->input('warehouse_id');
            $sub->site_id = $request->input('site_id');
            $sub->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    public function editsubclient($id)
    {
        $subClient = SubClient::find($id);
        if ($subClient) 
        {
            return response()->json([
                'status'=>200,
                'subClient'=>$subClient,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'El departamento no fue encontrada',
            ]);
        }
    }

    public function updatesubclient(Request $request,$id)
    {
        $reglas = [
            "identifierSubClient" => 'required',
            "warehouse_id" => 'required',
            "site_id" => 'required',
        ];
        $mensajes = [
            "identifierSubClient.required" => "El identificador del sub cliente es obligatorio",
            "warehouse_id.required" => "La selección del almacen es obligatorio",
            "site_id.required" => "La selección del sitio es obligatorio",
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
            $subClient = SubClient::find($id);
            if ($subClient) 
            {
                $subClient->client_id = $request->input('client_id');
                $subClient->identifierSubClient = $request->input('identifierSubClient');
                $subClient->warehouse_id = $request->input('warehouse_id');
                $subClient->site_id = $request->input('site_id');
                $subClient->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se actualizo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'El sub-cliente no fue encontrada',
                ]);
            }
        }
    }
    public function action(Request $request)
    {
        $post = DB::table('sub_clients')
        ->join('sites', 'sites.id', '=', 'sub_clients.site_id')
        ->join('warehouses', 'warehouses.id', '=', 'sub_clients.warehouse_id')
        ->where('identifierSubClient','like','%'.$request->get('searchQuest').'%')
        ->orWhere('nameSite','like','%'.$request->get('searchQuest').'%')
        ->orWhere('identifierWarehouse','like','%'.$request->get('searchQuest').'%')
        ->get();

        return json_encode($post);
        
    }

    public function siteSearch(Request $request){
        $post = DB::table('sites')
        ->where('nameSite','like','%'.$request->get('searchQuest').'%')
        ->orWhere('identifierSite','like','%'.$request->get('searchQuest').'%')
        ->get();

        return json_encode($post);
    }

    public function destroysubClient($id)
    {
        $subClient = SubClient::find($id);
        $subClient->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
    /* SUBCLIENT END*/

    /* SITE */
    public function fetchsite($id)
    {
        $site = DB::select('SELECT sites.id, sites.identifierSite, sites.nameSite, clients.nameClient FROM `sites` INNER JOIN clients ON clients.id = sites.client_id WHERE sites.client_id ='.$id);
        return response()->json([
            'site'=>$site,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storesite(Request $request)
    {
        $reglas = [
            "identifierSite" => 'required',
            "nameSite" => 'required',
        ];
        $mensajes = [
            "identifierSite.required" => "El codigo del sitio es obligatorio",
            "nameSite.required" => "El nombre del sitio es obligatorio",
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
            $sit = new Site;
            $sit->identifierSite = $request->input('identifierSite');
            $sit->nameSite = $request->input('nameSite');
            $sit->client_id = $request->input('client_id');
            $sit->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    public function editsite($id)
    {
        $site = Site::find($id);
        if ($site) 
        {
            return response()->json([
                'status'=>200,
                'site'=>$site,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'El sitio no fue encontrado',
            ]);
        }
    }

    public function updatesite(Request $request,$id)
    {
        $reglas = [
            "identifierSite" => 'required',
            "nameSite" => 'required',
        ];
        $mensajes = [
            "identifierSite.required" => "El codigo del sitio es obligatorio",
            "nameSite.required" => "El nombre del sitio es obligatorio",
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
            $site = Site::find($id);
            if ($site) 
            {
                $site->identifierSite = $request->input('identifierSite');
                $site->nameSite = $request->input('nameSite');
                $site->client_id = $request->input('client_id');
                $site->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se actualizo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'El sitio no fue encontrada',
                ]);
            }
        }
    }

    public function destroysite($id)
    {
        $site = Site::find($id);
        $site->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
    /* SITE END */
}
