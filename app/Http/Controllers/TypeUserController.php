<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typeUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TypeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$date['typeU']=typeUser::paginate(8);
        //para retornar la vista
        return view('typeUser.index', $date);*/
        return view('typeUser.index');

    }
    
    public function fetchtypeuser()
    {
        $typeUsers = typeUser::all();
        return response()->json([
            'typeUsers'=>$typeUsers,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //para retornar la vista
        //return view('typeUser.index');
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
            "typeUser" => 'required|string',
        ];
        $mensajes = [
            "typeUser.required" => "El tipo usuario es obligatorio",
            "typeUser.string" => "El campo tipo usuario solo permite letras",
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
            $tUser = new typeUser;
            $tUser->typeUser = $request->input('typeUser');
            $tUser->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\typeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $post = DB::table('type_users')->where('typeUser','like','%'.$request->get('searchQuest').'%')->get();

        return json_encode($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\typeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typeUsers = typeUser::find($id);
        if ($typeUsers) 
        {
            return response()->json([
                'status'=>200,
                'typeUsers'=>$typeUsers,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tipo usuario no encontrado',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\typeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reglas = [
            "typeUser" => 'required|string',
        ];
        $mensajes = [
            "typeUser.required" => "El tipo usuario es obligatorio",
            "typeUser.alpstringha" => "El campo tipo usuario solo permite letras",
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
            $tUser = typeUser::find($id);
            if ($tUser) 
            {
                $tUser->typeUser = $request->input('typeUser');
                $tUser->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se actualizo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Tipo usuario no encontrado',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\typeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tUser = typeUser::find($id);
        $tUser->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
}
