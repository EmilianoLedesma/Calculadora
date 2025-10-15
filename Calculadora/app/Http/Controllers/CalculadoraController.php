<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function multiplicar(Request $request)
    {
        $request->validate([
            'num1' => 'required|numeric',
            'num2' => 'required|numeric'
        ]);

        $num1 = $request->input('num1');
        $num2 = $request->input('num2');
        $resultado = $num1 * $num2;

        return response()->json([
            'resultado' => $resultado
        ]);
    }

    public function dividir(Request $request)
    {
        $request->validate([
            'num1' => 'required|numeric',
            'num2' => 'required|numeric'
        ]);

        $num1 = $request->input('num1');
        $num2 = $request->input('num2');

        // Validar que no se divida entre cero
        if ($num2 == 0) {
            return response()->json([
                'error' => 'No se puede dividir entre cero'
            ], 400);
        }

        $resultado = $num1 / $num2;

        return response()->json([
            'resultado' => $resultado
        ]);
    }

    public function raiz(Request $request)
    {
        $request->validate([
            'num' => 'required|numeric'
        ]);

        $num = $request->input('num');

        // Validar que no se calcule raíz de número negativo
        if ($num < 0) {
            return response()->json([
                'error' => 'No se puede calcular raíz de número negativo'
            ], 400);
        }

        $resultado = sqrt($num);

        return response()->json([
            'resultado' => $resultado
        ]);
    }
}
