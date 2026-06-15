<table>
    <thead>
        <tr>
            <th colspan="13"></th>
        </tr>  
        <tr>
            <th colspan="13">KARDEX FISICO VALORADO</th>
        </tr>  
        <tr>
            <th colspan="13">({{$mes}}/{{$anio}})</th>
        </tr> 
        <tr>
            <th colspan="13"></th>
        </tr> 
        <tr>
            <th colspan="2">CODIGO</th>
            <th colspan="2">{{$producto->codigo}}</th>
            <th colspan="5"></th>
            <th colspan="2">SISTEMAS</th>
            <th colspan="2">PEPS</th>
        </tr>
        <tr>
            <th colspan="2">PRODUCTO</th>
            <th colspan="6">{{$producto->nombre}}</th>
            <th colspan="1"></th>
            <th colspan="2">MEDIDA</th>
            <th colspan="2">{{$producto->medida}}</th>
        </tr>
        <tr>
            <th colspan="13"></th>
        </tr> 
        <tr>
            <th rowspan="2">FECHA</th>
            <th rowspan="2">DETALLE</th>
            <th rowspan="2">C/U</th>
            <th colspan="2">CANTIDAD</th>
            <th colspan="2">PRECIO</th>
            <th colspan="2">TOTALES</th>
            <th rowspan="2">TIPO</th>
            <th rowspan="2">SALDO CANTIDAD</th>
            <th rowspan="2">CANTIDAD INICIAL</th>
            <th rowspan="2">ESPECIFICACIONES</th>        
        </tr>
        <tr>
            <th>ENTRADA</th>
            <th>SALIDA</th>
            <th>ENTRADA</th>
            <th>SALIDA</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kardexs as $kardex)
            <tr>
                <td>{{ $kardex->fecha }}</td>
                <td>{{ $kardex->detalle }}</td>
                <td>{{ $kardex->costo_unitario }}</td>
                <td>{{ $kardex->cantidad_entrada }}</td>
                <td>{{ $kardex->cantidad_salida }}</td>
                <td>{{ $kardex->precio_entrada }}</td>
                <td>{{ $kardex->precio_salida }}</td>
                <td>{{ $kardex->cantidad_total }}</td>
                <td>{{ $kardex->precio_total }}</td>
                <td>{{ $kardex->estado }}</td>
                <td>{{ $kardex->cantidad }}</td>
                <td>{{ $kardex->cantidad_detalle  }}</td>
                <td>{{ $kardex->egreso_detalle }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
