<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\countries;
use App\Models\cities;
use App\Models\departaments;
use App\Models\Site;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$date['warehouse']=Warehouse::paginate(8);
        $countries['countries']=countries::all();
        $countries['cities']=cities::all();
        $countries['departaments']=departaments::all();
        $countries['sites']=Site::all();

        return view('warehouse.index',$countries);
    }

    public function fetchwarehouse()
    {
        $Warehouse = DB::select('SELECT warehouses.id, countries.nameCountry, cities.nameCity, departaments.nameDepartament, sites.nameSite, direction FROM `warehouses` INNER JOIN countries ON countries.id = warehouses.country_id INNER JOIN cities ON cities.id = warehouses.city_id INNER JOIN departaments ON departaments.id = warehouses.departament_id INNER JOIN sites ON sites.id = warehouses.site_id');
        return response()->json([
            'Warehouse'=>$Warehouse,
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
            "country_id" => 'required',
            "city_id" => 'required',
            "departament_id" => 'required',
            "site_id" => 'required',
            "direction" => 'required|string',
        ];
        $mensajes = [
            "country_id.required" => "La selección del país es obligatorio",
            "city_id.required" => "La selección de la ciudad es obligatorio",
            "departament_id.required" => "La selección del departamento es obligatorio",
            "site_id.required" => "La selección del siti es obligatorio",
            "direction.required" => "La dirección es obligatoria",
            "direction.string" => "El campo dirección solo permite letras",
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
            $warehouse = new Warehouse;
            $warehouse->country_id = $request->input('country_id');
            $warehouse->city_id = $request->input('city_id');
            $warehouse->departament_id = $request->input('departament_id');
            $warehouse->site_id = $request->input('site_id');
            $warehouse->direction = $request->input('direction');
            $warehouse->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $post = DB::table('warehouses')
        ->join('cities', 'cities.id', '=', 'warehouses.city_id')
        ->join('countries','countries.id', '=', 'warehouses.country_id')
        ->join('departaments', 'departaments.id', '=','warehouses.departament_id' )
        ->join('sites', 'sites.id', '=', 'warehouses.site_id')
        ->where('departaments.nameDepartament','like','%'.$request->get('searchQuest').'%')
        ->orWhere('cities.nameCity', 'like','%'.$request->get('searchQuest').'%')
        ->orWhere('countries.nameCountry','like','%'.$request->get('searchQuest').'%' )
        ->orWhere('direction','like','%'.$request->get('searchQuest').'%')
        ->orWhere('sites.nameSite','like','%'.$request->get('searchQuest').'%')
        ->get();

        return json_encode($post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        if ($warehouse) 
        {
            return response()->json([
                'status'=>200,
                'warehouse'=>$warehouse,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'El pais no se encontro',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $reglas = [
            "country_id" => 'required',
            "city_id" => 'required',
            "departament_id" => 'required',
            "site_id" => 'required',
            "direction" => 'required|string',
        ];
        $mensajes = [
            "country_id.required" => "La selección del país es obligatorio",
            "city_id.required" => "La selección de la ciudad es obligatorio",
            "departament_id.required" => "La selección del departamento es obligatorio",
            "site_id.required" => "La selección del siti es obligatorio",
            "direction.required" => "La dirección es obligatoria",
            "direction.string" => "El campo dirección solo permite letras",
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
            $warehouse = Warehouse::find($id);
            if ($warehouse) 
            {
                $warehouse->country_id = $request->input('country_id');
                $warehouse->city_id = $request->input('city_id');
                $warehouse->departament_id = $request->input('departament_id');
                $warehouse->site_id = $request->input('site_id');
                $warehouse->direction = $request->input('direction');
                $warehouse->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se actualizo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'El pais no se encontro',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
}
