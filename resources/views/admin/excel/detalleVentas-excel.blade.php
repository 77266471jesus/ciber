<table>
    <thead>        
        <tr>
            <th>FECHA</th>
            <th>CANTIDAD</th>
            <th>PRECIO VENTA</th>
            <th>DESCUENTO</th>
            <th>TOTAL</th>
            <th>USUARIO</th>
            <th>COMPROBATE</th>
            <th>N°</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalleVentas as $detalleVenta)
            <tr>
                <td>{{ $detalleVenta->fecha }}</td>
                <td>{{ $detalleVenta->cantidad }}</td>
                <td>{{ $detalleVenta->precio_venta }}</td>
                <td>{{ $detalleVenta->descuento }}</td>
                <td>{{ $detalleVenta->subtotal }}</td>
                <td>{{ $detalleVenta->nombre }}</td>
                <td>{{ $detalleVenta->tipo_comprobante }}</td>
                <td>{{ $detalleVenta->comprobante }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
