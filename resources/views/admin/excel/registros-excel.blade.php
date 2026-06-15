<table>
    <thead>        
        <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>ACCION</th>
            <th>USUARIO</th>
            <th>DETALLE ID</th>
            <th>DETALLE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historials as $historial)
            <tr>
                <td>{{ $historial->id }}</td>
                <td>{{ $historial->fecha }}</td>
                <td>{{ $historial->accion }}</td>
                <td>{{ $historial->user->name }}</td>
                <td>{{ $historial->detalle_id }}</td>
                <td>{{ $historial->detalle }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
