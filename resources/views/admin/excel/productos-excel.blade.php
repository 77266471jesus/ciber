<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>SLUG</th>
            <th>MARCA</th>
            <th>MEDIDA</th>
            <th>STOCK ACTUAL</th>
            <th>STOCK INICIAL</th>
            <th>PRECIO COMPRA</th>
            <th>PRECIO VENTA</th>
            <th>DESCRIPCION</th>
            <th>ESTADO</th>
            <th>SUBCATEGORIA</th>
            <th>FECHA CREACION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->slug }}</td>
                <td>{{ $producto->marca }}</td>
                <td>{{ $producto->medida }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->stock_inicial}}</td>
                <td>{{ $producto->precio_compra }}</td>
                <td>{{ $producto->precio_venta }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->condicion }}</td>
                <td>{{ $producto->subcategoria->nombre }}</td>
                <td>{{ $producto->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
