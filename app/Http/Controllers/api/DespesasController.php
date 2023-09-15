<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Despesas;
use Illuminate\Http\Request;

class DespesasController extends Controller
{
    public function index()
    {
        $despesas = Despesas::all();

        return response()->json($despesas, 200);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required|date'
        ]);

        $newDespesas = Despesas::create($validate);

        if (is_null($newDespesas)) {
            return response()->json(["Error" => 'não foi possivel criar uma nova despesa'], 404);
        }

        return response()->json($newDespesas, 201);
    }

    public function show(string $id)
    {
        $despesa = Despesas::find($id);

        if (is_null($despesa)) {
            return response()->json(["Error" => 'Essa despesa não foi encontrada'], 400);
        }

        return response()->json($despesa, 200);
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        $despesas = Despesas::find($id);
        if (is_null($despesas)) {
            return response()->json(["Error" => 'Essa despesa não foi encontrada'], 404);
        }
        $despesas->update($request->all());
        $despesas->save;

        return response()->json($despesas, 201);
    }

    public function destroy(string $id)
    {
        $despesas = Despesas::find($id);
        if (is_null($despesas)) {
            return response()->json(["Error" => 'Essa despesa não foi encontrada'], 404);
        }
        $despesas->delete();
        return response()->json("Essa despesa  '({$despesas['descricao']})' foi deletada", 201);
    }
}