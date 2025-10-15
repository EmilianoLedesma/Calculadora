<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
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
}
