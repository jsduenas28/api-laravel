<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Nota;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class GPTController extends Controller
{
    function genCuestionario($id) {
        $nota = Nota::where('id', $id)->value('contenido_nota');

        $client = new Client();
        $response = $client->post('https://api.opexams.com/questions-generator', [
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => 'sk20YuH47nKzolYdmxdHDz30CAv58eD',
                //'request-type' => 'test'
            ],
            'json' => [
                "type" => "contextBased",
                "context" => $nota,
                "questionType" => "MCQ",
                "language"=> "spanish",
            ]
        ]);

        $body = $response->getBody();

        return response()->json(json_decode($body, true));
    }
}
