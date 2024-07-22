<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    public function report()
    {
        dump('general Json Exception');
    }
    public function render($request)
    {
        return new JsonResponse([
           'errors' => [
                'message'=> $this->getMessage()
           ]
        ], $this->code);
    }
}
