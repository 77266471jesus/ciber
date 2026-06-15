<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ public_path('css/tailwind.css') }}" type="text/css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Boleta</title>
    <style>
        .header {
            width: 100%;
            height: 80px;
        }

        .header .datos_empresa {
            width: 240px;
            text-align: left;
        }
        .datos_empresa h1 {
            font-size: 25px;
            font-weight: 800;
        }
        .datos_empresa h2 {
            margin-top: -2px;
            font-size: 12px;
            text-align: justify;
            text-transform: uppercase;
            font-weight: 100;
            color: rgb(51, 51, 51);
        }
        .datos_empresa h3 {
            margin-top: -2px;
            font-size: 12px;
            text-align: justify;
            text-transform: uppercase;
            font-weight: 100;
            color: rgb(51, 51, 51);
        }
        h1 {
            font-size: 16px;
            font-weight: 500;
        }
        h2 {
            font-size: 14px;
            margin-top: -4px;
        }
        .header .datos_comprobante {
            position: absolute;  
            margin-left: 450px;
            top: 0;  
            margin-top: 30px;        
        }
        .datos_comprobante_nit{
            position: absolute;
            height: 30px;
            width: 90px;
        }
        .datos_comprobante_numeros{
            position: absolute;
            height: 30px;
            width: 150px;
            margin-left: 100px;
        }
        .nit {
            margin-left: 80px;
            font-weight: 100;
            color: rgb(51, 51, 51);
        }

        .numero {
            margin-left: 20px;
            font-weight: 100;
            color: rgb(51, 51, 51);
        }

        .tipo_comprobante {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .tipo_comprobante h1 {
            font-size: 25px;
            color: green;
            font-weight: 900;
            margin-top: 30px;
            letter-spacing: 5px;
        }

        .cliente {
            width: 100%;
        }

        .datos_cliente {
            position: absolute;
            height: 30px;
            width: 100px;
        }

        .datos_cliente_datos {
            position: absolute;
            height: 30px;
            width: 500px;
            margin-left: 100px;
        }
        .tabla {
            margin-top: 80px;
            width: 100%;
        }

        .tabla_detalle {
            width: 100%;
        }
        .tabla_header{
            text-align: center;
        }
        .tabla_body{
            text-align: center;
        }
        .title {
            font-size: 12px;
        }
        .parrafo {
            font-size: 12px;
        }
        .producto{
            font-size: 12px;
            text-align: left;
        }
        .comprobante_footer{
            width: 100%;
            margin: 30px, 50px;
        }
        .comprobante_footer p{
            padding: 10px;
            font-size: 12px;
            text-align: center;
            margin: 0 -12px;
        }
        .comprobante_footer span{
            padding: 10px;
            font-size: 11px;
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="datos_empresa">
            <h1>CIBERTEL S.R.L.</h1>
            <h3>CASA MATRIZ: Avenida 6 de marzo N° 222, Edificio Luisa, Piso 2, Of. 200, Zona Villa Bolívar B</h3>
        </div>
        <div class="datos_comprobante">
            <div class="datos_comprobante_nit">
                <h2>NIT.:</h2>
                <h2>BOLETA N°:</h2>
            </div>
            <div class="datos_comprobante_numeros">
                <h2>0129660357</h2>
                <h2>00{{ $venta->comprobante}}</h2>
            </div>
        </div>
    </div>
    <div class="tipo_comprobante">
        <h1>BOLETA DE VENTA</h1>
    </div>
    <div class="cliente">
        <div class="datos_cliente">
            <h2>Fecha:</h2>
            <h2>Señor(a):</h2>
            <h2>NIT/CI:</h2>
            <h2>Direccion:</h2>
        </div>
        <div class="datos_cliente_datos">
            <h2>{{ $venta->fecha }}</h2>
            <h2>{{ $venta->cliente->nombre }}</h2>
            <h2>{{ $venta->cliente->documento }}</h2>
            <h2>{{ $venta->cliente->direccion }}</h2>
        </div>       
    </div>
    <div class="tabla">
        <table border="2" class="tabla_detalle">
            <thead class="tabla_header">
                <tr>
                    <th class="title">CODIGO</th>
                    <th class="title">CANTIDAD</th>
                    <th class="title">DESCRIPCIÓN</th>
                    <th class="title">PRECIO</th>
                    <th class="title">DESCUENTO</th>
                    <th class="title">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody class="tabla_body">
                @foreach ($venta->detalleVentas as $detalle)
                    <tr>
                        <td class="parrafo">{{ $detalle->producto->codigo }}</td>
                        <td class="parrafo">{{ $detalle->cantidad}}</td>
                        <td class="producto">{{ $detalle->producto->nombre }}</td>
                        <td class="parrafo">{{ $detalle->precio_venta}}</td>
                        <td class="parrafo">{{ $detalle->descuento}}</td>
                        <td class="parrafo">{{ $detalle->subtotal}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" rowspan="2" class="parrafo"></td>                    
                    <th class="title">SUBTOTAL:</th>
                    <td class="parrafo">{{ $venta->total_venta }}</td>
                </tr>
                <tr>                  
                    <th class="title">TOTAL:</th>
                    <td class="parrafo">{{ $venta->total}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="comprobante_footer">
        <p>Correo: cibertel.smart@gmail.com</p>
        <p>Teléfonos: 77735173, 77731201, 79660357</p>
        <p>El Alto, La Paz - Bolivia</p>            
    </div>

</body>

</html>
