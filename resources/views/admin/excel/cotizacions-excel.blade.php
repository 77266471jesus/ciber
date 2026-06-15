<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>IMPUESTO</th>
            <th>TOTAL</th>
            <th>N°</th>           
            <th>CLIENTE</th>
            <th>USUARIO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cotizacions as $cotizacion)
            <tr>
                <td>{{ $cotizacion->id }}</td>
                <td>{{ $cotizacion->fecha }}</td>
                <td>{{ $cotizacion->impuesto }}</td>
                <td>{{ $cotizacion->total_cotizacion }}</td>
                <td>{{ $cotizacion->comprobante }}</td>
                <td>{{ $cotizacion->cliente->nombre }}</td>
                <td>{{ $cotizacion->user->user_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
