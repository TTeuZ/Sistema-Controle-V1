<?php

namespace App\Http\Controllers\API;

use App\Cabos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AutoEletrica;
use Validator;

class CabosController extends Controller
{
    public function index()
    {
        return response()->json(Cabos::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nome' => 'required|string|max:15',
            'tipo' =>  'required|string|max:50',
            'situacao' => 'boolean',
            'quantidade' => 'required|integer',
            'auto_eletrica_id' => 'required|integer'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors());

        if (!AutoEletrica::find($request->auto_eletrica_id))
            return response()->json('Auto Eletrica nao existe');

        $request->request->add(['user_name_created' => $request->user()->name]);
        $cabo = Cabos::create($request->all());
        return response()->json($cabo);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nome' => 'string|max:15',
            'tipo' =>  'string|max:50',
            'quantidade' => 'integer'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors());

        $cabo = Cabos::find($id);
        $request->request->add(['user_name_updated' => $request->user()->name]);
        $cabo->update($request->all());
        return response()->json($cabo);
    }

    public function changeSituation($id) {
        $cabo = Cabos::find($id);

        $cabo->situacao = !$cabo->situacao;

        $cabo->update();
        return response()->json($cabo);
    }

    public function destroy($id)
    {
        $cabo = Cabos::find($id);
        $cabo->delete();
    }
}