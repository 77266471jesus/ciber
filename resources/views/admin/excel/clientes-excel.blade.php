<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DOCUMENTO</th>
            <th>N°</th>
            <th>DIRECCION</th>
            <th>TELEFONO</th>
            <th>EMAIL</th>
            <th>FECHA CREACION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->tipo_documento }}</td>
                <td>{{ $cliente->documento }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
