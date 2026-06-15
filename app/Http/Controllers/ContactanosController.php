<?php

namespace App\Http\Controllers;

use App\Mail\ContactanosMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller
{
    public function index()
    {
        return view('contacto');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|email',
        'telefono' => 'required',
        'mensaje' => 'required',
        ]);

        $correo = new ContactanosMailable($request->all());
        Mail::to('contacto@debhi.com ')->send($correo);
        return redirect()->route('contactos')->with('info','Mensaje enviado');
    }
}
