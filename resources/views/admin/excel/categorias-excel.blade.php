<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>SLUG</th>
            <th>DESCRIPCION</th>
            <th>ESTADO</th>
            <th>FECHA CREACION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->slug }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>{{ $categoria->condicion }}</td>
                <td>{{ $categoria->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
