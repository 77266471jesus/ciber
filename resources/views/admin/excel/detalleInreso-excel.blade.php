<table>
    <thead>        
        <tr>
            <th>FECHA</th>
            <th>CANTIDAD</th>
            <th>PRECIO COMPRA</th>
            <th>PRECIO VENTA</th>
            <th>TOTAL</th>
            <th>USUARIO</th>
            <th>COMPROBATE</th>
            <th>N°</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalleIngresos as $detalleIngreso)
            <tr>
                <td>{{ $detalleIngreso->fecha }}</td>
                <td>{{ $detalleIngreso->cantidad }}</td>
                <td>{{ $detalleIngreso->precio_compra }}</td>
                <td>{{ $detalleIngreso->precio_venta }}</td>
                <td>{{ $detalleIngreso->subtotal }}</td>
                <td>{{ $detalleIngreso->nombre }}</td>
                <td>{{ $detalleIngreso->tipo_comprobante }}</td>
                <td>{{ $detalleIngreso->comprobante }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
