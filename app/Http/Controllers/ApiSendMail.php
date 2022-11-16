<?php

namespace App\Http\Controllers;

use App\Mail\SendQuoteGeneric;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApiSendMail extends Controller
{
    public function sendMailBH(Request $request)
    {
        try {
            Mail::to($request->clienteEmail)
                ->send(new SendQuoteGeneric($request->nameSeller, $request->client, $request->fileUrl, $request->emailSeller));
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return 1;
    }

    public function sendMailPZ(Request $request)
    {
        # code...
    }
}
