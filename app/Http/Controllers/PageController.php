<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Simulación de envío de correo (puedes usar Mailtrap o SMTP real)
        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to('admin@example.com')
                 ->subject('Nuevo mensaje de contacto')
                 ->from($request->email, $request->name);
        });

        return redirect()->route('contact')->with('success', 'Mensaje enviado correctamente.');
    }
}
