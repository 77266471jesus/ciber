<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>COMPROBANTE</th>
            <th>N°</th>
            <th>IMPUESTO</th>
            <th>TOTAL</th>
            <th>CLIENTE</th>
            <th>USUARIO</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>{{ $venta->tipo_comprobante }}</td>
                <td>{{ $venta->comprobante }}</td>
                <td>{{ $venta->impuesto }}</td>
                <td>{{ $venta->total_venta }}</td>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>{{ $venta->user->user_name }}</td>
                <td>{{ $venta->estado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
