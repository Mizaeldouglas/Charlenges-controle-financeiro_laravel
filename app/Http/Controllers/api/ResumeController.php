<?php

namespace App\Http\Controllers\api;

use App\Models\Despesas;
use App\Models\Receitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ResumeController extends Controller
{
    public function resumoPorMes($ano, $mes)
    {
        $valorTotalReceitas = Receitas::whereYear('data', $ano)
            ->whereMonth('data', $mes)
            ->sum('valor');

        $valorTotalDespesas = Despesas::whereYear('data', $ano)
            ->whereMonth('data', $mes)
            ->sum('valor');

        $saldoFinal = $valorTotalReceitas - $valorTotalDespesas;

        $totalGastoPorCategoria = Despesas::whereYear('data', $ano)
            ->whereMonth('data', $mes)
            ->select('categoria', DB::raw('SUM(valor) as total_gasto'))
            ->groupBy('categoria')
            ->get();

        $resumo = [
            'valor_total_receitas' => $valorTotalReceitas,
            'valor_total_despesas' => $valorTotalDespesas,
            'saldo_final' => $saldoFinal,
            'total_gasto_por_categoria' => $totalGastoPorCategoria,
        ];
        return response()->json($resumo, 200);
    }
}
