<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\countries;
use App\Models\cities;
use App\Models\departaments;
use App\Models\Warehouse;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$date['site']=Site::paginate(5);*/
        //para retornar la vista
        return view('siteA.index');
    }

    public function edit($id)
    {
        $infoSite = Site::find($id);
        $countries['countries']=countries::all();
        $countries['cities']=cities::all();
        $countries['departaments']=departaments::all();
        $countries['sites']=Site::all();
        /*$countries['Client']=DB::select("SELECT clients.id, clients.nameClient, clients.phoneClient, clients.mailClient, clients.imageClient, type_clients.typeClient FROM `clients` INNER JOIN type_clients ON type_clients.id = clients.type_client_id WHERE clients.id =".$id);
        $countries['SubClient']=SubClient::find($id);
        $countries['Warehouse']=Warehouse::all();
        $countries['sites']=Site::all();*/
        return view('siteA.index', compact('infoSite'), $countries);
    }

    public function fetchsiteQ($id)
    {
        $infoSite = DB::select('SELECT id, identifierSite, nameSite FROM `sites` WHERE id ='.$id);
        return response()->json([
            'infoSite'=>$infoSite,
        ]);
    }

    public function fetchwarehouse($id)
    {
        $warehouse = DB::select('SELECT warehouses.identifierWarehouse, countries.nameCountry, cities.nameCity, departaments.nameDepartament, sites.nameSite, warehouses.direction FROM `warehouses` INNER JOIN countries ON countries.id = warehouses.country_id INNER JOIN cities ON cities.id = warehouses.city_id INNER JOIN departaments ON departaments.id = warehouses.departament_id INNER JOIN sites ON sites.id = warehouses.site_id WHERE warehouses.site_id ='.$id);
        return response()->json([
            'warehouse'=>$warehouse,
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\departaments  $departaments
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $post = DB::table('warehouses')
        ->join('cities','cities.id', '=', 'warehouses.city_id')
        ->join('countries', 'countries.id', '=', 'warehouses.country_id')
        ->join('departaments', 'departaments.id', '=', 'warehouses.departament_id')
        ->join('sites', 'sites.id', '=', 'warehouses.site_id')
        ->where('identifierWarehouse','like','%'.$request->get('searchQuest').'%')
        ->orWhere('direction','like','%'.$request->get('searchQuest').'%')
        ->orWhere('nameCity','like','%'.$request->get('searchQuest').'%')
        ->orWhere('nameCountry','like','%'.$request->get('searchQuest').'%')
        ->orWhere('nameDepartament','like','%'.$request->get('searchQuest').'%')
        ->orWhere('identifierSite','like','%'.$request->get('searchQuest').'%')
        ->get();    

        return json_encode($post);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storewarehouse(Request $request)
    {
        $reglas = [
            "identifierWarehouse" => 'required',
            "country_id" => 'required',
            "city_id" => 'required',
            "departament_id" => 'required',
            "site_id" => 'required',
            "direction" => 'required',
        ];
        $mensajes = [
            "identifierWarehouse.required" => "El identificador del almacen es obligatorio",
            "country_id.required" => "La selección del país es obligatorio",
            "city_id.required" => "La selección de la ciudad es obligatorio",
            "departament_id.required" => "La selección del departamento es obligatorio",
            "site_id.required" => "La selección del sitio es obligatorio",
            "direction.required" => "La dirrección del almacen es obligatorio",
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
            $alm = new Warehouse;
            $alm->identifierWarehouse = $request->input('identifierWarehouse');
            $alm->country_id = $request->input('country_id');
            $alm->city_id = $request->input('city_id');
            $alm->departament_id = $request->input('departament_id');
            $alm->site_id = $request->input('site_id');
            $alm->direction = $request->input('direction');
            $alm->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }
    /*
    public function fetchsite()
    {
        $sites = Site::all();
        return response()->json([
            'sites'=>$sites,
        ]);
    }*/

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
    /*
    public function store(Request $request)
    {
        $reglas = [
            "nameSite" => 'required',
        ];
        $mensajes = [
            "required" => "Campo Obligatorio",
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
            $sit->nameSite = $request->input('nameSite');
            $sit->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }*/

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit($id)
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
                'message'=>'Sitio no encontrado',
            ]);
        }
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    /*
    public function update(Request $request, $id)
    {
        $reglas = [
            "nameSite" => 'required',
        ];
        $mensajes = [
            "required" => "Campo Obligatorio",
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
                $site->nameSite = $request->input('nameSite');
                $site->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se creo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Sitio no encontrado',
                ]);
            }
        }
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy($id)
    {
        //
        $sit = Site::find($id);
        $sit->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }*/
}
