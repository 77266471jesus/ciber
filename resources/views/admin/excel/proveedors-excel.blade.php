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
        @foreach ($proveedors as $proveedor)
            <tr>
                <td>{{ $proveedor->id }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->tipo_documento }}</td>
                <td>{{ $proveedor->documento }}</td>
                <td>{{ $proveedor->direccion }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->email }}</td>
                <td>{{ $proveedor->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
