<?php

namespace App\Http\Controllers;

use App\Models\departaments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\countries;
use App\Models\cities;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DepartamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$date['departament']=departaments::paginate(8);
        $countries['countries']=countries::all();
        $cities['cities']=cities::all();
        //para retornar la vista
        return view('departament.index', $countries, $cities);
    }

    public function fetchdepartament()
    {
        $departament = DB::select('SELECT departaments.id, countries.nameCountry , cities.nameCity, departaments.nameDepartament FROM departaments INNER JOIN cities ON cities.id = departaments.city_id INNER JOIN countries ON departaments.country_id = countries.id');
        return response()->json([
            'departament'=>$departament,
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
            "nameDepartament" => 'required|string',
        ];
        $mensajes = [
            "country_id.required" => "La selección del país es obligatorio",
            "city_id.required" => "La selección de la ciudad es obligatorio",
            "nameDepartament.required" => "El nombre del departamento es obligatorio",
            "nameDepartament.string" => "El campo departamento solo permite letras",
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
            $dep = new departaments;
            $dep->country_id = $request->input('country_id');
            $dep->city_id = $request->input('city_id');
            $dep->nameDepartament = $request->input('nameDepartament');
            $dep->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\departaments  $departaments
     * @return \Illuminate\Http\Response
     */
    public function show(departaments $departaments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\departaments  $departaments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departament = departaments::find($id);
        if ($departament) 
        {
            return response()->json([
                'status'=>200,
                'departament'=>$departament,
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
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\departaments  $departaments
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $post = DB::table('departaments')
        ->join('cities','cities.id', '=', 'departaments.city_id')
        ->join('countries', 'countries.id', '=', 'departaments.country_id')
        ->where('nameDepartament','like','%'.$request->get('searchQuest').'%')
        ->orWhere('nameCity','like','%'.$request->get('searchQuest').'%')
        ->orWhere('nameCountry','like','%'.$request->get('searchQuest').'%')
        ->get();

        return json_encode($post);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\departaments  $departaments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $reglas = [
            "country_id" => 'required',
            "city_id" => 'required',
            "nameDepartament" => 'required|string',
        ];
        $mensajes = [
            "country_id.required" => "La selección del país es obligatorio",
            "city_id.required" => "La selección de la ciudad es obligatorio",
            "nameDepartament.required" => "El nombre del departamento es obligatorio",
            "nameDepartament.string" => "El campo departamento solo permite letras",
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
            $departament = departaments::find($id);
            if ($departament) 
            {
                $departament->country_id = $request->input('country_id');
                $departament->city_id = $request->input('city_id');
                $departament->nameDepartament = $request->input('nameDepartament');
                $departament->update();
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
     * @param  \App\Models\departaments  $departaments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departament = departaments::find($id);
        $departament->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
}
