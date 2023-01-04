<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$date['typeP']=TypeProduct::paginate(5);*/
        //para retornar la vista
        return view('typeProduct.index');
    }

    public function fetchtypeproduct()
    {
        $typeProducts = TypeProduct::all();
        return response()->json([
            'typeProducts'=>$typeProducts,
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
            "nameTypeProduct" => 'required|string',
        ];
        $mensajes = [
            "nameTypeProduct.required" => "El tipo producto es obligatorio",
            "nameTypeProduct.string" => "El campo tipo producto solo perimite letras",
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
            $tProduct = new TypeProduct;
            $tProduct->nameTypeProduct = $request->input('nameTypeProduct');
            $tProduct->save();
            return response()->json([
                'status'=>200,
                'message'=>'El registro se creo correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $post = DB::table('type_products')->where('nameTypeProduct','like','%'.$request->get('searchQuest').'%')->get();

        return json_encode($post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typeProduct = TypeProduct::find($id);
        if ($typeProduct) 
        {
            return response()->json([
                'status'=>200,
                'typeProduct'=>$typeProduct,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tipo producto no encontrado',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reglas = [
            "nameTypeProduct" => 'required|string',
        ];
        $mensajes = [
            "nameTypeProduct.required" => "El tipo producto es obligatorio",
            "nameTypeProduct.string" => "El campo tipo producto solo perimite letras",
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
            $typeProduct = TypeProduct::find($id);
            if ($typeProduct) 
            {
                $typeProduct->nameTypeProduct = $request->input('nameTypeProduct');
                $typeProduct->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'El registro se actualizo correctamente',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Tipo producto no encontrado',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $typeProduct = TypeProduct::find($id);
        $typeProduct->delete();
        return response()->json([
            'status'=>200,
            'message'=>'El registro se elimino correctamente',
        ]);
    }
}
