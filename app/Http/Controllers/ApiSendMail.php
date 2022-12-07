<?php

namespace App\Http\Controllers;

use App\Mail\SendQuoteBH;
use App\Mail\SendQuotePZ;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApiSendMail extends Controller
{
    public function sendMailBH(Request $request)
    {
        try {
            Mail::to($request->clienteEmail)
                ->send(new SendQuoteBH($request->nameSeller, $request->client, $request->fileUrl, $request->nameFile, $request->emailSeller));
        } catch (Exception $e) {
            return response()->json(["msg" =>  $e->getMessage()], 400);
        }
        return response()->json(["msg" => 1], 200);
    }

    public function sendMailPZ(Request $request)
    {
        try {
            Mail::to($request->clienteEmail)
                ->send(new SendQuotePZ($request->nameSeller, $request->client, $request->fileUrl, $request->nameFile, $request->emailSeller));
        } catch (Exception $e) {
            return response()->json(["msg" =>  $e->getMessage()], 400);
        }
        return response()->json(["msg" => 1], 200);
    }
}
