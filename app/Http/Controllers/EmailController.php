<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use App\Mail\MonEmail;


class EmailController extends Controller
{
    public function showEmailForm()
    {
        $count = request()->query('count');
        return view('backOffice.email.form')->with(['count' => $count]);
    }

    //

    public function sendEmail1(Request $request)
    {
//        $validatedData = $request->validate([
//            'subject' => 'required',
//            'message' => 'required',
//        ]);
//
//        $data= $validatedData['message'];
//        dd($data);
        $data = [
            'message' => 'Contenu de l\'email...',
        ];

        Mail::to('kambarddarwen32@gmail.com')->send(new MonEmail($data));

        return "Email envoyé avec succès !";

    }
}
