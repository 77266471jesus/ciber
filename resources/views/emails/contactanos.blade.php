<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h1{
            color: blue;
        }
    </style>
</head>
<body>
    <h2>Información de Contacto</h2>
    <p><strong>Nombre: </strong>{{$contacto['nombre']}}</p>
    <p><strong>Apellido: </strong>{{$contacto['apellido']}}</p>
    <p><strong>Telefono: </strong>{{$contacto['telefono']}}</p>
    <p><strong>Email: </strong>{{$contacto['email']}}</p>
    <p><strong>Mensaje: </strong>{{$contacto['mensaje']}}</p>
</body>
</html>