<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estado de resultado</title>
</head>
<style>
    .titulo {
        width: 100%;
        text-align: center;
        margin-bottom: 20px;
    }

    .titulo h1 {
        font-size: 20px;
    }

    .titulo h2 {
        font-size: 16px;
    }

    .detalle {
        position: relative;
        width: 100%;
        height: 70px;
    }

    .izquierda {
        width: 100%;
        height: 70px;
        left: 0;
        top: 0;
    }

    .izquierda .izquierda_letra {
        position: absolute;
        top: 0;
        left: 0;
    }

    .izquierda .izquierda_letra h3 {
        font-size: 16px;
    }

    .izquierda .izquierda_cont {
        position: absolute;
        margin-left: 130px;
        top: 0;
    }

    .izquierda .izquierda_cont h3 {
        font-size: 16px;
    }

    .derecha {
        position: absolute;
        width: 200px;
        height: 80px;
        right: 0;
        top: 0;
    }

    .derecha .derecha_letra {
        position: absolute;
    }

    .derecha .derecha_letra h3 {
        font-size: 16px;
    }

    .derecha .derecha_cont {
        position: absolute;
        margin-left: 80px;
    }

    .derecha .derecha_cont h3 {
        font-size: 16px;
    }

    .tabla {
        width: 100%;
    }

    .tabla_detalle {
        width: 100%;
    }

    .tabla_header {
        text-align: center;
    }

    .tabla_body {
        text-align: center;
    }

    .title {
        font-size: 12px;
    }

    .parrafo {
        font-size: 12px;
    }

    .kardex_detalle {
        font-size: 12px;
        text-align: left;
    }
    .firma{
        margin-top: 60px;
        width: 100%;        
    }
    .firma p{
        line-height: 5px;
        text-align: center;
    }
</style>

<body>
    <div class="titulo">
        <h1>RESULTADOS</h1>
        <h2>Expresado en Bolivianos</h2>
        <h2>({{ $fecha }})</h2>
    </div>
    <div class="detalle">
        <div class="izquierda">
            <div class="izquierda_letra">
                <h3>Total Kardex:</h3>
                <h3>Total Compras:</h3>
            </div>
            <div class="izquierda_cont">
                <h3>{{ $kardex }}</h3>
                <h3>{{ $compras }}</h3>
            </div>
        </div>
    </div>
    <div class="detalle">
        <div class="izquierda">
            <div class="izquierda_letra">
                <h3>Total Ventas:</h3>
                <h3>Total Descuentos:</h3>
            </div>
            <div class="izquierda_cont">
                <h3>{{ $ventas }}</h3>
                <h3>{{ $descuentos }}</h3>
            </div>
        </div>
    </div>
    <div style="height: 20px">
    </div>
    <div class="tabla">
        <table border="1" class="tabla_detalle">
            <thead class="tabla_header">
                <tr>
                    <th class="title">CODIGO</th>
                    <th class="title">PRODUCTO</th>
                    <th class="title">STOCK</th>
                    <th class="title">KARDEX</th>
                    <th class="title">COMPRAS</th>
                    <th class="title">VENTAS</th>
                    <th class="title">DESCUENTOS</th>
                </tr>
            </thead>
            <tbody class="tabla_body">
                @foreach ($productos as $producto)
                    <tr>
                        <td class="parrafo">{{ $producto->codigo }}</td>
                        <td class="kardex_detalle">{{ $producto->nombre }}</td>
                        <td class="parrafo">{{ $producto->stock }} ({{ $producto->medida }}s)</td>
                        <td class="parrafo">{{ $producto->kardex }}</td>
                        <td class="parrafo">{{ $producto->compras }}</td>
                        <td class="parrafo">{{ $producto->ventas }}</td>
                        <td class="parrafo">{{ $producto->descuentos }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="firma">
        <p>{{ Auth::user()->name }}</p>
        <p>{{ Auth::user()->cargo }}</p>
    </div>
</body>

</html>
