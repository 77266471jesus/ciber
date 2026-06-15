<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>SLUG</th>
            <th>DESCRIPCION</th>
            <th>ESTADO</th>
            <th>CATEGORIA</th>
            <th>FECHA CREACION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subcategorias as $subcategoria)
            <tr>
                <td>{{ $subcategoria->id }}</td>
                <td>{{ $subcategoria->nombre }}</td>
                <td>{{ $subcategoria->slug }}</td>
                <td>{{ $subcategoria->descripcion }}</td>
                <td>{{ $subcategoria->condicion }}</td>
                <td>{{ $subcategoria->categoria->nombre }}</td>
                <td>{{ $subcategoria->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
