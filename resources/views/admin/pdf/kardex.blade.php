<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $producto->nombre }} fecha: {{ $fecha }}</title>
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
        height: 50px;
    }

    .izquierda {
        width: 200px;
        height: 80px;
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
        margin-left: 100px;
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
        margin-top: 40px;
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
        <h1>KARDEX FISICO VALORADO</h1>
        <h2>Expresado en Bolivianos</h2>
        <h2>({{ $fecha }})</h2>
    </div>
    <div class="detalle">
        <div class="izquierda">
            <div class="izquierda_letra">
                <h3>Producto:</h3>
            </div>
            <div class="izquierda_cont">
                <h3>{{ $producto->nombre }}</h3>
            </div>
        </div>        
    </div>
    <div class="detalle">
        <div class="izquierda">
            <div class="izquierda_letra">
                <h3>Codigo:</h3>
                <h3>Medida:</h3>
            </div>
            <div class="izquierda_cont">
                <h3>{{ $producto->codigo }}</h3>
                <h3>{{ $producto->medida }}</h3>
            </div>
        </div>
        <div class="derecha">
            <div class="derecha_letra">
                <h3>Sistema:</h3>
            </div>
            <div class="derecha_cont">
                <h3>PEPS</h3>
            </div>
        </div>
    </div>
    <div class="tabla">
        <table border="1" class="tabla_detalle">
            <thead class="tabla_header">
                <tr>
                    <th rowspan="2" class="title">FECHA</th>
                    <th rowspan="2" class="title">DETALLE</th>
                    <th rowspan="2" class="title">C/U</th>
                    <th colspan="2" class="title">CANTIDAD</th>                    
                    <th colspan="2" class="title">PRECIO</th>                    
                    <th colspan="2" class="title">TOTALES</th>                    
                </tr>
                <tr>                    
                    <th class="title">ENTRADA</th>
                    <th class="title">SALIDA</th>
                    <th class="title">ENTRADA</th>
                    <th class="title">SALIDA</th>
                    <th class="title">CANTIDAD</th>
                    <th class="title">PRECIO</th>
                </tr>
            </thead>
            <tbody class="tabla_body">
                @foreach ($kardexs as $kardex)
                    <tr>
                        <td class="parrafo">{{ $kardex->fecha }}</td>
                        <td class="kardex_detalle">{{ $kardex->detalle }}</td>
                        <td class="parrafo">{{ $kardex->costo_unitario }}</td>
                        <td class="parrafo">{{ $kardex->cantidad_entrada }}</td>
                        <td class="parrafo">{{ $kardex->cantidad_salida }}</td>
                        <td class="parrafo">{{ $kardex->precio_entrada }}</td>
                        <td class="parrafo">{{ $kardex->precio_salida }}</td>
                        <td class="parrafo">{{ $kardex->cantidad_total }}</td>
                        <td class="parrafo">{{ $kardex->precio_total }}</td>
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
