<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Calculadora Sencilla</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .calculadora-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #667eea;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .calculadora {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .pantalla {
            grid-column: 1 / -1;
            background: #2d3748;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: right;
            font-size: 32px;
            margin-bottom: 10px;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            word-wrap: break-word;
            word-break: break-all;
        }

        .boton {
            padding: 20px;
            font-size: 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            background: #f7fafc;
            color: #2d3748;
        }

        .boton:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .boton:active {
            transform: translateY(0);
        }

        .boton.numero {
            background: #f7fafc;
            color: #2d3748;
        }

        .boton.operador {
            background: #667eea;
            color: white;
        }

        .boton.igual {
            grid-column: span 2;
            background: #48bb78;
            color: white;
        }

        .boton.limpiar {
            grid-column: span 2;
            background: #f56565;
            color: white;
        }

        .boton.cero {
            grid-column: span 2;
        }

        @media (max-width: 480px) {
            .calculadora-container {
                padding: 20px;
            }

            .boton {
                padding: 15px;
                font-size: 18px;
            }

            .pantalla {
                font-size: 24px;
                min-height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="calculadora-container">
        <h1>Calculadora</h1>
        <div class="calculadora">
            <div class="pantalla" id="pantalla">0</div>

            <button class="boton limpiar" onclick="limpiar()">C</button>
            <button class="boton operador" onclick="borrar()">←</button>
            <button class="boton operador" onclick="agregarOperador('/')">/</button>

            <button class="boton numero" onclick="agregarNumero('7')">7</button>
            <button class="boton numero" onclick="agregarNumero('8')">8</button>
            <button class="boton numero" onclick="agregarNumero('9')">9</button>
            <button class="boton operador" onclick="agregarOperador('*')">×</button>

            <button class="boton numero" onclick="agregarNumero('4')">4</button>
            <button class="boton numero" onclick="agregarNumero('5')">5</button>
            <button class="boton numero" onclick="agregarNumero('6')">6</button>
            <button class="boton operador" onclick="agregarOperador('-')">-</button>

            <button class="boton numero" onclick="agregarNumero('1')">1</button>
            <button class="boton numero" onclick="agregarNumero('2')">2</button>
            <button class="boton numero" onclick="agregarNumero('3')">3</button>
            <button class="boton operador" onclick="agregarOperador('+')">+</button>

            <button class="boton cero numero" onclick="agregarNumero('0')">0</button>
            <button class="boton numero" onclick="agregarNumero('.')">.</button>
            <button class="boton igual" onclick="calcular()">=</button>
        </div>
    </div>

    <script>
        let pantallaValor = '0';
        let operadorActual = null;
        let valorAnterior = null;
        let reiniciarPantalla = false;

        function actualizarPantalla() {
            document.getElementById('pantalla').textContent = pantallaValor;
        }

        function agregarNumero(numero) {
            if (reiniciarPantalla) {
                pantallaValor = numero;
                reiniciarPantalla = false;
            } else {
                if (pantallaValor === '0' && numero !== '.') {
                    pantallaValor = numero;
                } else {
                    if (numero === '.' && pantallaValor.includes('.')) {
                        return;
                    }
                    pantallaValor += numero;
                }
            }
            actualizarPantalla();
        }

        function agregarOperador(operador) {
            if (valorAnterior !== null && operadorActual !== null && !reiniciarPantalla) {
                if (operadorActual === '/') {
                    dividir();
                    return;
                }
                calcular();
            }
            valorAnterior = parseFloat(pantallaValor);
            operadorActual = operador;
            reiniciarPantalla = true;
        }

        async function dividir() {
            if (valorAnterior !== null && operadorActual === '/') {
                const valorActual = parseFloat(pantallaValor);
                try {
                    const response = await fetch('/dividir', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            num1: valorAnterior,
                            num2: valorActual
                        })
                    });
                    const data = await response.json();
                    if (data.resultado !== undefined) {
                        pantallaValor = data.resultado.toString();
                    } else {
                        pantallaValor = data.error || 'Error';
                    }
                } catch (error) {
                    pantallaValor = 'Error';
                }
                operadorActual = null;
                valorAnterior = null;
                reiniciarPantalla = true;
                actualizarPantalla();
            }
        }

        async function calcular() {
            if (operadorActual === null || valorAnterior === null) {
                return;
            }
            const valorActual = parseFloat(pantallaValor);
            if (operadorActual === '/') {
                dividir();
                return;
            }
            // Solo la multiplicación está implementada
            if (operadorActual === '*') {
                try {
                    const response = await fetch('/multiplicar', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            num1: valorAnterior,
                            num2: valorActual
                        })
                    });

                    const data = await response.json();
                    pantallaValor = data.resultado.toString();
                } catch (error) {
                    pantallaValor = 'Error';
                }
            }
            // Las demás operaciones no están implementadas aún

            operadorActual = null;
            valorAnterior = null;
            reiniciarPantalla = true;
            actualizarPantalla();
        }

        function limpiar() {
            pantallaValor = '0';
            operadorActual = null;
            valorAnterior = null;
            reiniciarPantalla = false;
            actualizarPantalla();
        }

        function borrar() {
            if (pantallaValor.length > 1) {
                pantallaValor = pantallaValor.slice(0, -1);
            } else {
                pantallaValor = '0';
            }
            actualizarPantalla();
        }
    </script>
</body>
</html>
