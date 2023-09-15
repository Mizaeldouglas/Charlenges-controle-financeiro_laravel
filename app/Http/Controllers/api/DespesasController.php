<?php

namespace App\Http\Controllers\api;

use App\Models\Despesas;
use App\Enums\CategoriaEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DespesasController extends Controller
{

    public function findForDespesas()
    {
        $search = request('descricao');
        $findDespesas = Despesas::where('descricao', 'like', "%$search%")->get();

        if ($findDespesas->isEmpty()) {
            return response()->json(["Error" => 'Nenhuma Despesas encontrada'], 404);
        }
        return response()->json($findDespesas, 200);
    }

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
        $data = $request->all();

        if (empty($data['categoria'])) {
            $data['categoria'] = CategoriaEnum::OUTRAS;
        }


        $messages = [
            'categoria.in' => 'A categoria deve ser uma das seguintes: ' . implode(', ', CategoriaEnum::values()),
        ];

        $validator = Validator::make($data, [
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required|date',
            'categoria' => [
                'required',
                Rule::in(CategoriaEnum::values())

            ]
        ], $messages);

        if ($validator->fails()) {
            return response()->json(["Error" => $validator->errors()], 400);
        }

        $newDespesas = Despesas::create($data);

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