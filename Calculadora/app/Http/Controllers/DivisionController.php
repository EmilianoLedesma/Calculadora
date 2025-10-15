<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function dividir(Request $request)
    {
        // Validar que los datos vienen en el request
        $request->validate([
            'num1' => 'required|numeric',
            'num2' => 'required|numeric'
        ]);

        $num1 = $request->input('num1');
        $num2 = $request->input('num2');

        // Validar división entre cero
        if ($num2 == 0) {
            return response()->json([
                'error' => 'No se puede dividir entre cero'
            ], 422);
        }

        $resultado = $num1 / $num2;

        return response()->json([
            'resultado' => $resultado,
            'operacion' => "$num1 / $num2"
        ]);
    }
}
