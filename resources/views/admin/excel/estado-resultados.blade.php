<table>
    <thead> 
        <tr>
            <th colspan="9"></th>
        </tr>  
        <tr>
            <th colspan="9">ESTADO DE RESULTADOS</th>
        </tr>  
        <tr>
            <th colspan="9"></th>
        </tr>   
        <tr>
            <th colspan="3">TOTAL KARDEX</th>
            <th colspan="2">{{$kardex}}</th>
        </tr>
        <tr>
            <th colspan="3">TOTAL COMPRAS</th>
            <th colspan="2">{{$compras}}</th>
        </tr>
        <tr>
            <th colspan="3">TOTAL VENTAS</th>
            <th colspan="2">{{$ventas}}</th>
        </tr>
        <tr>
            <th colspan="3">TOTAL DESCUENTOS</th>
            <th colspan="2">{{$descuentos}}</th>
        </tr>        
        <tr>
            <th colspan="9"></th>
        </tr>
        <tr>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>STOCK ACTUAL</th>
            <th>PRECIO COMPRA</th>
            <th>PRECIO VENTA</th>            
            <th>REGISTRO KARDEX</th>
            <th>TOTAL COMPRAS</th>
            <th>TOTAL VENTAS</th>
            <th>TOTAL DESCUENTOS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->precio_compra }}</td>
                <td>{{ $producto->precio_venta }}</td>
                <td>{{ $producto->kardex }}</td>
                <td>{{ $producto->compras }}</td>
                <td>{{ $producto->ventas }}</td>
                <td>{{ $producto->descuentos }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
