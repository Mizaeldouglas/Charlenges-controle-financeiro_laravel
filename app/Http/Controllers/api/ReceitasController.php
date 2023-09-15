<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Receitas;
use Illuminate\Http\Request;

class ReceitasController extends Controller
{

    public function findForReceitas()
    {
        $search = request('descricao');
        $findReceitas = Receitas::where('descricao', 'like', "%$search%")->get();

        if ($findReceitas->isEmpty()) {
            return response()->json(["Error" => 'Nenhuma Receita encontrada'], 404);
        }
        return response()->json($findReceitas, 200);
    }

    public function index()
    {
        $receitas = Receitas::all();

        return response()->json($receitas);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validade = $request->validate([
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required|date'
        ]);

        $newReceita = Receitas::create($validade);



        return response()->json($newReceita, 201);
    }

    public function show(string $id)
    {
        $receita = Receitas::find($id);

        if (is_null($receita)) {
            return response()->json(['error' => 'Receita não encontrada'], 404);
        }

        return response()->json($receita, 200);
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        $receita = Receitas::find($id);
        if (is_null($receita)) {
            return response()->json($receita, 404);
        }
        $receita->update($request->all());
        return response()->json(['Alterado com sucesso!' => $receita], 200);
    }

    public function destroy(string $id)
    {
        $receita = Receitas::find($id);

        if (is_null($receita)) {
            return response()->json(['error' => 'receita não não encontrada'], 404);
        }

        $receita->delete();
        return response()->json("Deletado com sucesso!", 200);
    }
}
