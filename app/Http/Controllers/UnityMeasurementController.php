<?php

namespace App\Http\Controllers;

use App\Models\unityMeasurement;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class UnityMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        /*$date['unityM']=unityMeasurement::paginate(8);*/
        //para retornar la vista
        return view('unityMeasurement.index');
    }

    public function fetchunitymeasurement()
    {
        $unityMeasurements = unityMeasurement::all();
        return response()->json([
            'unityMeasurements'=>$unityMeasurements,
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
            "typeMeasurement" => 'required|string',
        ];
        $mensajes = [
            "typeMeasurement.required" => "La unidad de medida es obligatorio",
            "typeMeasurement.string" => "El campo unidad de medida solo perimite letras",
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

            
            $tMeasurement = new unityMeasurement;
            $tMeasurement->typeMeasurement = $request->input('typeMeasurement');
            $tMeasurement->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\unityMeasurement  $unityMeasurement
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $post = DB::table('unity_measurements')->where('typeMeasurement','like','%'.$request->get('searchQuest').'%')->get();

        return json_encode($post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\unityMeasurement  $unityMeasurement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $unityMeasurement = unityMeasurement::find($id);
        if ($unityMeasurement) 
        {
            return response()->json([
                'status'=>200,
                'unityMeasurement'=>$unityMeasurement,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Unidad de medida no encontrada',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\unityMeasurement  $unityMeasurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reglas = [
            "typeMeasurement" => 'required|string',
        ];
        $mensajes = [
            "typeMeasurement.required" => "La unidad de medida es obligatorio",
            "typeMeasurement.string" => "El campo unidad de medida solo perimite letras",
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
            $tMeasurement = unityMeasurement::find($id);
            if ($tMeasurement) 
            {
                $tMeasurement->typeMeasurement = $request->input('typeMeasurement');
                $tMeasurement->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se actualizo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Unidad de medida no encontrada',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\unityMeasurement  $unityMeasurement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tMeasurement = unityMeasurement::find($id);
        $tMeasurement->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
}
