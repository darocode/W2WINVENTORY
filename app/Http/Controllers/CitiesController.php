<?php

namespace App\Http\Controllers;

use App\Models\cities;
use App\Models\countries;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$cities['nameC']=cities::paginate(2);*/
        $countries['countries']=countries::all();
        //para retornar la vista
        return view('city.index', $countries);
    }

    public function fetchcity()
    {
        $cities = DB::select('SELECT cities.id , countries.nameCountry , cities.nameCity FROM cities INNER JOIN countries ON cities.country_id = countries.id');
        return response()->json([
            'cities'=>$cities,
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
            "nameCity" => 'required',
        ];
        $mensajes = [
            "country_id.required" => "La selección del país es obligatorio",
            "nameCity.required" => "El nombre de la ciudad es obligatorio",
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
            $cit = new cities;
            $cit->country_id = $request->input('country_id');
            $cit->nameCity = $request->input('nameCity');
            $cit->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $post = DB::table('cities')
        ->join('countries', 'countries.id', '=', 'cities.country_id')
        ->where('nameCity','like','%'.$request->get('searchQuest').'%')
        ->orWhere('countries.nameCountry', 'like','%'.$request->get('searchQuest').'%' )
        ->get();

        return json_encode($post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = cities::find($id);
        if ($city) 
        {
            return response()->json([
                'status'=>200,
                'city'=>$city,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'La ciudad no fue encontrada',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reglas = [
            "country_id" => 'required',
            "nameCity" => 'required',
        ];
        $mensajes = [
            "country_id.required" => "La selección del país es obligatorio",
            "nameCity.required" => "El nombre de la ciudad es obligatorio",
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
            $city = cities::find($id);
            if ($city) 
            {
                $city->country_id = $request->input('country_id');
                $city->nameCity = $request->input('nameCity');
                $city->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se actualizo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'La ciudad no fue encontrada',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = cities::find($id);
        $city->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
}
