<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>COMPROBANTE</th>
            <th>N°</th>
            <th>IMPUESTO</th>
            <th>TOTAL</th>
            <th>PROVEEDOR</th>
            <th>USUARIO</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ingresos as $ingreso)
            <tr>
                <td>{{ $ingreso->id }}</td>
                <td>{{ $ingreso->fecha }}</td>
                <td>{{ $ingreso->tipo_comprobante }}</td>
                <td>{{ $ingreso->comprobante }}</td>
                <td>{{ $ingreso->impuesto }}</td>
                <td>{{ $ingreso->total_compra }}</td>
                <td>{{ $ingreso->proveedor->nombre }}</td>
                <td>{{ $ingreso->user->user_name }}</td>
                <td>{{ $ingreso->estado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
