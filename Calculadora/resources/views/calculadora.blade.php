<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

            <button class="boton limpiar">C</button>
            <button class="boton operador">←</button>
            <button class="boton operador">/</button>

            <button class="boton numero">7</button>
            <button class="boton numero">8</button>
            <button class="boton numero">9</button>
            <button class="boton operador">×</button>

            <button class="boton numero">4</button>
            <button class="boton numero">5</button>
            <button class="boton numero">6</button>
            <button class="boton operador">-</button>

            <button class="boton numero">1</button>
            <button class="boton numero">2</button>
            <button class="boton numero">3</button>
            <button class="boton operador">+</button>

            <button class="boton cero numero">0</button>
            <button class="boton numero">.</button>
            <button class="boton igual">=</button>
        </div>
    </div>

</body>
</html>
