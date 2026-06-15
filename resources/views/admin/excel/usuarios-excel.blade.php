<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>NOMBRE USUARIO</th>
            <th>CORREO</th>
            <th>DOCUMENTO</th>
            <th>N°</th>
            <th>CARGO</th>
            <th>TELEFONO</th>
            <th>DIRECCION</th>
            <th>FECHA CREACION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->user_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->tipo_documento }}</td>
                <td>{{ $user->ci }}</td>
                <td>{{ $user->cargo }}</td>
                <td>{{ $user->telefono }}</td>
                <td>{{ $user->direccion }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
