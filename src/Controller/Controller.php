<?php

namespace Src\Controller;

class Controller
{
    protected function response(int $code, mixed $data = null)
    {
        header($this->buildStatusCodeHeader($code));
        header("Content-Type: application/json");
        echo json_encode($data);
        die();
    }

    protected function buildStatusCodeHeader($code)
    {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        );
        return "HTTP/1.1 " . $code . " " . $status[$code];
    }
}
