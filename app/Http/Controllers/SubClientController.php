<?php

namespace App\Http\Controllers;

use App\Models\SubClient;
use Illuminate\Http\Request;

class SubClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $reglas = [
            "client_id" => 'required',
            "country_id" => 'required',
            "city_id" => 'required',
            "departament_id" => 'required',
            "site_id" => 'required',
        ];
        $mensajes = [
            "required" => "Campo Obligatorio",
            "alpha" => "Permitido solo letras",
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
            $sub->country_id = $request->input('country_id');
            $sub->city_id = $request->input('city_id');
            $sub->departament_id = $request->input('departament_id');
            $sub->site_id = $request->input('site_id');
            $sub->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubClient  $subClient
     * @return \Illuminate\Http\Response
     */
    public function show(SubClient $subClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubClient  $subClient
     * @return \Illuminate\Http\Response
     */
    public function edit(SubClient $subClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubClient  $subClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubClient $subClient)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubClient  $subClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubClient $subClient)
    {
        //
    }
}
