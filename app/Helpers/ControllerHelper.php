<?php

namespace App\Helpers;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ControllerHelper
{
    public static function return_response($data = null, $statusCode = 200)
    {
        return response()->json($data, $statusCode, array(), JSON_UNESCAPED_SLASHES);
    }

    public static function return_error(Exception | HttpException $e) {
      $message = $e->getMessage();
      $statusCode = 500;
      if ($e instanceof HttpException) {
        $statusCode = $e->getStatusCode();
        switch ($e->getStatusCode()) {
            case 404:
                $message = 'Não encontrado!';
                break;
            case 400:
                $message = "O campo $message não foi alimentado com um valor válido.";
                break; 
        }

        return response()->json(['message' => $message], $e->getStatusCode(), array(), JSON_UNESCAPED_SLASHES);
      } else {
        $message = 'Ocorreu um erro interno: ' . $e->getMessage();
        $statusCode = 500;
      }
      return response()->json(['message'=> $message], $statusCode);

    }
}
